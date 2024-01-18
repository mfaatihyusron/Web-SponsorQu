@extends('firebase.app')


@section('content')
<title>Write Mail -SponsorQu</title>
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
                                    <div  style="width:100%;">{{ $uploaderData['name'] }} - {{ $uploaderData['instansi'] }}</div>
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
                    <h4 class="">Write a Mail <a href="{{ url('home') }}" class="btn btn-danger float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    @php
                    $uid=session('user')['uid'];
                    @endphp
                    <form action="{{ url('sendMail') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Subject</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Message</label>
                            <textarea type="text" name="message" class="form-control" style="max-height: 200px;"></textarea>
                        </div>
                        <div class="form-group mb-3">
                        </div>
                        <div class="form-group mb-3" style="display:none;">
                            <input type="text" name="telp_sender" value="{{ session('user')['telp'] }}" class="form-control" readonly>
                            <input type="text" name="email_sender" value="{{ session('user')['email'] }}" class="form-control" readonly>
                            <input type="text" name="sender" value="{{ session('user')['uid'] }}" class="form-control" readonly>
                            <input type="text" name="to" value="{{ $uploader }}" class="form-control" readonly>
                            <input type="text" name="id_post" value="{{ $postData['id'] }}" class="form-control" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Send Mail</button>
                        </div>
                    </form>
                    
                </div>
            </div> 
        </div>
        <div class="col-md-2">

        </div>

    </div>
</div>

@endsection