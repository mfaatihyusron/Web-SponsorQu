
<header class="fixed-top p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none me-5">
          <h4>SponsorQu</h4> 
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{ url('home') }}" class="nav-item nav-link px-2 text-white">Home</a></li>
          <li><a href="#" class="nav-item nav-link  px-2 text-white">FAQs</a></li>
          <li><a href="{{ url('/mail') }}" class="nav-item nav-link  px-2 text-white">Mail</a></li>
          <li><a href="#" class="nav-item nav-link  px-2 text-white">Profile</a></li>
          
          @if(session('user') && session('user')['role'] == 'admin')
          <li><a href="{{ url('/admin') }}" class="nav-item nav-link  px-2 text-white">Dashboard</a></li>
          <li><a href="{{ url('/users') }}" class="nav-item nav-link  px-2 text-white">Users</a></li>
          @endif
        </ul>

        <!-- <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
        </form> -->
        @if(session('user'))

          @if(session('user')['role'] == 'umkm')
            @php $role='MSME' @endphp
          @elseif(session('user')['role'] == 'organisasi')
            @php $role='Organization' @endphp
          @elseif(session('user')['role'] == 'admin')
            @php $role='Admin' @endphp
          @elseif(session('user')['role'] == 'perusahaan')
            @php $role='Company' @endphp
          @endif
          
        <div class="text-end">
        <a href="#" class="nav-item nav-link  px-2 text-white">{{session('user')['name']}} | {{$role}}</a>
        
        </div>  
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action="{{ url('logout') }}" method="post">
          @csrf
        <button class="btn btn-outline-light"type="submit">Logout</button>
        </form>
        @else
        <div class="text-end">
          <a href="{{url('/')}}"type="button" class="btn btn-outline-light me-2">Login</a>
          <a href="{{url('registerform')}}"type="button" class="btn btn-warning">Register</a>
        </div>
        @endif
        
      </div>
    </div>
  </header>
<div class="container bg-none" style="height:90px;" ></div>