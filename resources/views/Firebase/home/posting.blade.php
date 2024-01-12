@extends('firebase.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="card px-0">
                <div class="card-header">
                    <h4 class="">Featured <a href="{{ url('home') }}" class="btn btn-danger float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    @php
                    $uid=session('user')['uid'];
                    @endphp
                    <form action="{{ url('addPost/'.$uid) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Description</label>
                            <input type="text" name="desc" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                        <label for="formFile" class="form-label" name="imagepost"> Input your Image</label>
                        <input class="form-control" type="file" name="imagepost" id="formFile">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Add Post</button>
                        </div>
                    </form>
                    
                </div>
            </div>   
        </div>
           
    </div>
</div>

@endsection

