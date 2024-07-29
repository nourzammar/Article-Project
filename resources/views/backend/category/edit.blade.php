
@extends('backend.layouts.app')
@section('content')
<section class="section">
    <div class="row">
   

      <div class="col-lg-12">

        <div class="card">
            
          <div class="card-body">
            
            <h5 class="card-title">Add New Category</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="" method="POST">
                @csrf
              <div class="col-12">
                <label for="inputNanme4" class="form-label"> Name</label>
                <input type="text" class="form-control" value="{{$getRecord->name}}" name="name" required id="inputNanme4">
                <div style="color: red">{{$errors->first('name')}}</div>
              </div>
              <div class="col-12">
                <label  class="form-label">Slug</label>
                <input type="text" class="form-control" value="{{$getRecord->slug}}" name="slug" required id="inputEmail4">
                <div style="color: red">{{$errors->first('slug')}}</div>
              </div>
              <div class="col-12">
                <label  class="form-label">Title</label>
                <input type="text" required value="{{$getRecord->title}}" name="title" class="form-control" id="inputPassword4">
                <div style="color: red">{{$errors->first('title')}}</div>
              </div>
              <div class="col-12">
                <label  class="form-label">Meta Title</label>
                <input type="text" required value="{{$getRecord->meta_title}}" name="meta_title" class="form-control" id="inputPassword4">
                <div style="color: red">{{$errors->first('meta_title')}}</div>
              </div>
              <div class="col-12">
                <label  class="form-label">Meta Description</label>
                <input type="text" required value="{{$getRecord->meta_description}}" name="meta_description" class="form-control" id="inputPassword4">
                <div style="color: red">{{$errors->first('meta_description')}}</div>
              </div>
              <div class="col-12">
                <label  class="form-label">Meta Keywords</label>
                <input type="text" required value="{{$getRecord->meta_keyword}}" name="meta_keyword" class="form-control" id="inputPassword4">
                <div style="color: red">{{$errors->first('meta_keyword')}}</div>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Status</label>
               <select class="form-control" name="status" id="">
                <option {{($getRecord->status ==1)? 'selected' :'' }} value="0">Active</option>
                <option  {{($getRecord->status ==0)? 'selected' :'' }} value="1">Inactive</option>
               </select>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Menu</label>
               <select class="form-control" name="is_menu" id="">
                <option {{($getRecord->is_menu ==1)? 'selected' :'' }} value="0">No</option>
                <option  {{($getRecord->is_menu ==0)? 'selected' :'' }} value="1">Yes</option>
               </select>
              </div>
              
              
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
                
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>
    </div>
  </section>
@endsection

@section('script')
@endsection