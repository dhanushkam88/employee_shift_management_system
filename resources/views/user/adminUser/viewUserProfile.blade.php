@extends('layouts.page.hedder')
@section('title') My Dashboard @endsection
@section('custom_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('custom_css')

@endsection
@section('content')

<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">All Users</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <p>
                    <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i> {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </p>
            @endforeach
        </div>
    @endif
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Full Name</th>
                                <th class="border-top-0">Email</th>
                                <th class="border-top-0">Contact Number</th>
                                <th class="border-top-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user )
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->contact }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editUser{{ $key }}">Edit User
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal for Create User -->
                                <div class="modal fade" id="editUser{{ $key }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- form -->
                                        <form class="form-horizontal form-material row" method="POST" action="{{ route('updateUserProfile') }}">
                                            @csrf
                                            <input type="hidden" name="userId" id="userId" value="{{ $user->id }}" >
                                            <div class="form-group mb-4 col-6">
                                                <label class="col-md-12 p-0">Full Name</label>
                                                <div class="col-md-12 border-bottom p-0">
                                                    <input type="text" placeholder="{{ $user->name}}"
                                                        class="form-control p-0 border-0 @error('fullName') is-invalid @enderror"
                                                        name="fullName" id="fullName">
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 col-6">
                                                <label for="example-email" class="col-md-12 p-0">Email</label>
                                                <div class="col-md-12 border-bottom p-0">
                                                    <input type="email" placeholder="{{ $user->email }}"
                                                        class="form-control p-0 border-0"
                                                        name="email" id="email">
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 col-6">
                                                <label class="col-md-12 p-0">Password</label>
                                                <div class="col-md-12 border-bottom p-0">
                                                    <input type="password" class="form-control p-0 border-0"
                                                        placeholder="************" name="password" id="password">
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 col-6">
                                                <label class="col-md-12 p-0">Password</label>
                                                <div class="col-md-12 border-bottom p-0">
                                                    <input type="password" class="form-control p-0 border-0"
                                                        placeholder="************" name="password_confirmation" id="password_confirmation">
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 col-6">
                                                <label class="col-md-12 p-0">Phone No</label>
                                                <div class="col-md-12 border-bottom p-0">
                                                    <input type="text" placeholder="{{ $user->contact }}"
                                                        class="form-control p-0 border-0" name="contactNumber" id="contactNumber">
                                                </div>
                                            </div>
                                            <div class="form-group mb-4 col-6">
                                                <label class="col-sm-12">User Level</label>

                                                <div class="col-sm-12 border-bottom">
                                                    <select class="form-select shadow-none p-0 border-0 form-control-line"
                                                        name="userRole" id="userRole">
                                                            @if(!empty(Auth::user()->roles))
                                                                <option value ="" selected hidden>{{ Auth::user()->roles->pluck('name') }}</option>
                                                                @foreach ($userRoles as $userRole)
                                                                    <option value="{{ $userRole->id }}" @if (auth()->user()->roles->pluck('name')[0] == $userRole->name) selected hidden @endif >{{ $userRole->name }}</option>
                                                                @endforeach
                                                            @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-success btn-lg" type="submit">Update Profile</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
@endsection
