
@extends('layouts.app')
@section('style')
@endsection
@section('content')
   
    <!-- Header Start -->
    <div class="container-fluid bg-primary px-0 px-md-5 mb-5">
      <div class="row align-items-center px-3">
        <div class="col-lg-6 text-center text-lg-left">
          <h4 class="text-white mb-4 mt-5 mt-lg-0">Articles Hub</h4>
          <h1 class="display-3 font-weight-bold text-white">
            Your world of culture
          </h1>
          <p class="text-white mb-4">
            The platform distinguishes itself with its wide diversity of content, featuring detailed educational articles alongside deep analyses of current events and recent developments in various fields. With our team of specialized editors, the platform ensures high-quality content and credibility in the information presented.
          </p>
       
        </div>
        <div class="col-lg-6 text-center text-lg-right">
          <img class="img-fluid mt-5" src="{{url('front/img/header.png')}}" alt="" />
        </div>
      </div>
    </div>
    <!-- Header End -->

    <!-- Facilities Start -->
    <div class="text-center pb-2">
      <p class="section-title px-5">
        <span class="px-2">Category</span>
      </p>
    </div>


    <div class="container-fluid pt-5">
      <div class="container pb-3">
        @php
        $getCategoryHeader = App\Models\Category::getCategorymenu();
        @endphp
       
        <div class="row">
          @foreach ($getCategoryHeader as $categoryHeader  )
          <div class="col-lg-4 col-md-6 pb-1">
            <div
              class="d-flex bg-light shadow-sm border-top rounded mb-4"style="padding: 30px">
              <i class="flaticon-050-fence h1 font-weight-normal text-primary mb-3"></i>
              <div class="pl-4">
               <a href="{{url($categoryHeader->slug)}}"> <h4>{{$categoryHeader->name}}</h4></a>
                <p class="m-0">
                  {{$categoryHeader->title}}
                </p>
              </div>
            </div>
          </div>
         @endforeach
        </div>

        
      </div>
    </div>

  

    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
      <div class="container p-0">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Testimonial</span>
          </p>
          <h1 class="mb-4">What users Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel">
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle"
                src="{{url('front/img/testimonial-1.jpg')}}"
                style="width: 70px; height: 70px"
                alt="Image"
              />
              <div class="pl-3">
                <h5>sara</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle"
                src="{{url('front/img/testimonial-2.jpg')}}"
                style="width: 70px; height: 70px"
                alt="Image"
              />
              <div class="pl-3">
                <h5>nour</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle"
                src="{{url('front/img/testimonial-1.jpg')}}"
                style="width: 70px; height: 70px"
                alt="Image"
              />
              <div class="pl-3">
                <h5>ali</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
          <div class="testimonial-item px-3">
            <div class="bg-light shadow-sm rounded mb-4 p-4">
              <h3 class="fas fa-quote-left text-primary mr-3"></h3>
              Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr
              eirmod clita lorem. Dolor tempor ipsum clita
            </div>
            <div class="d-flex align-items-center">
              <img
                class="rounded-circle"
                src="{{url('front/img/testimonial-1.jpg')}}"
                style="width: 70px; height: 70px"
                alt="Image"
              />
              <div class="pl-3">
                <h5>lara</h5>
                <i>Profession</i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Testimonial End -->

    <!-- Blog Start -->
    
      
    
    <div class="container-fluid pt-5">
      <div class="container">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Latest Blog</span>
          </p>
          <h1 class="mb-4">Latest Articles From Blog</h1>
        </div>
        <div class="row pb-3"> 
         @foreach ($getLastArticle as $value )
          
          
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
                  <small class="mr-3"
                    ><i class="fa fa-folder text-primary"></i> {{$value->category_name}}</small
                  >
                  <small class="mr-3"
                    ><i class="fa fa-comments text-primary"></i> 15</small
                  >
                </div>
                <p>
                  {!!strip_tags(Str::substr($value->description,0,165))!!}...
                </p>
                <a href="{{url($value->slug)}}" class="btn btn-primary px-4 mx-auto my-2"
                  >Read More</a
                >
              </div>
            </div>
          </div>
        @endforeach
        </div>
      </div>
    </div>
    
    <!-- Blog End -->

   @endsection
   @section('script')
@endsection
