<?php

namespace App\Http\Controllers\Inv;

use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use Illuminate\Http\Request;

class AssingCourseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Course $course)
    {

        $course->modules()->attach($request->input("module_id"));
        return  redirect(route('course.courses.show', ['course' => $course]))->with('success', 'Your  Module has been add successfully!');
        //
    }
}
