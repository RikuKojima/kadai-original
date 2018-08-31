@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2>知識の旅に出よう</h2>

            </div>

            <div class="col-md-offset-2 col-md-4 ">
              {!! Form::open(['route' => 'signup.post', 'class' => 'form-horizontal']) !!}
              <div class="form-group">
                {!! Form::text('name', old('name'), ['class' => 'form-control' , 'placeholder' => 'name']) !!}
              </div>

              <div class="form-group">
                {!! Form::email('email', old('email'), ['class' => 'form-control','placeholder' => 'email' ]) !!}
              </div>

              <div class="form-group">

                {!! Form::password('password',['placeholder' => 'password','class' => 'form-control']) !!}
              </div>
                {!! Form::submit('Sign Up',['class' => 'btn btn-success btn-block',]) !!}
              {!! Form::close() !!}
              <a href="/login/google"  class="btn btn-default btn-md">Log in with google</a>
            </div>
          </div>
        </div>
    </div><!--  jumbotron end -->

    <!-- 新規のQuestionを３件表示 -->

@endsection
