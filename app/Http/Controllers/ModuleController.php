<?php

namespace App\Http\Controllers;

use App\Models\Course\Course;
use App\Models\Department\AccademicYear;
use App\Models\Module\Module;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $modules], 200) : view("module.index", compact("modules"));
        //
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
        $years = AccademicYear::where("status", "=", "1")->get();
        return view('module.create', compact('title', "years"));
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
                "name" => ["unique:modules,name", "required"],
                "credit" => ["required"],
                "accademic_year_id" => ["required"]

            ]
        );
        $module = Module::create($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $module], 201) : redirect(route('course.modules.index'))->with('success', 'Your new course has been added successfully!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        return request()->wantsJson() ? new JsonResponse(["data" => $module], 200) :  view("course.modules.show", compact("module"));  //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $title = "Edit Course";
        $years = AccademicYear::where("status", "=", "1")->get();
        return view('module.create', compact('title', "years"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $module->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $module], 200) : redirect(route('course.modules.index'))->with('success', 'Your course has been updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('course.modules.index'))->with('success', 'Your  course has been deleted successfully!'); //
    }
}
