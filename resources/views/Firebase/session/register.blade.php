@extends('firebase.app')


@section('content')
<title>Register - SponsorQu</title>

<div class="container">
    <div class="row">
        @if(session('status'))
        <h4 class="alert alert-warning p-2 mb-2">{{session('status')}}</h4>
        @endif
        <div class="w-50 center border rounded mt-5 px-3 py-3 mx-auto">  
            <form action="{{ url('register') }}" method="POST">
                @csrf
            <h1 class="mb-1">Register</h1>
            <div class="mb-1">
                <label for="name" class="form-label mb-1">Full Name</label>
                <input type="name" value="{{ Session::get('name') }}"class="form-control" name="name">
                @error('name')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
            </div>
            <div class="mb-1">
                <label for="email" class="form-label mb-1">Email address</label>
                <input type="email" value="{{ Session::get('email') }} "class="form-control" name="email">
                @error('email')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
                <div class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-1">
                <label for="password" class="form-label mb-1">Password</label>
                <input type="password" name="password" class="form-control">
                @error('password')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror
            </div>
            <div class="mb-1">
                <label for="telp" class="form-label mb-1">Phone Number</label>
                <input type="telp" class="form-control"value="{{ Session::get('telp') }}" name="telp">
                @error('telp')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
            </div>
            <div class="mb-1">
                <label for="instansi" class="form-label mb-1">Register As</label>
                <select class="form-select" name="role">
                    <option selected>Choose...</option>
                    <option  value="umkm">MSME</option>
                    <option value="organisasi">Organization</option>
                </select>
                @error('role')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
            </div>
            <div class="mb-1">
                <label for="instansi" class="form-label mb-1">Organization or MSME Name</label>
                <input type="instansi" value="{{ Session::get('instansi') }}" class="form-control" name="instansi">
                @error('instansi')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a class="text-decoration-none small"href="{{ url('/') }}">Already have an account? Login here</a>

            </form>
        </div>
    </div>
</div>
    
@endsection