@extends('firebase.app')


@section('content')
<title>Edit User - SponsorQu</title>

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6 ">
            <div class="card px-0 ">
                <div class="card-header">
                    <h4 class="">Edit User <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a></h4>
                </div>
                <div class="card-body">
                    
                    <form action="{{ url('update-user/'.$key) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="" class="ms-1">Id</label>
                            <input type="text" readonly value="{{ $key }}" class="form-control">
                        </div>

                        <div class="mb-1">
                            <label for="name" class="form-label mb-1">Full Name</label>
                            <input type="name" value="{{ $editdata['name'] }}"class="form-control" name="name">
                            @error('name')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
                        </div>
                        <div class="mb-1">
                            <label for="email" class="form-label mb-1">Email address</label>
                            <input type="email" value="{{ $editdata['email'] }} "class="form-control" readonly>
                            @error('email')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
                        </div>
                        <div class="mb-1">
                            <label for="telp" class="form-label mb-1">Password</label>
                            <input type="telp" class="form-control"value="{{ $editdata['password'] }}" name="password" readonly>
                            @error('password')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
                        </div>
                        <div class="mb-1">
                            <label for="telp" class="form-label mb-1">Phone Number</label>
                            <input type="telp" class="form-control"value="{{ $editdata['telp'] }}" name="telp">
                            @error('telp')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
                        </div>
                        <div class="mb-1">
                            <label for="instansi" class="form-label mb-1">Registered As</label>
                            <select class="form-select" name="role">
                                <option selected>Choose...</option>
                                <option  value="umkm" {{ $editdata['role'] == 'umkm' ? 'selected' : '' }}>MSME</option>
                                <option value="organisasi" {{ $editdata['role'] == 'organisasi' ? 'selected' : '' }}>Organization</option>
                                <option value="perusahaan" {{ $editdata['role'] == 'perusahaan' ? 'selected' : '' }}>Company</option>
                            </select>
                            @error('role')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
                        </div>
                        <div class="mb-1">
                            <label for="instansi" class="form-label mb-1">Organization or MSME Name</label>
                            <input type="instansi" value="{{ $editdata['instansi'] }}" class="form-control" name="instansi">
                            @error('instansi')<div class="alert alert-danger p-1 ps-3 mt-1" role="alert">{{ $message }}</div>@enderror 
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

