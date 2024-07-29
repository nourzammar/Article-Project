
@extends('backend.layouts.app')
@section('content')
<section class="section">
    <div class="row">
   

      <div class="col-lg-12">

        <div class="card">
            
          <div class="card-body">
            
            <h5 class="card-title">Edit Users</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="" method="POST">
                @csrf
              <div class="col-12">
                <label for="inputNanme4" class="form-label"> Name</label>
                <input type="text" class="form-control" value="{{$getRecord->name}}" name="name" required id="inputNanme4">
                <div style="color: red">{{$errors->first('name')}}</div>
              </div>
              <div class="col-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{$getRecord->email}}" required id="inputEmail4">
                <div style="color: red">{{$errors->first('email')}}</div>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password"  name="password" class="form-control" id="inputPassword4">
                <p style="margin-bottom:0px; margin-top:5px; font-size:14px;">Do Tou Want Change Password So Pless Fill Password Input Box</p>
              </div>
              <div class="col-12">
                <label for="inputPassword4" class="form-label">Status</label>
               <select class="form-control" name="status" id="">
                <option {{($getRecord->status ==0)? 'selected' :'' }} value="0">Active</option>
                <option  {{($getRecord->status ==1)? 'selected' :'' }} value="1">Inactive</option>
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