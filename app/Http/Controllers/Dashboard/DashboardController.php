<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment\Comment;
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
        $query = Comment::query();
        $query = $query->selectRaw('AVG(rates) average_score, lecture_id');
        $query = $query->with('lectures.users');
        $query = $query->groupBy('lecture_id');

        $comment = $query->get();

        $labels = $comment->pluck('lectures.users.name');
        $data = $comment->pluck('average_score');

        return view("home", compact("comment", "labels", "data"));
        //
    }
}
