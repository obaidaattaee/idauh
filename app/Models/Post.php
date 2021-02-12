<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $with = ['user' , 'likes' , 'views' , 'category'];
    use HasFactory;
    protected $guarded = [] ;
    public function user (){
        return $this->belongsTo('App\Models\User' , 'user_id' , 'id');
    }
    public function likes(){
        return $this->belongsToMany('App\Models\User' , 'user_like_posts' , 'post_id' , 'user_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category' , 'category_id' , 'id');
    }
    public function views(){
        return $this->belongsToMany('App\Models\User' , 'user_view_posts' , 'post_id' , 'user_id');
    }
    // public function getCreatedAtAttribute(){
    //     return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    // }
}
