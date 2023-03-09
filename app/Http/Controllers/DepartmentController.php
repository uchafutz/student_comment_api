<?php

namespace App\Http\Controllers;

use App\Models\Department\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $departments], 200) : view("department.index", compact("departments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Department";
        return view('department.create', compact('title')); //
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
                "name" => ["unique:departments,name", "required"],

            ]
        );
        $department = Department::create($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $department], 201) : redirect(route('department.departments.index'))->with('success', 'Your new department has been added successfully!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return request()->wantsJson() ? new JsonResponse(["data" => $department], 200) :  view("department.departments.show", compact("department"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $title = "Edit Department";
        return view('department.create', compact('title', 'department'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $department->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $department], 200) : redirect(route('department.departments.index'))->with('success', 'Your  department has been updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('department.departments.index'))->with('success', 'Your  department has been deleted successfully!'); //
    }
}
