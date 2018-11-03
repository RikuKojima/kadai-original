<!--//ユーザ登録ページ-->

@extends('layouts.app')

@section('content')
    <!--グリッドシステム-->
    <div class="container mt-2">
        <div class="row">
            <div class=" col-3">
                <div class="text-center">
                    SNSで登録
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <a href="/login/google"  class="btn btn-default btn-md p-SnsLink icon-google mx-auto d-block" title="googleアカウントで登録"></a>
                    </div>
                    <div class="col-6">
                        <a href="/login/google"  class="btn btn-default btn-md p-SnsLink icon-google mx-auto d-block" title="googleアカウントで登録"></a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="/login/google"  class="btn btn-default btn-md p-SnsLink icon-google mx-auto d-block" title="googleアカウントで登録"></a>
                    </div>
                    <div class="col-6">
                        <a href="/login/google"  class="btn btn-default btn-md p-SnsLink icon-google mx-auto d-block" title="googleアカウントで登録"></a>
                    </div>
                </div>
            </div>

            <div class="offset-md-5 col-3">
              {!! Form::open(['route' => 'register.pre_check', 'class' => 'form-horizontal' ])!!}
              {{csrf_field()}}
              <div class="form-group">
                {!! Form::email('email',old('email'), ['class' => 'form-control', 'placeholder' => 'メールアドレス']) !!}
              </div>
              <div class="form-group">
                {!! Form::password('password',['class' => 'form-control','placeholder' => 'パスワード' ]) !!}
              </div>
              <div class="form-group">
                {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder' => '確認用パスワード'])!!}
              </div>

              {!! Form::submit('仮登録',['class' => 'btn btn-success btn-block']) !!}
              {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
