@extends('firebase.app')


@section('content')
<title>Admin Page - SponsorQu</title>

<div class="container">
    <div class="row border-bottom">
            @if(session('status'))
                <h4 class="alert alert-warning small d-flex align-item-center">{{session('status')}}</h4>
            @endif
        <div class="col-md-6">
        <!-- Bagian 1 -->
        <div class="p-3 mb-4 bg-light border">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle me-3" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg> 
        Active User : {{ $data['jumlah_user'] }}</div>
        </div>
        <div class="col-md-6">
        <!-- Bagian 2 -->
        <div class="p-3 mb-4 bg-light border">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-post me-3" viewBox="0 0 16 16">
        <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
        <path d="M4 6.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5H7a.5.5 0 0 1 0 1H4.5a.5.5 0 0 1-.5-.5"/>
        </svg>
        Available Posts : {{ $data['jumlah_post'] }}
        </div>
        </div>
        
    </div>

</div>

@endsection

