
@extends('backend.layouts.app')
@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            @include('layouts.message')
          <div class="card-body">
            <h5 class="card-title"> Article List
                <a href="{{url('panel/article/add')}}" class="btn btn-primary" style="float: right">Add New Article</a>
            </h5>
            <form class="row " accept="get">
              <div class="col-md-1" style="margin-bottom:10px;">
                <label  class="form-label">ID</label>
                <input type="text" name="id" value="{{Request::get('id')}}" class="form-control" >
              </div>
              <div class="col-md-2" style="margin-bottom:10px;">
                <label  class="form-label">UserName</label>
                <input type="text" name="username" value="{{Request::get('username')}}" class="form-control" >
              </div>
              <div class="col-md-2" style="margin-bottom:10px;">
                <label  class="form-label">Title</label>
                <input type="text" name="title" value="{{Request::get('title')}}" class="form-control">
              </div>
              <div class="col-md-2" style="margin-bottom:10px;">
                <label  class="form-label">Category</label>
                <input type="text" name="category" value="{{Request::get('category')}}" class="form-control" >
              </div>
              <div class="col-md-2" style="margin-bottom:10px;">
                <label  class="form-label">Status</label>
                <select class="form-control" name="status" id="">
                  <option  value="">Select</option>
                  <option {{(Request::get('status')==0)? 'selected' : ''}} value="0">Active</option>
                  <option {{(Request::get('status')==1)? 'selected' : ''}} value="1">InActive</option>
                 </select>
              </div>
              <div class="col-md-2" style="margin-bottom:10px;">
                <label  class="form-label">Publish</label>
                <select class="form-control" name="is_publish" id="">
                  <option  value="">Select</option>
                  <option {{(Request::get('is_publish')==1)? 'selected' : ''}}  value="1">Yes</option>
                  <option  {{(Request::get('is_publish')==100)? 'selected' : ''}} value="100">NO</option>
                 </select>
              </div>
              <br></br>
              <br></br>
              <div class="col-md-3" style="margin-bottom:10px;">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{url('panel/article/list')}}" class="btn btn-secondary">Reset</a>
              </div>
            </form>
            <hr />
            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Image</th>
                  <th scope="col">UserName</th>
                  <th scope="col">Title</th>
                  <th scope="col">Category</th>
                  <th scope="col">Status</th>
                  <th scope="col">Publish</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ( $getRecord as $value)
                <tr>
                    <th scope="row">{{$value->id}}</th>
                    <td>
                      <img src="{{$value->getFirstMediaUrl()}}" style="height: 100px; width:100px; ">
                  </td>
                    <td>{{$value->user_name}}</td>
                    <td>{{$value->title}}</td>                  
                    <td>{{$value->category_name}}</td>                                      
                    <td>{{!empty($value->status)? 'InActive' : 'Active'}}</td>
                    <td>{{!empty($value->is_publish)? 'Yes' : 'No'}}</td>
                    <td>{{date('d-m-Y H:i A' , strtotime($value->created_at))}}</td>
                    <td>
                        <a href="{{url('panel/article/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a onclick="return confirm('Are You Sure You Want To Delete?');" href="{{url('panel/article/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                  </tr>
                @empty
                   <tr>
                    <td colspan="100%"> Record Not Found.</td>
                    </tr> 
                @endforelse
             
             
           
              </tbody>
            </table>
            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection

@section('script')
@endsection