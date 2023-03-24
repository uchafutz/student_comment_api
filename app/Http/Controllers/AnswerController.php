<?php

namespace App\Http\Controllers;

use App\Models\Answer\Answer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::paginate(10);
        // dd($answers);
        return request()->wantsJson() ? new JsonResponse(["data" => $answers], 200) : view("answer.index", compact("answers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Answer";
        return view('answer.create', compact('title'));  //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => ['required', 'unique:answers,name']]);
        $answer = Answer::create($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $answer], 201) : redirect(route('comment.answers.index'))->with('success', 'Your new Answer has been added successfully!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        return request()->wantsJson() ? new JsonResponse(["data" => $answer], 200) : null;  //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        $title = 'Edit Answer';
        return view('answer.create', compact('answer', 'title'));  //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        $answer->update($request->input());
        return $request->wantsJson() ? new JsonResponse(["data" => $answer], 201) : redirect(route('comment.answers.index'))->with('success', 'Your answer has been updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('comment.answers.index'))->with('success', 'Your new answer has been delete successfully!');
        //
    }
}
