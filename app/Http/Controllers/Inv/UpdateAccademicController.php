<?php

namespace App\Http\Controllers\Inv;

use App\Http\Controllers\Controller;
use App\Models\Department\AccademicYear;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateAccademicController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, AccademicYear $year)
    {
        AccademicYear::where("status", "=", "1")->update(["status" => "0"]);
        $year->update(["status" => "1"]);
        return $request->wantsJson() ? new JsonResponse(["data" => $year], 200) : redirect(route('department.years.index'))->with('success', 'Your  Accademic Year has been set successfully!');
        //
    }
}
