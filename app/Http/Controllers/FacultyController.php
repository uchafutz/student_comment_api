<?php

namespace App\Http\Controllers;

use App\Models\Course\Course;
use App\Models\Department\Department;
use App\Models\Faculty\Faculty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $faculties], 200) : view("faculty.index", compact("faculties"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Faculty";
        $departments = Department::all();
        return view('faculty.create', compact('title', 'departments'));
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
                "name" => ["unique:faculties,name", "required"],
                'department_id' => ['required']

            ]
        );
        $faculty = Faculty::create($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $faculty], 201) : redirect(route('facultys.index'))->with('success', 'Your new faculty has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        $programmes = Course::all();
        return view('faculty.show', compact('faculty', 'programmes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        $title = "Edit Faculty";
        $departments = Department::all();
        return view('faculty.create', compact('title', 'departments', 'faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculty $faculty)
    {
        $faculty->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $faculty], 200) : redirect(route('facultys.index'))->with('success', 'Your  facultys has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('facultys.index'))->with('success', 'Your  facultys has been deleted successfully!');
    }
}
