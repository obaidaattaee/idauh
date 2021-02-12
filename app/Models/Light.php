<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    use HasFactory;
    public $with = ['user' , 'likes' , 'views'];
    protected $guarded = [] ;


    public function user (){
        return $this->belongsTo('App\Models\User' , 'user_id' , 'id');
    }
    public function likes(){
        return $this->belongsToMany('App\Models\User' , 'user_like_lights' , 'light_id' , 'user_id');
    }
    public function views(){
        return $this->belongsToMany('App\Models\User' , 'user_view_lights' , 'user_id' , 'id');
    }
    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }
}
