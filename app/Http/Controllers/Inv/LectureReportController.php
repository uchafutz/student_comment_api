<?php

namespace App\Http\Controllers\Inv;

use App\Exports\ExportComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LectureReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //dd($request->input());
        $request->validate([
            'lecture_id' => 'required',
            'module_id' => 'required',
            'year_id' => 'required',
            'department_id' => 'required'
        ]);
        $lecture_id = $request->input("lecture_id");
        $module_id = $request->input("module_id");
        return Excel::download(new ExportComment($lecture_id, $module_id), 'lecturereport.xlsx');

        //  dd($request->input());
        //
    }
}
