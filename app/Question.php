<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use cebe\markdown\Markdown as Markdown;
use Controller;

class Question extends Model
{
    use \Conner\Tagging\Taggable;

    
    protected $fillable = ['content','user_id','title'];
    //これさえ設定されていればcreateメソッドを使うことができる

    // userに所属
    public function user() {
        return $this->belongsTo('App\User');
    }


    //answerを多数もつ
    public function answers() {
      #命名規則を無視してしまったのでちょっとめんどくさい事になってしまっている。
        return $this->hasMany('App\Answer', 'to_id','id');
    }

    //question_favorteでmanyTomany
    public function favorited() {
        return $this->belongsToMany('App\User','question_favorte','question_id','user_id');


    }

    public function tags() {
      return $this->belongsToMany('\App\Tag','question_tags','question_id','tag_id')->withTimestamps();
    }

    // マークダウン処理
    public function parse() {
      $parser = new Markdown();
      return $parser->parse($this->content);
    }

    public function getMarkContentAttribute(){
      return $this->parse();
    }
}
