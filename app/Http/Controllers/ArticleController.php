<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTags;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    
    public function article()
    {
        $data['getRecord'] = Article::getRecord();
        return view('backend.article.list', $data);
    }
    public function add()
    {
        $data['getCategory'] = Category::getCategory();
        return view('backend.article.add', $data);
    }
    public function insert(Request $request)
    {

        $article = new Article;
        $article->user_id = Auth::user()->id;
        $article->title = trim($request->title);
        $article->category_id = trim($request->category_id);
        $article->description = trim($request->description);
        $article->meta_description = trim($request->meta_description);
        $article->meta_keywords = trim($request->meta_keywords);
        $article->is_publish = trim($request->is_publish);
        $article->status = trim($request->status);


        $slug = Str::slug($request->title);
        $checkSlug = Article::where('slug', '=', $slug)->first();
        if (!empty($checkSlug)) {
            $dbslug = $slug . '-' . $article->id;
        }
         else 
        {
            $dbslug = $slug;
        }
        $article->slug = $dbslug;
        $article->imge_file = null;
        $article->save();

        $article->addMedia($request->file('imge_file'))
            ->preservingOriginal()
            ->toMediaCollection();
        ArticleTags::InsertDeleteTag($article->id, $request->tags);
        return redirect('panel/article/list')->with('success', 'Article Successfully Created');
    }
    public function edit($id)
    {
        $data['getCategory'] = Category::getCategory();
        $data['getRecord'] = Article::getSingle($id);
        return view('backend.article.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $article =  Article::getSingle($id);
        $article->title = trim($request->title);
        $article->category_id = trim($request->category_id);
        $article->description = trim($request->description);
        $article->meta_description = trim($request->meta_description);
        $article->meta_keywords = trim($request->meta_keywords);
        $article->is_publish = trim($request->is_publish);
        $article->status = trim($request->status);

        $slug = Str::slug($request->title);
        $checkSlug = Article::where('slug', '=', $slug)->first();
        if (!empty($checkSlug)) {
            $dbslug = $slug . '-' . $article->id;
        }
         else 
        {
            $dbslug = $slug;
        }
        $article->slug = $dbslug;
        $article->imge_file = null;
        $article->save();

        if ($request->hasFile('imge_file')) {
            $article->addMedia($request->file('imge_file')->path())
                ->usingFileName($request->imge_file->hashName())
                ->preservingOriginal()
                ->toMediaCollection();
        }
        
            
        ArticleTags::InsertDeleteTag($article->id, $request->tags);

        return redirect('panel/article/list')->with('success', 'Article Successfully Updated');
    }
    public function delete($id)
    {
        $article = Article::getSingle($id);
        $article->is_delete = 1;
        $article->save();
        return redirect()->back()->with('success', 'Article Successfuly Deleted');
    }
}
