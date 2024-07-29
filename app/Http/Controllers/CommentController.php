<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
 public function view()
 {
    $data['getRecord']= Comment::comment();
    
    return view('backend.comment.list', $data);
 }
}
