<?php
namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller{
    public function index (){
        $categories = Category::where('status' , 1)->get();
        return $this->sendResponse($categories , 'categories fetched successfully');
    }
    public function store(){
        $data = request()->validate([
            'title' => ['required'] ,
        ]);
        $data['parent'] = request()['parent'] ?? 0 ;
        $category = Category::create($data);
        return $this->sendResponse($category , 'category create successfully');
    }
    public function update(Category $category){
        $data = request()->validate([
            'title' => ['required'] ,
            'status' => ['required' , 'numeric'] ,
        ]);

        $category->update($data);
        return $this->sendResponse($category , 'category updated successfully');
    }
}
