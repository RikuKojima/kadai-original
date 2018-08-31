<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','field',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // ユーザが複数のSNSアカウントと連携することを考慮
    public function accounts() {
        return $this->hasMany('App\LinkedSocialAccounts');
    }


    //questionsを所有
    public function questions() {
        return $this->hasMany('App\Question');
    }

    //answersを所有
    public function answers() {
        return $this->hasMany('App\Answer');
    }

    //answer_favoriteにmanyTomany
    public function favorite_answer() {
        return $this->belongsToMany('App\Answer','answer_favorite','user_id','answer_id');
    }

    //quesion_favoriteにmanyTomany
    public function favorite_question() {
        return $this->belongsToMany('App\Question','question_favorite','user_id','question_id');
    }

    // メソッド実装
    //question favorited or not ?
    public function is_favorited_q($q_id){
        return $this->favorite_question()->where('question_id',$q_id)->exists();
    }

    //add favo
    public function add_favorite_q($q_id){

        if($this->is_favorited_q($q_id)) {
            return false;
        }else{
            $this->favorite_question()->attach($q_id);
        }
    }

    //remove favo
    public function rm_favorite_q($q_id){
        if($this->is_favorited_q($q_id)){
            $this->favorite_question()->detach($q_id);
        }else{
            return false;
        }
    }
    //ここまでQuestion

    //answer favoed or not?
    public function is_favorited_a($a_id) {
        return $this->favorite_answer()->where('answer_id',$q_id)->exists();
    }

    //add favo
    public function add_favorite_a($a_id) {
        if($this->is_favorited_a($a_id)) {
            return false;
        }else{
            $this->favorite_answer()->attach($a_id);
        }
    }

    //rm favo
    public function rm_favorite_a($a_id){
        if($this->is_favorited_a($a_id)){
            $this->favorite_answer()->detach($a_id);
        }else{
            return false;
        }
    }
    //ここまでAnswer

}
