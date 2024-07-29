
@extends('backend.layouts.app')
@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            @include('layouts.message')
          <div class="card-body">
            <h5 class="card-title"> add term
              
            </h5>
            <form class="row " method="POST" action="{{Route('addTerm')}}">
              
            @csrf

              <div class="col-md-2" style="margin-bottom:10px;">
                <label  class="form-label">Term</label>
                <input type="text" name="term"  class="form-control" >
              </div>

             
              <div class="col-md-2" style="margin-bottom:10px;">
                <label  class="form-label">word type</label>
                <select class="form-control" name="type">
                  <option  value="">Select</option>
                  <option  value="1">racist</option>
                  <option  value="0">adult</option>
                 </select>
              </div>

              <div class="col-md-2" style="margin-bottom:10px;">
                <label  class="form-label">Probability</label>
                <input type="double" name="Probability"  class="form-control" >
              </div>

              <br></br>
              <br></br>
              <div class="row-md-3" style="margin-bottom:10px;">
                <button type="submit" class="btn btn-primary">add</button>
              </div>

            </form>
            <hr />
            <!-- Table with stripped rows -->
            

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection

@section('script')
@endsection