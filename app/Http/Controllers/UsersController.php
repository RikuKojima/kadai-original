<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    //デフォルト::全てのUser表示
    public function index() {
        $users = User::all();
    
    return view('users.index',['users' => $users,
    ]);
    }
    
    //指定のユーザー表示
    public function show($id){
        $user = User::find($id);
        $questions = $user->questions()->orderBy('created_at','asc');
        $answers = $user->answers()->orderBy('created_at','asc');
        
        $data = [
            'user' => $user,
            'questions' => $questions,
            'answers' => $answers,
        ];
        
        $data += $this->counts($user);
        
        return view('users.show',$data);
        
        
    }
    
    
}
