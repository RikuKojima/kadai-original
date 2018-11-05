<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Tag;

class QuestionsController extends Controller
{
    // Questionを投稿するためのコントローラです
    // store , delete, editを実装

    public function create() {
      return view('questions.create');
    }

    public function store(Request $request) {
      $data = [
        'title' => 'required',
        'content' => 'required',
        'tags' => 'required',
      ];

      $this->validate($request,$data);


      $tags = explode("," , $request->tags);
      $question = $request->user()->questions()->create($request->all());
      $question->tag($tags);

      
      


      return view('questions.show', [
        'question' => $question,
      ])->with('success', '投稿が完了しました');

      }

      public function show($question_id) {
        $question = Question::find($question_id);
        return view('questions.show',['question' => $question,]);
      }


    public function destroy($id) {
      $question = \App\Question::find($id);

      if (\Auth::id() === $question->user_id()) {
        $question->delete();
      }
      return redirect()->back();
    }

    public function edit(Request $request, $id) {
      $question = \App\Question::find($id);

      return view('question.edit', ['question' => $question]);
    }

    public function showBytag($id) {
      $tag = Tag::find($id);

    }


}
