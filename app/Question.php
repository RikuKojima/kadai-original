<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['content','user_id','field'];
    
    // userに所属
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    //answerを多数もつ
    public function answers() {
        return $this->hasMany('App\Answer');
    }
    
    //question_favorteでmanyTomany
    public function favorited() {
        return $this->belongsToMany('App\User','question_favorte','question_id','user_id');
    }
    
}
