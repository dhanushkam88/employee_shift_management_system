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
            <h4 class="page-title">User Management</h4>
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
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3 col-md-12">
            <div class="white-box">
                <div class="user-bg"> <img width="100%" alt="user" src="{{ asset('plugins/images/large/img1.jpg') }}">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="#"><img src="{{ asset('plugins/images/users/genu.jpg') }}"
                                class="thumb-lg img-circle" alt="img"></a>
                                    <h4 class="text-white mt-2">Create My Account</h4>
                        </div>
                    </div>
                </div>
                <div class="user-btm-box mt-5 d-md-flex">
                    <button type="button" class="btn btn-success btn-lg btn-block mx-auto" data-bs-toggle="modal"
                        data-bs-target="#createUser">Create Employee
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xlg-3 col-md-12">
            <div class="white-box">
                <div class="user-bg"> <img width="100%" alt="user" src="{{ asset('plugins/images/large/img1.jpg') }}">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="javascript:void(0)"><img src="{{ asset('plugins/images/users/varun.jpg') }}"
                                class="thumb-lg img-circle" alt="img"></a>
                                    <h4 class="text-white mt-2">Edit My Account</h4>
                        </div>
                    </div>
                </div>
                <div class="user-btm-box mt-5 d-md-flex">
                    <a type="button" class="btn btn-warning btn-lg btn-block mx-auto" href="{{ route('viewAllUserProfile') }}">Edit Employee</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xlg-3 col-md-12">
            <div class="white-box">
                <div class="user-bg"> <img width="100%" alt="user" src="{{ asset('plugins/images/large/img1.jpg') }}">
                    <div class="overlay-box">
                        <div class="user-content">
                            <a href="javascript:void(0)"><img src="{{ asset('plugins/images/users/arijit.jpg') }}"
                                class="thumb-lg img-circle" alt="img"></a>
                                    <h4 class="text-white mt-2">Thank you for your contribution</h4>
                        </div>
                    </div>
                </div>
                <div class="user-btm-box mt-5 d-md-flex">
                    <a href="{{ route('deleteUser') }}" type="button" class="btn btn-danger btn-lg btn-block mx-auto">Remove Employee</a>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Modal for Create User -->
        <div class="modal fade" id="createUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Create Employee</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- form -->
                    <form class="form-horizontal form-material" method="POST" action="{{ route('createEmployee') }}">
                        @csrf
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Full Name</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="Johnathan Doe"
                                    class="form-control p-0 border-0 @error('fullName') is-invalid @enderror"
                                    name="fullName" id="fullName" value="{{ old('fullName') }}" >
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="example-email" class="col-md-12 p-0">Email</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="email" placeholder="johnathan@admin.com"
                                    class="form-control p-0 border-0 @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Password</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" class="form-control p-0 border-0"
                                    placeholder="************" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Password</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="password" class="form-control p-0 border-0"
                                    placeholder="************" name="password_confirmation" id="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Phone No</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="123 456 7890"
                                    class="form-control p-0 border-0" name="contactNumber" id="contactNumber" required>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="col-sm-12">User Level</label>

                            <div class="col-sm-12 border-bottom">
                                <select class="form-select shadow-none p-0 border-0 form-control-line text-capitalize" name="userRole" id="userRole">
                                    @if (count($roles) > 0)
                                        @foreach ($roles as $key=>$role )
                                            <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-success btn-lg" type="submit">Create Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        <!-- Column -->
    </div>
</div>
@endsection
@section('custom_js')
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
@endsection
