<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\UserLikePost;
use App\Models\UserLikePosts;
use App\Models\UserViewPost;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller{
    public function index (){
        $posts = Post::where('status' , 1)->paginate(20);


        return $this->sendResponse($posts , 'posts fetched successfully');
    }
    public function store(){
        $data = Validator::make( request()->all() , [
            'title' => ['string' , 'required'],
            'description' => ['string' , 'required'],
            'category_id' => ['required' , 'integer' , 'exists:categories,id']
        ]);
        if ($data->fails()) {
            return $this->sendError($data->errors() , 'errors') ;
        }
        $data =  $data->validated();
        $data['user_id'] = auth()->id();
        $light = Post::create($data);
        return $this->sendResponse($light , 'post created successfully');
    }
    public function update( Post $post){
        $data = request()->validate([
            'title' => ['string' , 'required'],
            'description' => ['string' , 'required'],
            'category_id' => ['required' , 'integer' , 'exists:categories,id']
        ]);
        $data['user_id'] = auth()->id();
        $post->update($data);
        return $this->sendResponse($post , 'light created successfully');
    }
    public function likePost( Post $post){
        $like = UserLikePost::where('user_id' , auth()->id() )->where('post_id' , $post->id)->first() ;
        if ($like) {
            $like->delete() ;
            return $this->sendResponse($like , 'like removed successfylly');
        }else{
            $like = UserLikePost::create([
                'post_id' => $post->id ,
                'user_id' => auth()->id() ,
            ]);
            return $this->sendResponse($like , 'post created successfully');
        }
    }
    public function viewPost( Post $post){
        $view = UserViewPost::where('user_id' , auth()->id() )->where('post_id' , $post->id)->first() ;
        if ($view) {
            return $this->sendResponse($post , 'view alredy exists');
        }else{
            $view = UserViewPost::create([
                'post_id' => $post->id ,
                'user_id' => auth()->id() ,
            ]);
            return $this->sendResponse($view , 'view assigned successfully');
        }
    }
}
