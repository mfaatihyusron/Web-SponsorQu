@extends('firebase.app')


@section('content')

<div class="container">
    <div class="row">
        @if(session('status'))
        <h4 class="alert alert-warning p-2 mb-2">{{session('status')}}</h4>
        @endif
        <!-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif -->
        <div class="w-50 center border rounded mt-5 px-3 py-3 mx-auto">  
            <form action="{{ url('login') }}" method="POST">
                @csrf
            <h1 class="mb-3">Login</h1>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" value="{{ Session::get('email') }}"class="form-control" name="email">
                @error('email')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
                <div class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
                @error('email')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror
            </div>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <a class="text-decoration-none small"href="{{ url('registerform') }}">Dont have an account? Register here</a>

            </form>
        </div>
    </div>
</div>
    
@endsection