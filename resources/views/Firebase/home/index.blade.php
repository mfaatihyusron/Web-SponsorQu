@extends('firebase.app')
<title>Home - SponsorQu</title>

@if(session('user')['role'] == 'umkm')
  @php $role='MSME' @endphp
@elseif(session('user')['role'] == 'organisasi')
  @php $role='Organization' @endphp
@elseif(session('user')['role'] == 'admin')
  @php $role='Admin' @endphp
@elseif(session('user')['role'] == 'perusahaan')
  @php $role='Company' @endphp
@endif

@section('content')
    <div class="container">
        <div class="row">
        @if(session('status'))
                <h4 class="alert alert-warning medium">{{session('status')}}</h4>
            @endif
            <div class="col-md-4">
                <!-- Bagian kiri dengan lebar 25% -->
                <div class="card mx-auto p-3" style="width:90%;">
                    <div class="card-body little-profile text-center">
                        <div class="pro-img"><img src="https://social.webestica.com/assets/images/avatar/07.jpg" class="img-fluid rounded-circle me-2"style="width:100px;" alt="user"></div>
                        <h3 class="m-b-0">{{ session('user')['name'] }}</h3>
                        <p class="my-1 ">{{ session('user')['instansi'] }}</p> 
                        <p class="my-1 ">{{ $role }}</p> 
                        <p class="my-1 text-start">Email: {{ session('user')['email'] }}</p> 
                        <p class="my-1 text-start">Phone: {{ session('user')['telp'] }}</p> 
                        <a href="{{ url('/posting') }}" class="m-t-10 waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true">Add Post</a>
                        <div class="row text-center mt-2">
                            <div class="col-lg-6 col-md-4 border-end">
                                <h3 class="m-b-0 font-light">{{ $jumlahPost }}</h3><small>Posts</small>
                                
                            </div>
                            <!-- <div class="col-lg-6 col-md-4">
                                <h3 class="m-b-0 font-light">434K</h3><small>Connection</small>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Tambahkan konten sesuai kebutuhan -->
            </div>
            <div class="col-md-4">
                <!-- Bagian tengah dengan lebar 50% -->
                @foreach ($joinedData as $data)
                <div class="card py-2 px-3 mx-auto mb-3" style="width: 28rem;">
                    <div class="card border-0" >
                        <div class="card-body p-0 pb-2 border-bottom">
                            <div class=" text-decoration-none text-dark d-flex align-items-center">
                                <img src="https://social.webestica.com/assets/images/avatar/07.jpg" class="img-fluid rounded-circle me-2" style="width:40px;">
                                <div class="side small">
                                    <div  style="width:100%;">{{ $data['name'] }} - {{ $data['instansi'] }}</div>
                                    <div>{{ $data['role_d'] }}</div>
                                </div>
                                
                            </div>
                        </div>
                        <img src="{{ asset($data['image_url']) }}" class="card-img-top mx-auto" style="width: 25rem;">
                        
                        <ul class="list-group list-group-flush">
                            <!-- <a class="list-group-item px-0 ps-1 link">Share </a> -->
                            <li class="border-top list-group-item px-0 bold fw-bolder ps-1 py-1 ">{{$data['title']}} </li>  
                            <li class="list-group-item px-0 py-1 ps-1">{{$data['desc']}}</li>
                        </ul>
                        @if($data['type'] == "partnership")
                        @if(session('user')['role'] != $data['role'])
                        <div class="card-body p-0 py-2">
                            <a class="btn btn-warning" href="{{ url('write-mail/'.$data['uploader'].'/'.$data['id']) }}">Apply Partnership</a>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <!-- Bagian kanan dengan lebar 25% -->
                <!-- Tambahkan konten sesuai kebutuhan -->
            </div>
        </div>
    </div>
    
@endsection