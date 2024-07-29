
@extends('backend.layouts.app')
@section('content')
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            @include('layouts.message')
          <div class="card-body">
            <h5 class="card-title"> Comment List
                
            </h5>
         
            <hr />
            <!-- Table with stripped rows -->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th >#</th>
                  <th >UserName</th>
                  <th >Article name</th>
                  <th >Comment</th>
                </tr>
              </thead>
              <tbody>
                @forelse ( $getRecord as $value)
                <tr>
                    <th scope="row">{{$value->id}}</th>
                    <td>{{$value->user_id}}</td>
                    <td>{{$value->article_id}}</td>                                      
                    <td>{{$value->comment}}</td>
                    <td>
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