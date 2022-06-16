@extends('layouts.app')

@section("title") User-manager @endsection

@section('content')
    <x-bread-crumb>
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User-Manager</li>
    </x-bread-crumb>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>
                        <i class="feather-users"></i>
                        User List
                    </h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Control</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role ? "User" : "Admin"}}</td>
                            <td>
                                @if($user->role == 1)
                                    <form class="d-inline-block" action="{{ route('user-manager.makeAdmin') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button class="btn btn-sm btn-outline-primary">Make Admin</button>
                                    </form>

                                <button class="btn btn-sm btn-outline-warning" onclick="changePassword({{ $user->id }},'{{ $user->name }}')">Change Password</button>

                                   @if($user->isBaned == 1)
                                       <span>Baned</span>
                                    @else
                                        <form class="d-inline-block" action="{{ route('user-manager.ban-user') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button class="btn btn-sm btn-outline-danger">Ban User</button>
                                        </form>
                                   @endif
                                    @if($user->isBaned == 1)
                                        <form class="d-inline-block" action="{{ route('user-manager.restore-user') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button class="btn btn-sm btn-outline-success">Restore User</button>
                                        </form>
                                    @endif
                                @endif

                            </td>
                            <td>
                                <small>
                                    <i class="feather-calendar"></i>
                                    {{ $user->created_at->format("d F y") }}
                                    <br>
                                    <i class="feather-clock"></i>
                                    {{ $user->created_at->format("h:i a") }}
                                </small>
                            </td>
                            <td>
                                <small>
                                    <i class="feather-calendar"></i>
                                    {{ $user->updated_at->format("d F y") }}
                                    <br>
                                    <i class="feather-clock"></i>
                                    {{ $user->updated_at->format("h:i a") }}
                                </small>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changePassword(id,name){
            let url = "{{ route('user-manager.change-user-password') }}"
            Swal.fire({
                title: 'Change Password for '+name,
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off',
                    required : 'required',
                    minLength:8,
                },
                showCancelButton: true,
                confirmButtonText: 'Change',
                showLoaderOnConfirm: true,
                preConfirm : function (newPassword){
                    // console.log(id,newPassword);
                    $.post(url,{
                        id:id,
                        password:newPassword,
                        _token:"{{ csrf_token() }}"
                    }).done(function (data){
                        if (data.status == 200){
                            Swal.fire({
                                icon:"success",
                                title:data.message
                            })
                        }else {
                            Swal.fire({
                                icon:"error",
                                title:data.message.password[0]
                            })
                        }
                    })
                }

            })
        }
    </script>
@endsection
