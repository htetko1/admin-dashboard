<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $articles =Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->with(['user','category'])->latest()->paginate(7);
        return view('welcome',compact('articles'));
    }

    public function detail($slug){

        $article = Article::where("slug",$slug)->first();
        if (empty($article)){
            return abort('404');
        }

        return view('blog.detail',compact('article'));
    }


    public function baseOnCategory($slug){
        $category = Category::where("slug",$slug)->first();
        if (empty($category)){
            return abort('404');
        }

        $articles =Article::when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->where("category_id","$slug")->with(['user','category'])->latest()->paginate(7);
        return view('welcome',compact('articles'));
    }

    public function baseOnUser($id){
        $articles =Article::where("user_id","$id")->when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->with(['user','category'])->latest()->paginate(7);
        return view('welcome',compact('articles'));
    }

    public function baseOnDate($date){
        $articles =Article::where("created_at","$date")->when(isset(request()->search),function ($q){
            $search = request()->search;
            $q->orwhere("title","like","%$search%")->orwhere("description","like","%$search%");
        })->with(['user','category'])->latest()->paginate(7);
        return view('welcome',compact('articles'));
    }
}
