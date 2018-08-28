<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //ユーザがもつ質問や回答の数をカウントする
    public function counts($user) {
        $count_questions = $user->questions()->count();
        $count_answers = $user->answers()->count();
        
        
        return [
            'count_questions' => $count_questions,
            'count_answers' => $count_answers,
            ];
    }
}
