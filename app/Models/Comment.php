<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table='comment';
    protected $fillable =['article_id'];
    
    
    public function getComment()
    {
        return $this->belongsTo(Article::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    static public function getRecord()
    {
        return self::select('commnet.*', 'article.name as article_name', 'users.name as user_name')
        ->join('users', 'users.id', '=', 'comment.user_id') 
        ->join('article', 'article.id', '=', 'comment.article_id')  
        ->orderBy('comment.id', 'desc')
        ->paginate(30);
    }
    static public function comment()
    {
        return self::select('comment.*')
        ->join('article', 'article.id', '=', 'comment.article_id')  
        ->orderBy('comment.id', 'desc')
        ->paginate(30);

    }
}
