
@extends('backend.layouts.app')
@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            @include('layouts.message')
          <div class="card-body">
            <h5 class="card-title">Users List
                <a href="{{url('panel/user/add')}}" class="btn btn-primary" style="float: right">Add New user</a>
            </h5>

            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Status</th>
                  <th scope="col">Created Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse ( $getRecord as $value)
                <tr>
                    <th scope="row">{{$value->id}}</th>
                    <td>{{$value->name}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{!empty($value->status)? 'inactive' : 'Active'}}</td>
                    <td>{{date('d-m-Y H:i A' , strtotime($value->created_at))}}</td>
                    <td>
                        <a href="{{url('panel/user/edit/'.$value->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <a onclick="return confirm('Are You Sure You Want To Delete?');" href="{{url('panel/user/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a>
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