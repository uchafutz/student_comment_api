<?php

namespace App\Http\Controllers;

use App\Models\Department\AccademicYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = AccademicYear::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $years], 200) : view("accademic_year.index", compact("years"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Accademic";
        return view('accademic_year.create', compact('title')); //
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
                "accademic_year" => ["unique:accademic_years,accademic_year", "required"],

            ]
        );
        $year = AccademicYear::create($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $year], 201) : redirect(route('department.years.index'))->with('success', 'Your new accademic year has been added successfully!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department\AccademicYear  $accademicYear
     * @return \Illuminate\Http\Response
     */
    public function show(AccademicYear $year)
    {
        return request()->wantsJson() ? new JsonResponse(["data" => $year], 200) :  view("department.years.show", compact("year")); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department\AccademicYear  $accademicYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AccademicYear $year)
    {

        $title = "Edit Accademic";
        return view('accademic_year.create', compact('title', 'year')); //
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department\AccademicYear  $accademicYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccademicYear $year)
    {
        $year->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $year], 200) : redirect(route('department.years.index'))->with('success', 'Your  Accademic Year has been updated successfully!');  //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department\AccademicYear  $accademicYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccademicYear $year)
    {
        $year->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('department.years.index'))->with('success', 'Your  Accademic Year  has been deleted successfully!');
        //
    }
}
