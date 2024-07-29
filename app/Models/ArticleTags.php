<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTags extends Model
{
    use HasFactory;
    protected $table='article_tags';
    protected $fillable =['article_id'];
    static public function InsertDeleteTag($article_id, $tags)
    {
        ArticleTags::where('article_id', '=', $article_id)->delete();
        if(!empty($tags))
        {
            $tagsarray= explode(",", $tags);
            foreach($tagsarray as $tag)
            {
                $article =new ArticleTags;
                $article->article_id =$article_id;
                $article->name = $tag;
                $article->save();
            }
        }
    }
    public function getTag()
    {
        return $this->belongsTo(Article::class);
    }
}
