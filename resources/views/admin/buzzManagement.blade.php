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
            <h4 class="page-title">Buzz Management</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="card white-box p-0">
                        <div class="card-heading">
                            <h3 class="box-title mb-0">Mail Listing</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-action"><img src="{{ asset('plugins/images/users/arijit.jpg') }}"
                                        width="20%" alt="user-img" class="rounded-circle">  Varun Dhavan</li>
                                <li class="list-group-item list-group-item-action"><img src="{{ asset('plugins/images/users/arijit.jpg') }}"
                                        width="20%" alt="user-img" class="rounded-circle"> Ganelia Deshmuk</li>
                                <li class="list-group-item list-group-item-action"><img src="{{ asset('plugins/images/users/arijit.jpg') }}"
                                        width="20%" alt="user-img" class="rounded-circle"> Ritesh Deshmukh</li>
                                <li class="list-group-item list-group-item-action"><img src="{{ asset('plugins/images/users/arijit.jpg') }}"
                                        width="20%" alt="user-img" class="rounded-circle"> Ajith Singh</li>
                                <li class="list-group-item list-group-item-action"><img src="{{ asset('plugins/images/users/arijit.jpg') }}"
                                        width="20%" alt="user-img" class="rounded-circle"> Govinda Star</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="card white-box p-0">
                        <div class="card-heading">
                            <h3 class="box-title mb-0"><img src="{{ asset('plugins/images/users/arijit.jpg') }}" width="5%" alt="user-img" class="rounded-circle">  Varun Dhavan</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary rounded" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <p>Aww yeah, you successfully read this important alert message. This example text is going to
                                    run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                                <hr>
                                <p class="mb-0">
                                    <button type="button" class="btn btn-success">Noted</button>
                                </p>
                            </div>
                            <div class="alert alert-primary rounded" role="alert">
                                <h4 class="alert-heading">Well done!</h4>
                                <p>Aww yeah, you successfully read this important alert message. This example text is going to
                                    run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                                <hr>
                                <p class="mb-0">
                                    <button type="button" class="btn btn-success">Noted</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
@endsection
