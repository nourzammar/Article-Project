<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = ['name', 'title','meta_title' ,'meta_description' ,'meta_keyword', 'status' ,'slug'];
    static public function getRecord()
    {
        return self::select('category.*')
                    ->where('is_delete', '=', 0)
                    ->orderBy('id', 'desc')
                    ->paginate(30);
        
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getCategory()
    {
        return self::select('category.*')
        ->where('is_delete', '=', 0)
        ->where('status', '=', 0)
        ->get();  
    }
    public function totalArticle()
    {
        return $this->hasMany(Article::class, 'category_id')
                    
                    ->where('article.is_publish','=',1)
                    ->where('article.is_delete','=',0)
                    ->count();
    }
    static public function getCategorymenu()
    {
        return self::select('category.*')
        ->where('is_delete', '=', 0)
        ->where('is_menu', '=', 1)
        ->where('status', '=', 0)
        ->get();
    }
    static public function getSlug($slug)
    {
        return self::select('category.*')
        ->where('slug', '=', $slug)
        ->where('status', '=', 0)
        ->first();
    }
 
}
