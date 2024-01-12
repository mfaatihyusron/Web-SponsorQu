@extends('firebase.app')


@section('content')

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6 ">
            <div class="card px-0 ">
                <div class="card-header">
                    <h4 class="">Edit Contact <a href="{{ url('contacts') }}" class="btn btn-danger float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    
                    <form action="{{ url('update-contact/'.$key) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="" class="ms-1">Id</label>
                            <input type="text" readonly value="{{ $key }}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="" class="ms-1">Full Name</label>
                            <input type="text" name="name" value="{{ $editdata['name'] }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="ms-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ $editdata['phone'] }}"  class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="ms-1">Email Address</label>
                            <input type="text" name="email" value="{{ $editdata['email'] }}"  class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    
                </div>
            </div>   
        </div>
           
    </div>
</div>

@endsection

