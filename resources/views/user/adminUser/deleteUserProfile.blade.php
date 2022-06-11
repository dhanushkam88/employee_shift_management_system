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
            <h4 class="page-title">Remove Users</h4>
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
                                        <button type="button" class="btn btn-danger" type="button" class="btn btn-danger btn-lg btn-block mx-auto" data-bs-toggle="modal"
                                            data-bs-target="#removeUser{{ $key }}">Remove User
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal for Remove User -->
                                <div class="modal fade" id="removeUser{{ $key }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <h2 class="display-6 text-center pb-2 pt-2"><b>Whoa, there!</b></h2>
                                        <p class="text-center">Once you delete this account, there's no getting it back. <br> Make sure you want to do this.</p>
                                        <form method="POST" action="{{ route('deleteUserConfirm') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="hidden" id="userId" name="userId" value="{{ $user->id }}" />
                                                <input class="form-control form-control-lg" type="text" placeholder="Confirm by typing DELETE" id="confirm" name="confirm" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-light btn-lg" data-bs-dismiss="modal">CANCEL</button>
                                            <button type="submit" class="btn btn-danger btn-lg">YEP, DELETE IT</button>
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
