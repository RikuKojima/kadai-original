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
        return $this->hasMany('App\LinkedSocialAccount');
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
}
