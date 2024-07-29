@extends('layouts.app')
@section('style')
@endsection
@section('content')
@include('layouts.message')
<a href="{{url('profile/add')}}" class="btn btn-primary px-4" style="margin-top: 20px; float: right; ">Add Article</a>

<div class="container-fluid pt-5">
    <div class="container">
      <div class="text-center pb-2">
        <p class="section-title px-5">
          <span class="px-2">MY Article</span>
        </p>
    
      </div>
      <div class="row pb-3">
      @foreach ( $getRecord as $value )
        
      <div class="col-lg-4 mb-4">
                
        <div class="card border-0 shadow-sm mb-2">
          <img class="card-img-top mb-2" src="{{$value->getFirstMediaUrl()}}" style="height: 233px; width:100%; object-fit:cover;"/>
          <div class="card-body bg-light text-center p-4">
          <a href="{{url($value->slug)}}">
              <h4 class="">{!!strip_tags(Str::substr($value->title,0,40))!!}...</h4>
          </a>
            <div class="d-flex justify-content-center mb-3">
              <small class="mr-3"
                ><i class="fa fa-user text-primary"></i> {{$value->user_name}}</small
              >
              <small class="mr-3">
               <a href="{{url($value->category_slug)}}"> <i class="fa fa-folder text-primary"></i> {{$value->category_name}}</a>
              </small>
              <small class="mr-3"
                ><i class="fa fa-comments text-primary"></i> 0</small
              >
            </div>
            <p>
              {!!strip_tags(Str::substr($value->description,0,165))!!}...
            </p>
            <a href="{{url($value->slug)}}" class="btn btn-primary px-4 mx-auto my-2">Read More</a>
            <br>
            <a onclick="return confirm('Are You Sure You Want To Delete?');" href="{{url('panel/article/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
            <a href="{{url('profile/edit/'.$value->id)}}" class="btn btn-primary px-4 mx-auto my-2">Edit</a>
          </div>
          
          
          
        </div>
      </div>
      @endforeach
    </div>
  </div>

@endsection
@section('script')
@endsection