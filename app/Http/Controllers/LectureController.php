<?php

namespace App\Http\Controllers;

use App\Models\Department\Department;
use App\Models\Lecture\Lecture;
use App\Models\Module\Module;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lectures = Lecture::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $lectures], 200) : view("lecture.index", compact("lectures"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Lecture";
        $departments = Department::all();
        $users = User::where("status", "=", "0")->where("type", "=", "staff")->get();
        // dd($users);
        return view('lecture.create', compact('title', 'departments', 'users'));
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
                "department_id" => ["required"]

            ]
        );
        $lecture = Lecture::create($request->input());
        $user = User::where("id", "=", $request->input("user_id"))->update(["status" => "1"]);
        return $request->wantsJson() ? new JsonResponse(["data" => $lecture], 201) : redirect(route('department.lectures.index'))->with('success', 'Your new Lecture has been added successfully!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lecture\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        $title = "Show Details Lecture";
        $modules = Module::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $lecture], 200) :  view("lecture.show", compact("lecture", "title", "modules"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecture\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecture $lecture)
    {
        $title = "Edit Lecture";
        $departments = Department::all();
        $users = User::where("status", "=", "0")->where("type", "=", "staff")->get();
        return view('lecture.create', compact('title', 'departments', 'lecture', 'users'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecture\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecture $lecture)
    {
        $lecture->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $lecture], 200) : redirect(route('department.lectures.index'))->with('success', 'Your  lecture has been updated successfully!');  //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecture\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecture $lecture)
    {
        $lecture->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('department.lectures.index'))->with('success', 'Your lecture has been deleted successfully!');
        //
    }
}
