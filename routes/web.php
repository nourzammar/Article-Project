<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\DatasetController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class ,'index']);


Route::get('profile', [ProfileController::class ,'index']);
Route::get('profile/add', [ProfileController::class ,'add']);
Route::get('profile/check', [ProfileController::class ,'check']);

Route::post('profile/check/result', [ProfileController::class ,'result'])->name('result');

Route::post('profile/add', [ProfileController::class ,'insert']);
Route::get('profile/edit/{id}', [ProfileController::class ,'edit']);
Route::post('profile/edit/{id}', [ProfileController::class ,'update']);
Route::post('profile/delete/{id}', [ProfileController::class ,'delete']);


Route::get('login', [AuthController::class ,'login']);
Route::post('login', [AuthController::class ,'auth_login']);
Route::get('register', [AuthController::class ,'register']);
Route::post('register', [AuthController::class ,'creat_user']);
Route::get('forgot-password', [AuthController::class ,'forgot']);
Route::get('logout', [AuthController::class ,'logout']);


Route::get('home', [HomeController::class ,'index']);
Route::get('article', [HomeController::class ,'article']);
Route::get('{slug}', [HomeController::class ,'article_detail']);


Route::group(['middleware'=> 'adminuser'], function(){
Route::get('panel/dashboard',[DashController::class ,'dashboard']);
Route::get('panel/user/list',[UserController::class ,'user']);
Route::get('panel/user/add',[UserController::class ,'add']);
Route::post('panel/user/add',[UserController::class ,'insert']);
Route::get('panel/user/edit/{id}', [UserController::class ,'edit']);
Route::post('panel/user/edit/{id}', [UserController::class ,'update']);
Route::get('panel/user/delete/{id}',[UserController::class ,'delete']);

Route::post('article-comment',[HomeController::class ,'article_comment']);

Route::get('panel/comment/list', [CommentController::class ,'view']);

Route::get('panel/category/list',[CategoryController::class ,'category']);
Route::get('panel/category/add',[CategoryController::class ,'add']);
Route::post('panel/category/add',[CategoryController::class ,'insert']);
Route::get('panel/category/edit/{id}', [CategoryController::class ,'edit']);
Route::post('panel/category/edit/{id}', [CategoryController::class ,'update']);
Route::get('panel/category/delete/{id}',[CategoryController::class ,'delete']);

Route::get('panel/article/list',[ArticleController::class ,'article']);
Route::get('panel/article/add',[ArticleController::class ,'add']);
Route::post('panel/article/add',[ArticleController::class ,'insert']);
Route::get('panel/article/edit/{id}', [ArticleController::class ,'edit']);
Route::post('panel/article/edit/{id}', [ArticleController::class ,'update']);
Route::get('panel/article/delete/{id}',[ArticleController::class ,'delete']);


Route::get('panel/term/add',[TermController::class ,'index']);
Route::post('panel/term/addTerm',[TermController::class ,'add'])->name("addTerm");


Route::get('panel/dataset/get',[DatasetController::class ,'index']);
Route::post('panel/dataset/update',[DatasetController::class ,'update'])->name('update');







});