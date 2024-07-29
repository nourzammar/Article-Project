@extends('layouts.app')
@section('style')
@endsection
@section('content')
@include('layouts.message')


<div class="row">
   

    <div class="col-lg-12">

      <div class="card">
          
        <div class="card-body">
          
          <h5 class="card-title">check Article</h5>

          <!-- Vertical Form -->
          <form class="row g-3" action="{{Route('result')}}" method="POST" enctype="multipart/form-data">
              @csrf

            <div class="col-12">
              {{-- <label  class="form-label">Description</label> --}}
             <textarea class="form-control tinymce-editor" name="article" ></textarea>
            </div>
            
            <div class="col-12" style="margin-top:30px;">
              <button type="submit" class="btn btn-primary">check article</button>
            </div>

          </form><!-- Vertical Form -->

        </div>
      </div>


    </div>
  </div>



@endsection
@section('script')
@endsection