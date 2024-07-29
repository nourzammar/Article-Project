  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{url('panel/dashboard')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard {{ Request::segment(2) }}</span>
        </a>
      </li><!-- End Dashboard Nav -->
    


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('panel/user/list')}}">
          <i class="bi bi-person"></i>
          <span>User</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('panel/category/list')}}">
          <i class="bi bi-person"></i>
          <span>Category</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('panel/article/list')}}">
          <i class="bi bi-person"></i>
          <span>Article</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('panel/dataset/get')}}">
          <i class="bi bi-person"></i>
          <span>Algorithm</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('panel/comment/list')}}">
          <i class="bi bi-question-circle"></i>
          <span>Comment</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      
     
    </ul>

  </aside><!-- End Sidebar-->