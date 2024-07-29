
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

        @forelse ($articles as $index => $article)
        <div class="card">
          @include('layouts.message')
          <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                  <h1 class="card-title">{{$article[3]}} Article</h1>
              </div>
              <p class="card-text">
                <b>{{$article[0]}}</b>
            </p>

              <form method="POST" action="{{Route('update')}}">
                @csrf
                <div class="form-group mt-3 d-flex align-items-center">
                  <label class="form-label me-3" style="white-space: nowrap;">Probability of Racism in the Article</label>
                  <input type="number" step="0.01" class="form-control" value="{{$article[1]}}" name="racism" placeholder="Possibility of racism in the article">
              </div>
          
              <div class="form-group mt-3 d-flex align-items-center">
                  <label class="form-label me-3" style="white-space: nowrap;">Probability of Adult in the Article</label>
                  <input type="number" step="0.01" class="form-control" value="{{$article[2]}}" name="adult" placeholder="Possibility of adult in the article">
              </div>

                 
              <div class="form-group mt-3 d-flex align-items-center">
                <label  class="form-label me-3" style="white-space: nowrap;">Article Type</label>
              <select class="form-control" name="type">
                <option  value="">Select</option>
                <option  value="1">Racist</option>
                <option  value="0">Adult</option>
                <option  value="2">Normal</option>
               </select>
            </div>

            <div class="form-group mt-3 d-flex align-items-center">
              <label  class="form-label me-3" style="white-space: nowrap;">Classification Mode</label>
            <select class="form-control" name="model">
              <option  value="">Select Mode</option>
              <option  value="0">Expert</option>
              <option  value="1">Depend on Model</option>
             </select>
          </div>

           
               <div class="form-group mt-3">
                <input type="hidden" class="form-control" name="index" value={{$index}} >
               </div>

 
                <input type="hidden"  name="article" value="{{$article[0]}}" >
                

              <button  class="btn btn-primary mt-3">Update article </button>

              </form>
              
              

          </div>
      </div>
      
    @empty
        <div>
            <p>Record Not Found.</p>
        </div>
    @endforelse
    
      

      </div>
    </div>
  </section>

@endsection

@section('script')
@endsection