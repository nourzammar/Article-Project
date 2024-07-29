<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 public function category()
 {
    $data['getRecord']=Category::getRecord();
    return view('backend.category.list' ,$data);
 }
 public function add()
 {
    return view('backend.category.add');
 }
 public function insert(Request $request)
 {  
     $category = new Category;
     $category->name= $request->name;
     $category->slug = $request->slug;
     $category->title= $request->title;
     $category->meta_title = $request->meta_title;
     $category->meta_description = $request->meta_description;
     $category->meta_keyword = $request->meta_keyword;
     $category->status = $request->status;
     $category->is_menu = $request->is_menu;
     $category->save();
     return redirect('panel/category/list')->with('success', 'category Successfully Created');
 }
 public function edit($id)
 {
     $getRecord['getRecord'] = Category::getSingle($id);
     return view('backend.category.edit' ,$getRecord);
   
 }
 public function update($id , Request $request)
 {
   $category =  Category::getSingle($id);
     $category->name= $request->name;
     $category->slug = $request->slug;
     $category->title= $request->title;
     $category->meta_title = $request->meta_title;
     $category->meta_description = $request->meta_description;
     $category->meta_keyword = $request->meta_keyword;
     $category->status = $request->status;
     $category->is_menu = $request->is_menu;
     $category->save();
     return redirect('panel/category/list')->with('success', 'category Successfully Created');
 }
 public function delete($id)
 {
     $category = Category::getSingle($id);
     $category->is_delete = 1;
     $category->save();
     return redirect('panel/category/list')->with('error', 'Category Successfully Deleted');
 }
}
