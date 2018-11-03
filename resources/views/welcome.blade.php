@extends('layouts.app')

@section('content')
<div class="main-content">


    <div class="jumbotron">
        <div class="container">
          <div class="row">
            <div class="p-fvRegist_messageBox">
              
                <h2>知識の旅に出よう</h2>

              
            </div>


            <div class="offset-md-5 col-md-4 ">
              <div class="p-fvRegistForm">
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

                <div class="form-group">

                  {!! Form::password('password_confirmation',['placeholder' => 'password confirmation','class' => 'form-control']) !!}
                </div>
                  {!! Form::submit('Sign Up',['class' => 'btn btn-success btn-block',]) !!}
                {!! Form::close() !!}
              </div>
              <div class="p-fvSnsRegist">
                <p class="p-fvSnsRegist__title">
                  SNSアカウントで登録
                </p>
                <ul class="p-fvSnsRegist__body u-flexBox u-flexBox--spaceBetween">
                  <li class="p-fvSnsRegist__item">
                    <a href="/login/google"  class="btn btn-default btn-md p-SnsLink icon-google" title="googleアカウントで登録"></a>

                  </li>
                  <li class="p-fvSnsRegist__item"></li>
                  <li class="p-fvSnsRegist__item"></li>
                  <li class="p-fvSnsRegist__item"></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </div><!--  jumbotron end -->

    <!-- 新規のQuestionを３件表示 -->
</div>


@endsection
