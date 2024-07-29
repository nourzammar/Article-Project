<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data['getLastArticle']=Article::getLastArticle();
        $data['meta_title']='Article';
        return view('home', $data);
    }
   
    public function article()
    {
        $data['getRecord']= Article::getRecordFront();
       return view('article' , $data);
    }
    public function article_detail($slug)
    {

        $getCategory =Category::getSlug($slug);
        if(!empty($getCategory))
        {
            $data['meta_title']=$getCategory->meta_title;
            $data['meta_description']=$getCategory->meta_description;
            $data['meta_keywords']=$getCategory->meta_keywords;
            $data['header_title']=$getCategory->title;
            $data['getRecord']= Article::getRecordFrontCategory($getCategory->id);
            return view('article' , $data);
        }
        else
        {
           
            $getRecord= Article::getRecordSlug($slug);
            if(!empty($getRecord))
            {
                
                $data['getCategory']=Category::getCategory();
                $data['getRecentPost']=Article::getRecentPost();
                $data['getRelatedPost']=Article::getRelatedPost($getRecord->category_id, $getRecord->id);
                $data['getRecord']= $getRecord;
                $data['meta_title']=$getRecord->meta_title;
                $data['meta_description']=$getRecord->meta_description;
                $data['meta_keywords']=$getRecord->meta_keywords;
                return view('article_detail' , $data);
            }
            else
            {
                abort(404);
            }   
        }
 
       
    }
    public function article_comment(Request $request)
    {
        $comment= new Comment;
        $comment->user_id =Auth::user()->id;
        $comment->article_id =$request->article_id;
        $comment->comment =$request->comment;
        $comment->save();
        return redirect()->back()->with('success', 'Your Comment Successfuly');

    }
   
}
