@extends('layouts.app')

@section('content')
<div class="row">
      <aside class="col-4">
        <div id="l-user__summary">
            <div class="boxStartThumb"> <!-- 画像 -->
                <div class="boxRadius__95"> 
                    
                </div>
            </div>
        
        <h1 class = "titleMain text-center">{!! $user->name !!}</h1>
        @if($user->avatar)
                <img  class="mx-auto d-block", style="width:180px;", height= 180, src="/storage/avatars/{{ $user->avatar }}" />
        @endif
        <div class="boxUserStatus">
        <div class="row">
            <div class="boxUserStatus-question col-6 ">
                <p class="boxUserstatus-question_ttl text-center">質問数</p>
                <p class="text-center text-primary lead">{{ $count_questions}}</p>
            </div>
            <div class="boxUserStatus-answers col-6">
                <p class="boxUserstatus-answer_ttl text-center">回答数</p>
                <p class="text-center text-primary lead">{{ $count_answers }}</p>
            </div>
        </div>
        </div>
        <div class="boxUserProfile"></div>
            @if($user->profile)
            <div class="panel">
                <div class="panel-body">
                {!! $user->profile !!}
                </div>
            </div>
            @endif
            <!-- 本人の場合のみ編集ページに行くことができる -->
            @if(Auth::User() == $user)
                <div class="panel">
                    <div class="panel-body">
                        <div class="text-center">
                        {!! link_to_route('users.edit','プロフィール編集' ,['id' => Auth::id()] ) !!}
                        </div>
               
                    </div>
                </div>
            @endif
        </div>
          
      </aside>
      <div class="offset-xs-3 col-8">
          <!-- タブ実装 -->
          
            <h1 class="border-bottom" href="#tab2"  >Question一覧<span class='badge'>({{ $count_questions}}コ)</span></h1>
            
          <!-- タブのコンテンツ -->
          <div class="tab-content">
            <!-- <div id="tab1" class="tab-pane active">
                
            </div> -->
            <div id="tab2" class="tab-pane active">
                @foreach($user->questions as $question)
                    <div class="card mb-3">
                        <div class="card-header">
                            {!! $question->title !!}
                        </div>
                        <div class="card-body">
                            {!!$question->mark_content!!}
                        </div>
                        
                    </div>
                    
                @endforeach
            </div>
            


          </div>
          
      </div>
  </div>
@endsection
