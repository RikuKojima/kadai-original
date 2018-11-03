<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['to_id','user_id','content'];

    //userに所属
    public function user() {
        return $this->belongsTo('App\User');
    }

    //questionに所属
    public function question(){
        return $this->belongsTo('App\Question', 'to_id', 'id');
    }


    //answersfavoriteに多数たい多数
    public function favorited() {
        return $this->belongsToMany('App\User','answer_favorite','answer_id','user_id');
    }


}
