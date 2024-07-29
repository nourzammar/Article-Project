@extends('layouts.app')
@section('style')
   <link rel="stylesheet" href="{{url('assets/tagsinput/bootstrap-tagsinput.css')}}">

@section('content')

  <section class="section">
  <div class="row">
 

    <div class="col-lg-12">

      <div class="card">
          
        <div class="card-body">
          
          <h5 class="card-title">Add New Article</h5>

          <!-- Vertical Form -->
          <form class="row g-3" action="" method="POST" enctype="multipart/form-data">
              @csrf
         
         
            <div class="col-12">
              <label  class="form-label">Title</label>
              <input type="text" required name="title" class="form-control" id="inputPassword4">
              <div style="color: red">{{$errors->first('title')}}</div>
            </div>
            <div class="col-12">
              <label  class="form-label">Category</label>
              <select class="form-control" name="category_id" id="">
                  <option>Selcet Category</option>
                  @foreach ($getCategory as $value )
                  <option value="{{$value->id}}">{{$value->name}}</option>  
                  @endforeach
              </select>
            </div>
            
            <div class="col-12">
              <label  class="form-label">Image</label>
             <input type="file" class="form-control" name="imge_file" required>
            </div>

            <div class="col-12">
              <label  class="form-label">Description</label>
             <textarea class="form-control tinymce-editor" name="description" ></textarea>
            </div>

            <div class="col-12">
              <label  class="form-label">Tags</label>
             <input type="text" id="tags" class="form-control" name="tags" required>
            </div>


            <div class="col-12">
              <label  class="form-label">Meta Description</label>
              <input type="text" required name="meta_description" value="{{old('meta_keywords')}}" class="form-control" id="inputPassword4">
              <div style="color: red">{{$errors->first('meta_description')}}</div>
            </div>
            <div class="col-12">
              <label  class="form-label">Meta Keywords</label>
              <input type="text" required name="meta_keywords" class="form-control" id="inputPassword4">
              <div style="color: red">{{$errors->first('meta_keywords')}}</div>
            </div>
           
            
            <div class="col-12" style="margin-top:30px;">
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
<script src="{{url('assets/tagsinput/bootstrap-tagsinput.js')}}"></script>
<script>$("#tags").tagsinput();</script>
@endsection
