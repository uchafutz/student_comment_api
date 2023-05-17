<?php

namespace App\Http\Controllers;

use App\Models\Course\Course;
use App\Models\Department\AccademicYear;
use App\Models\Department\Department;
use App\Models\Lecture\Lecture;
use App\Models\Module\Module;
use App\Models\Question\Question;
use App\Models\Student\Student;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = Student::paginate(10);
        $departments = Department::all();
        return request()->wantsJson() ? new JsonResponse(["data" => $students], 200) : view("student.index", compact("students", "departments"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = "New Student";
        $courses = Course::all();
        $users = User::where("status", "=", "0")->where("type", "=", "student")->get();
        $years = AccademicYear::where("status", "=", "1")->get();
        $departments = Department::all();
        // dd($users);
        return view('student.create', compact('title', 'courses', 'users', "years", "departments"));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate(
            [

                "user_id" => ["required"],
                "course_id" => ["required"],
                "accademic_year_id" => ["required"],


            ]
        );
        DB::beginTransaction();
        $student = Student::create($request->input());
        $user = User::where("id", "=", $request->input("user_id"))->update(["status" => "1", "reg_id" => $student->code]);
        DB::commit();
        return $request->wantsJson() ? new JsonResponse(["data" => $student], 201) : redirect(route('department.students.index'))->with('success', 'Your new Student has been added successfully!');

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $title = "New Comment";
        $lectures = Lecture::with(["modules", "users"])->get();
        $modules = Module::with(["courses", "lectures"])->get();
        $departments = Department::all();
        $questions = Question::with(['answer'])->get();
        //dd($questions->toArray());
        $CourseData = Course::where('id', '=', $student->course_id)->with(['modules', 'modules.lectures.users'])->get();
        // dd($CourseData->toArray());
        // dd($lectures);
        return request()->wantsJson() ? new JsonResponse(["course" => $CourseData, "questions" => $questions], 200) :  view("student.show", compact("student", "title", "lectures", "modules", "CourseData", "questions", "departments"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {

        $title = "Edit Student";
        $courses = Course::all();
        $users = User::where("status", "=", "0")->where("type", "=", "student")->get();
        $years = AccademicYear::where("status", "=", "1")->get();
        $departments = Department::all();
        // dd($users);
        return view('student.create', compact('title', 'courses', 'users', "years", "student", "departments"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $student], 200) : redirect(route('department.students.index'))->with('success', 'Your student has been updated successfully!'); //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $user = User::where("id", "=", $student->user_id)->update(["status" => "0", "reg_id" => ""]);
        $student->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('department.students.index'))->with('success', 'Your student has been deleted successfully!');
        //
    }
}
