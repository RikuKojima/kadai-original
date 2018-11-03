@extends('layouts.app')

@section('content')
  <div class="question-root">
    <!-- ヘッダー -->
    <div id="headcontent" class=''>

      <div class="p-QuestionHead u-flexBox u-flexBox-between text-center">
        <div class="question-title center-block">
          <h1>{!! $question->title !!}</h1>
          <div class="question-tags">
          タグ:
          @foreach($question->tags as $tag)
            <label class = "label label-info">{{$tag->name}}</label>
          @endforeach
          </div>
        </div>
        
        <div class="question-info center-block">
          <div class="question-info-user">
          投稿者：{!! $question->user->name !!}
          </div>
          <div class="question-info-AnswerCounts">
            回答数:{!! $question->answers()->count() !!}
          </div>
          <div class="question-info-EditHistory">
            {!! $question->updated_at !!}
          </div>
        </div>
      </div>

      

    </div>

    <!-- ボディ -->
    <div id="bodycontent" class= "u-flexBox u-flexBox--spaceBetween">
      <div class="maincontent">
        <div class="question">
          {!! $question->mark_content !!}
        </div>
        <!-- 投稿者なら削除と編集が可能 -->
        @if(Auth::id() == $question->user_id)
          {!! Form::open(['route' => ['questions.edit', $question->id], 'method' => 'get']) !!}
            {{ Form::submit('この質問を編集する', ['class' => 'btn btn-primary']) }}
          {!! Form::close()!!}
          {!! Form::open(['route' => ['questions.destroy', $question->id], 'method' => 'delete']) !!}
            {{Form::submit('この質問を削除する', ['class' => 'btn btn-danger ']) }}
          {!! Form::close() !!}

        @endif
      </div>
      <div class="sub-content">
        <div class="jumbotron">
          <h3>関連した項目</h3>
        </div>



      </div>

    </div>

    <!-- ヘッダ- -->
    <div id="footcontent">

    </div>
  </div>
@endsection
