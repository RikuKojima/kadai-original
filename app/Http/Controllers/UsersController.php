<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;


class UsersController extends Controller
{
    //全てのユーザー
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

    // 編集用ページに飛ぶ
    public function edit($id) {
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request,$id) {
        $user = User::find($id);
        $form = $request->all();
        unset($form['_token']);
        $user->fill($form)->save();
        return redirect()->back();
    }

    public function update_avatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::User();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars',$avatarName);
        $user->avatar = $avatarName;
        $user->save();
        return back()->with('success','You have successfully upload image.');
    }


    public function store() {
        
    }
}
