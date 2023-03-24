<?php

namespace App\Http\Controllers;

use App\Models\Comment\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $comments = Comment::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $comments], 200) : view("comment.index", compact("comments"));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        // dd($request->input());
        $request->validate([
            "module_id" => "required",
            "lecture_id" => "required",
            "student_id" => "required",
            "rates" => "required"
        ]);
        DB::beginTransaction();
        $comment = Comment::create($request->input());
        foreach ($request->input("items") as $item) {
            $comment->item()->create($item);
        }
        DB::commit();

        return $request->wantsJson() ? new JsonResponse(["data" => $comment], 201) : redirect(route('department.students.index'))->with('success', 'Your new comment has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('comment.comments.index'))->with('success', 'Your comment has been delete successfully!');
        //
    }
}
