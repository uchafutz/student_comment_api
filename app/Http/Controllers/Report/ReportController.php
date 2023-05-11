<?php

namespace App\Http\Controllers\Report;

use App\Exports\ExportUser;
use App\Http\Controllers\Controller;
use App\Models\Department\AccademicYear;
use App\Models\Department\Department;
use App\Models\Lecture\Lecture;
use App\Models\Module\Module;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{

    public function index()
    {
        $years = AccademicYear::all();
        $lectures = Lecture::with('modules', 'departments', 'users')->get();
        $departments = Department::all();
        $modules = Module::with('lectures')->get();
        // dd($lectures);
        return view("report.index", compact('years', 'lectures', 'departments', 'modules'));
    }

    public function exportUsers(Request $request)
    {
        return Excel::download(new ExportUser, 'users.xlsx');
    }
}
