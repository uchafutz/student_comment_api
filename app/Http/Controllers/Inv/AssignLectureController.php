<?php

namespace App\Http\Controllers\Inv;

use App\Http\Controllers\Controller;
use App\Models\Lecture\Lecture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssignLectureController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Lecture $lecture)
    {
        $lecture->modules()->sync($request->input("module_id"));
        return  redirect(route('department.lectures.show', ['lecture' => $lecture]))->with('success', 'Your  Module has been add successfully!');

        //
    }
}
