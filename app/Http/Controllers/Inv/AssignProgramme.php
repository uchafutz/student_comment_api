<?php

namespace App\Http\Controllers\Inv;

use App\Http\Controllers\Controller;
use App\Models\Faculty\Faculty;
use Illuminate\Http\Request;

class AssignProgramme extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Faculty $faculty)
    {
        $faculty->programme()->sync($request->input("programme_id"));
        return  redirect(route('facultys.index'))->with('success', 'Your  programme has been add successfully!');
    }
}
