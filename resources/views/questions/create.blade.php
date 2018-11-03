@extends('layouts.app')

@section('content')
  <div class="row">
    <!-- <div class="jumbotron">
      <div class="container"> -->
      <div class="col-xs-6">
        {!! Form::open(['route' => 'questions.store', 'class' => 'form-horizontal']) !!}
        {{csrf_field()}}
        <div class="form-group">
          {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => 'ここにタイトルを入力してください', 'rows' => 3]) !!}
        </div>

        <!-- タグを書き込む -->
        <div class="form-group">
          {!! Form::text('tags',old('tags'), ['class' => 'form-control', 'placeholder' => 'タグ' , 'data-role' => 'tagsinput']) !!}
          @if($errors->has('tags'))
          <span class='text-danger'>{{ $errors->first('tags') }}</span>
          @endif
        </div>
        <!-- タグ終わり -->

        <div class="form-group">
          <div id="markdown">
            {!! Form::textarea('content',old('content'), ['class' => 'form-control','name' => "content", 'id' => "content", 'rows' => "10", 'tabindex' => "4", 'data-validation' => "validateDescription" , 'data-validation-error-msg' => "本文を入力してください。"])!!}
          </div>
        </div>

        {!! Form::submit('質問を投稿する',['class' => 'btn btn-success btn-block',]) !!}
        {!! Form::close() !!}
      </div>

      <div class="col-xs-6">
      <div id="markdown_result"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplemde/1.11.2/simplemde.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/marked/0.3.6/marked.min.js"></script>
<script>
    var simplemde = new SimpleMDE({
        element: document.getElementById("content"),
        forceSync: true
    });

    ["input", "paste"].forEach(function (value) {
        document.querySelector(".CodeMirror textarea").addEventListener(value, function () {
            document.getElementById("markdown_result").innerHTML = marked(document.getElementById("content").value);
        });
    });
</script>
      </div>
      <!-- </div>
    </div> -->
  </div>
@endsection
