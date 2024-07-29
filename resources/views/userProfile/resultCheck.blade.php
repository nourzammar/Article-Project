@extends('layouts.app')
@section('style')
@endsection
@section('content')
@include('layouts.message')


<div class="row">
    <div class="col-lg-12">
      <div class="card">
          @include('layouts.message')
        <div class="card-body">
          <h5 class="card-title"> Information about the article
          </h5>

          <!-- Table with stripped rows -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">article type</th>
                <th scope="col">The rate of racism in it</th>
                <th scope="col">The rate of adult in it</th>
              
              </tr>
            </thead>
            <tbody>

                <td>{{$typeArticle}}</td>
                <td>{{$racist}}%</td>
                <td>{{$adult}}%</td>

         
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>



  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          @include('layouts.message')
        <div class="card-body">
          <h5 class="card-title"> Racist and adult words
          </h5>

          <!-- Table with stripped rows -->
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">word type</th>
                <th scope="col">word</th>
                <th scope="col">Probability</th>
              
              </tr>
            </thead>
            <tbody>
              @forelse ( $allTerm as $value)
              <tr>
                  <td>{{$value[0]}}</td>
                  <td>{{$value[1]}}</td>
                  <td>{{$value[2]*100}}%</td>
                  
                </tr>

              @empty
                 <tr>
                  <td colspan="100%"> Record Not Found.</td>
                  </tr> 
              @endforelse
           
         
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>

@endsection
@section('script')
@endsection