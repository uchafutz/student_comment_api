<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Lecture\Lecture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $lectures = Lecture::count();
        $users = User::select(DB::raw("COUNT(*) as count"))->get();


        // dd($users);

        $labels = $users->keys();
        $data = $users->values();
        return view("home", compact("lectures", "labels", "data"));
        //
    }
}
