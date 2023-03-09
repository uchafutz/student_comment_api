<?php

namespace App\Http\Controllers;

use App\Models\Course\Course;
use App\Models\Department\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $courses], 200) : view("course.index", compact("courses"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Course";
        $departments = Department::all();
        return view('department.create', compact('title', 'departments'));
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
                "name" => ["unique:cources,name", "required"],
                "credits" => ["required"],
                "department_id" => ["required"]

            ]
        );
        $course = Course::create($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $course], 201) : redirect(route('course.courses.index'))->with('success', 'Your new Course has been added successfully!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return request()->wantsJson() ? new JsonResponse(["data" => $course], 200) :  view("course.courses.show", compact("course"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        $title = "Edit Course";
        $departments = Department::all();
        return view('course.create', compact('title', 'departments'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $course->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $course], 200) : redirect(route('course.courses.index'))->with('success', 'Your  course has been updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('course.courses.index'))->with('success', 'Your  course has been deleted successfully!');
        //
    }
}
