@extends('layouts.app')

@section('content')
<div class="justify-content-center">
                    <div class="col-xs-8">
                        @if($user->accounts)
                            <div class="panel">
                                <div class="panel-body">
                                    現在、このアカウントは{{$user->accounts->first()->provider_name}}アカウントと連携しています。
                                </div>
                            </div>
                        @endif
                        {{ Form::open(['method' => 'post','route' => ['users.update', $user->id], 'class' => 'form-horizontal', 'files' => true]) }}
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden", name="_token",value="csrf_token()">

                        <!-- SNSとリンクしているかどうかで分ける -->

                        
                        <div class="form-group">
                        {{ Form::label('name','ユーザー名') }}
                        {{ Form::text('name',$user->name,['placeholder' => $user->name, 'class' => 'form-control']) }}
                        <!-- SNSリンクがないとき -->
                        @if(!$user->accounts)
                        <div class="form-group">
                        {{ Form::label('email','メールアドレス') }}
                        {{ Form::email('email',$user->email ,['class' => 'form-control', 'placeholder' => $user->email ]) }}
                        </div>
                        <div class="form-group">
                        {{ Form::label('password','パスワード') }}
                        {{ Form::password('password',['class' => 'form-control']) }}
                        </div>
                        
                        <div class="form-group">
                        {{ Form::label('passsword_confirmation','パスワード確認') }}
                        {{ Form::password('passsword_confirmation',['class' => 'form-control']) }}
                        </div>
                        @endif
                        <div class="form-group">
                        {{ Form::label('avatar','プロフィール画像')}}
                        {{ Form::file('avatar',old('avatar'), ['class' => 'form-control-file','id' => 'avatar-file']) }}
                            
                        </div>
                        
                        <div class="form-group">
                        {{ Form::label('profile','自己紹介文')}}
                        {{ Form::textarea('profile',$user->profile,['class' => 'form-control','placeholder' => $user->profile])}}
                        </div>
            
                        <!-- ボタン -->
                        {!! Form::submit('この設定で保存') !!}
                        {!! Form::close() !!}
                    </div>
                </div>


    </div>
@endsection