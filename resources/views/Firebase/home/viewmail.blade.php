@extends('firebase.app')


@section('content')
<title>View Mail -SponsorQu</title>
<div class="container">
    <div class="row">
        <div class="col-md-4">
        <div class="card py-2 px-3 mx-auto mb-3" style="width: 24rem;">
                    <div class="card border-0" >
                        <div class="card-body p-0 border-bottom">
                            <h4>About:</h4>
                        </div>
                        <div class="card-body p-0 py-2 border-bottom">
                            <div class=" text-decoration-none text-dark d-flex align-items-center">
                                <img src="https://social.webestica.com/assets/images/avatar/07.jpg" class="img-fluid rounded-circle me-2" style="width:40px;">
                                <div class="side small">
                                    <div  style="width:100%;">{{ session('user')['name'] }} - {{ session('user')['instansi'] }}</div>
                                </div>
                                
                            </div>
                        </div>
                        <img src="{{ asset($postData['image_url']) }}" class="card-img-top mx-auto" style="width: 20rem;">
                        
                        <ul class="list-group list-group-flush">
                            <!-- <a class="list-group-item px-0 ps-1 link">Share </a> -->
                            <li class="border-top list-group-item px-0 bold fw-bolder ps-1 py-1 ">{{$postData['title']}} </li>  
                            <li class="list-group-item px-0 py-1 ps-1">{{$postData['desc']}}</li>
                        </ul>
                        
                    </div>
                </div>
        </div>
        <div class="col-md-6">
        <div class="card px-0">
                <div class="card-header">
                    <h4 class="">Sender: {{ $sender["name"] }} <a href="{{ url('mail') }}" class="btn btn-danger float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    @php
                    $uid=session('user')['uid'];
                    @endphp
                    
                        <div class="form-group mb-3">
                            <h4 for="">{{ $mailData["subject"] }}</h4>
                        </div>
                        <div class="form-group mb-3">
                            <p>{{ $mailData["message"] }}</p>
                        </div>
                    <div class="p-0">Contact info:
                        <p class="m-0">{{ $mailData["telp_sender"] }}</p>
                            <p class="m-0">{{ $mailData["email_sender"] }}</p>
                    </div>
                        
                </div>
            </div> 
        </div>
        <div class="col-md-2">

        </div>

    </div>
</div>

@endsection