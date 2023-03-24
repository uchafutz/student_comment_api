<?php

namespace App\Http\Controllers;

use App\Models\Answer\Answer;
use App\Models\Question\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(10);
        return request()->wantsJson() ? new JsonResponse(["data" => $questions], 200) : view("question.index", compact("questions")); //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "New Qusetion";
        $answers = Answer::all();
        return view('question.create', compact('title', 'answers'));
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
        $request->validate([
            'name' => ['required', 'unique:questions,name']
        ]);
        $question = Question::create($request->input());
        $question->answer()->sync($request->input("answer_id"));
        return $request->wantsJson() ? new JsonResponse(["data" => $question], 201) : redirect(route('comment.questions.index'))->with('success', 'Your new Question has been added successfully!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return request()->wantsJson() ? new JsonResponse(["data" => $question], 200) : null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $title = "Edit Question";
        $answers = Answer::all();
        return view('question.create', compact('question', 'title', 'answers')); //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update($request->input());
        $question->answer()->sync($request->input("answer_id"));
        return $request->wantsJson() ? new JsonResponse(["data" => $question], 201) : redirect(route('comment.questions.index'))->with('success', 'Your question has been updated successfully!');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return request()->wantsJson() ? new JsonResponse(null, 204) : redirect(route('comment.questions.index'))->with('success', 'Your new Question has been delete successfully!');
        //
    }
}
