@extends('layouts.app')
@section('style')
@endsection
@section('content')
          <!-- Header Start -->

      <!-- Header End -->
  
      <!-- Detail Start -->
      <div class="container py-5">
        <div class="row ">
          <div class="col-lg-8">
            @include('layouts.message')
            <div class="d-flex flex-column text-left mb-3">
              <h1 class="mb-3">{{$getRecord->title}}</h1>
              <div class="d-flex">
                <p class="mr-3"><i class="fa fa-user text-primary"></i> {{$getRecord->title}}</p>
                <p class="mr-3">
                  <i class="fa fa-folder text-primary"></i> {{$getRecord->user_name}} 
                </p>
                <p class="mr-3"><i class="fa fa-comments text-primary"></i> {{$getRecord->category_name}}</p>
              </div>
            </div>
            <div class="mb-5">
              
              <img style="max-height: 500px; object-fit:cover;"
                class="img-fluid rounded w-100 mb-4" src="{{$getRecord->getFirstMediaUrl()}}" alt="Image"/>
              
              {!! $getRecord->description!!}
             
            </div>
  
            <!-- Related Post -->
            @if (!empty($getRelatedPost->count()))
              
          
            @endif  
            <!-- Comment List -->
            <div class="mb-5">
              <h2 class="mb-4">{{$getRecord->getComment->count() }} Comments</h2>
              @foreach ($getRecord->getComment as $value)
                
              
              <div class="media mb-4">
                <img src="front/img/user.jpg" alt="Image" class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px"/>
                <div class="media-body">
                  <h6>{{$value->user->name}} 
                    <small><i>{{date('d M Y' ,strtotime($value->created_at))}}   at  {{date('h:i A')}}</i></small>
                  </h6>
                  <p>
                {{$value->comment}}
                  </p>
                  <button class="btn btn-sm btn-light ReplyOpen" id="{{$value->id}}">Reply</button>

                  <div class="bg-light p-3 ShowReply {{$value->id}}" style="display: none;">
                    <h2 class="mb-4">Reply a comment</h2>
                    <form method="POST" action="{{url('article-comment')}}">
                      @csrf              
                      <input type="hidden" name="article_id" value="{{$getRecord->id}}">
                      <div class="form-group">
                        <label for="message">comment</label>
                        <textarea name="comment" required cols="30" rows="5" class="form-control"
                        ></textarea>
                      </div>
                      <div class="form-group mb-0">
                        <input
                          type="submit"
                          value="Leave Comment"
                          class="btn btn-primary px-3"
                        />
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
  
            <!-- Comment Form -->
            <div class="bg-light p-5">
              <h2 class="mb-4">Leave a comment</h2>
              <form method="POST" action="{{url('article-comment')}}">
                @csrf              
                <input type="hidden" name="article_id" value="{{$getRecord->id}}">
                <div class="form-group">
                  <label for="message">comment</label>
                  <textarea name="comment" required cols="30" rows="5" class="form-control"
                  ></textarea>
                </div>
                <div class="form-group mb-0">
                  <input
                    type="submit"
                    value="Leave Comment"
                    class="btn btn-primary px-3"
                  />
                </div>
              </form>
            </div>
          </div>
  
          <div class="col-lg-4 mt-5 mt-lg-0">
            <!-- Search Form -->
            
  
            <!-- Category List -->
            <div class="mb-5">
              <h2 class="mb-4">Categories</h2>

              <ul class="list-group list-group-flush">
                @foreach ($getCategory as $category )
                <li
                  class="list-group-item d-flex justify-content-between align-items-center px-0"
                >
                  <a href="{{url($category->slug)}}">{{$category->name}}</a>
                  
                  <span class="badge badge-primary badge-pill">{{$category->totalArticle()}}</span>
                </li>
                @endforeach
              </ul>
            </div>
  
           
  
            <!-- Recent Post -->
            <div class="mb-5">
              <h2 class="mb-4">Recent Post</h2>

                @foreach ( $getRecentPost as $recent )
                  
                
              <div  class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mb-3">
                
                <img class="img-fluid" src="{{$recent->getFirstMediaUrl()}}" style="width: 80px; height: 80px object-fit:cover;"  />
                
                <div class="pl-3">
                  <a href="{{url($recent->slug)}}">
                    <h5 class="">{!!strip_tags(Str::substr($recent->title,0,20))!!}</h5>
                  </a>
                  <div class="d-flex">
                    <small class="mr-3"
                      ><i class="fa fa-user text-primary"></i>{{$recent->user_name}}</small
                    >
                    <small class="mr-3"
                      ><i class="fa fa-folder text-primary">
                        <a href="{{url($recent->slug)}}"></i> {{$recent->category_name}}</a>
                        
                        </small
                    >
                   
                  </div>
                </div>
              </div>
              @endforeach 

          
             
            </div>
  
  
            <!-- Tag Cloud -->
           @if ($getRecord->getTag->count())
              
          
            <div class="mb-5">
              <h2 class="mb-4">Tag Cloud</h2>
              <div class="d-flex flex-wrap m-n1">
                @foreach ($getRecord->getTag as $tag )
                <a href="" class="btn btn-outline-primary m-1">{{$tag->name}}</a>  
                @endforeach
                </a>
              </div>
            </div>
            @endif
  
          
          </div>
        </div>
      </div>
      <!-- Detail End -->
  
   @endsection
   @section('script')
   <script type="text/javascript">
  $('.ReplyOpen').click(function(){
    var id = $(this).attr('id');
    $('.ShowReply'+id).toggle();
  
  });
  </script>
@endsection
