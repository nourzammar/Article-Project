<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $table = 'article';
    protected $fillable = ['user_id', 'title', 'slug', 'category_id', 'imge_file', 'description', 'meta_description', 'meta_keywors', 'is_publisg', 'is_delete'];
    static public function getRecord()
    {
        $return = self::select('article.*', 'users.name as user_name', 'category.name as category_name', 'category.slug as category_slug')
                                        ->join('users', 'users.id', '=', 'article.user_id')
                                        ->join('category', 'category.id', '=', 'article.category_id')
                                        ->with('media');
                                        
                                        if(!empty(FacadesRequest::get('id')))
                                        {
                                            $return =$return->where('article.id','=',  FacadesRequest::get('id'));
                                        }
                                        if(!empty(FacadesRequest::get('username')))
                                        {
                                            $return =$return->where('users.name','like', '%'. FacadesRequest::get('username').'%');
                                        }
                                        if(!empty(FacadesRequest::get('title')))
                                        {
                                            $return =$return->where('article.title','like', '%'. FacadesRequest::get('title').'%');
                                        }
                                        if(!empty(FacadesRequest::get('category')))
                                        {
                                            $return =$return->where('category.title','like', '%'. FacadesRequest::get('category').'%');
                                        }
                                        if(!empty(FacadesRequest::get('is_publish')))
                                        {
                                            $is_publish = FacadesRequest::get('is_publish');
                                            if($is_publish ==100)
                                            {
                                                $is_publish=0;
                                            } 
                                            $return =$return->where('article.is_publish','=', FacadesRequest::get('is_publish'));
                                        }
                                        if(!empty(FacadesRequest::get('status')))
                                        {
                                            $status = FacadesRequest::get('status');
                                            if($status ==100)
                                            {
                                                $status=0;
                                            } 
                                            $return =$return->where('article.status','=', FacadesRequest::get('status'));
                                        }
                                    
                                        $return =$return ->where('article.is_delete', '=', 0)
                                        ->orderBy('article.id', 'desc')
                                        ->paginate(30);
                            return  $return; 
    }
    static public function getRecordProfile($userId)
    {
        return self::select('article.*', 'users.name as user_name', 'category.name as category_name', 'category.slug as category_slug')
            ->join('users', 'users.id', '=', 'article.user_id') 
            ->join('category', 'category.id', '=', 'article.category_id')
            ->where('article.status', '=', 1)
            ->where('article.user_id', '=', $userId) 
            ->with('media')
            ->orderBy('article.id', 'desc')
            ->paginate(30);
    }
    
    static public function getRecordSlug($slug)
    {
        return self::select('article.*', 'users.name as user_name', 'category.name as category_name', 'category.slug as category_slug')
            ->join('users', 'users.id', '=', 'article.user_id')
            ->join('category', 'category.id', '=', 'article.category_id')
            ->where('article.is_publish', '=', 1)
            ->where('article.is_delete', '=', 0)
            ->where('article.slug', '=', $slug)
            ->first();
    }
    static public function getLastArticle()
    {
        return self::select('article.*', 'users.name as user_name', 'category.name as category_name', 'category.slug as category_slug')
            ->join('users', 'users.id', '=', 'article.user_id')
            ->join('category', 'category.id', '=', 'article.category_id')
            ->where('article.is_delete', '=', 0)
            
            ->orderBy('article.id', 'desc')
            ->latest('article.id')
            ->with('media')
            ->paginate(3); 
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function getTag()
    {
        return $this->hasMany(ArticleTags::class, 'article_id');
    }
    public function getComment()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }
    static public function getRecordFront()
    {

        $return = self::select('article.*', 'users.name as user_name', 'category.name as category_name', 'category.slug as category_slug')
            ->join('users', 'users.id', '=', 'article.user_id')
            ->join('category', 'category.id', '=', 'article.category_id');
        $return = $return->where('article.status', '=', 1)
            ->where('article.is_publish', '=', 1)
            ->where('article.is_delete', '=', 0)
            ->orderBy('article.id', 'desc')
            ->with('media')
            ->paginate(3);
        return $return;
    }
    static public function getRecordFrontCategory($category_id)
    {
        $return = self::select('article.*', 'users.name as user_name','category.name as category_name', 'category.slug as category_slug')
            ->join('users', 'users.id', '=', 'article.user_id')
            ->join('category', 'category.id', '=', 'article.category_id')
            ->where('article.category_id', '=', $category_id)
            ->where('article.is_publish', '=', 1)
            ->where('article.user_id', '=', 1)
            ->where('article.is_delete', '=', 0)
            ->orderBy('article.id', 'desc')
            ->with('media')
            ->paginate(3);
        return $return;
    }
    static public function getRecentPost()
    {
        return self::select('article.*', 'users.name as user_name', 'category.name as category_name', 'category.slug as category_slug')
            ->join('users', 'users.id', '=', 'article.user_id')
            ->join('category', 'category.id', '=', 'article.category_id')
            ->where('article.status', '=', 0)
            ->where('article.is_publish', '=', 1)
            ->where('article.is_delete', '=', 0)
            ->orderBy('article.id', 'desc')
            ->with('media')
            ->limit(3)
            ->get();
    }
    static public function getRelatedPost($category_id, $id)
    {
        return self::select('article.*', 'users.name as user_name', 'category.name as category_name', 'category.slug as category_slug')
            ->join('users', 'users.id', '=', 'article.user_id')
            ->join('category', 'category.id', '=', 'article.category_id')
            ->where('article.id', '! =', $id)
            ->where('article.category_id', '=', $category_id)
            ->where('article.status', '=', 0)
            ->where('article.is_publish', '=', 1)
            ->where('article.is_delete', '=', 0)
            ->orderBy('article.id', 'desc')
            ->with('media')
            ->limit(3)
            ->get();
    }

 
}
