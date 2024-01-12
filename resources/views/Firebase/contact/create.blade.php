@extends('firebase.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card px-0">
                <div class="card-header">
                    <h4 class="">Featured <a href="{{ url('contacts') }}" class="btn btn-danger float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    
                    <form action="{{ url('add-contact') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Full Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email Address</label>
                            <input type="text" name="email" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    
                </div>
            </div>   
        </div>
           
    </div>
</div>

@endsection

