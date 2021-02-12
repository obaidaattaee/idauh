<?php
namespace App\Http\Controllers;

use App\Models\Light;
use App\Models\UserLikeLight;
use App\Models\UserViewLight;
use App\Models\UserViewPost;

class LightController extends Controller{
    public function index(){
        $lights = Light::where('status' , 1)->get();


        return $this->sendResponse($lights , 'lights fetched successfully');
    }
    public function store(){
        $data = request()->validate([
            'description' => ['string' , 'required'],
        ]);
        $data['user_id'] = auth()->id();
        $light = Light::create($data);
        return $this->sendResponse($light , 'light created successfully');
    }
    public function update( Light $light){
        $data = request()->validate([
            'description' => ['string' , 'required'],
        ]);
        $data['user_id'] = auth()->id();
        $light->update($data);
        return $this->sendResponse($light , 'light created successfully');
    }
    public function likeLight( Light $light){
        $like = UserLikeLight::where('user_id' , auth()->id() )->where('light_id' , $light->id)->first() ;
        if ($like) {
            $like->delete() ;
            return $this->sendResponse($light , 'like removed successfylly');
        }else{
            $like = UserLikeLight::create([
                'light_id' => $light->id ,
                'user_id' => auth()->id() ,
            ]);
            return $this->sendResponse($like , 'light created successfully');
        }
    }
    public function viewLight( Light $light){
        $view = UserViewLight::where('user_id' , auth()->id() )->where('light_id' , $light->id)->first() ;
        if ($view) {
            return $this->sendResponse($light , 'view alredy exists');
        }else{
            $view = UserViewLight::create([
                'light_id' => $light->id ,
                'user_id' => auth()->id() ,
            ]);
            return $this->sendResponse($view , 'view assigned successfully');
        }
    }
}
