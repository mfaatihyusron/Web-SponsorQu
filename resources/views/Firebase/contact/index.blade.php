@extends('firebase.app')


@section('content')

<div class="container">
    <div class="row ">
        <div class="col-md-12 ">
            @if(session('status'))
                <h4 class="alert alert-warning">{{session('status')}}</h4>
            @endif
            @if(session('user'))
                <p>Welcome, {{ session('user')['name'] }}!</p>
                <p>Email: {{ session('user')['email'] }}</p>
                <p>Role: {{ session('user')['role'] }}</p>
                <p>UID: {{ session('user')['uid'] }}</p>
                <!-- Tambahan informasi pengguna lainnya yang disimpan di sesi -->
            @else
                <p>User not logged in.</p>
            @endif
            <div class="card px-0">
                <div class="card-header">   
                    <h4 class="">Contacs <a href="{{ url('add-contact') }}" class="btn btn-primary float-end">Add Contact</a></h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="with:fit-content;">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @forelse ($contacts as $key => $item)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['phone'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td><a class="btn btn-sm btn-success" href="{{ url('edit-contact/'.$key) }}">Edit</a></td>
                                <td>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="{{ '#modal'.$i }}">
                                Delete
                                </button>
                                </td>
                            </tr>
                            <!-- Modal You sure want to delete? -->
                            <div class="modal fade mt-4" id="{{ 'modal'.$i++ }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" >Are you sure?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <button type="button" class="btn btn-secondary float-end mx-2" data-bs-dismiss="modal">Close</button>
                                    <a  class="btn btn-danger float-end" href="{{ url('delete-contact/'.$key) }}">Delete</a>
                                </div>
                                </div>
                            </div>
                            </div>
                            @empty
                            <tr>
                                <td span="6">Theres no items</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>   
        </div>
           
    </div>
</div>

@endsection

