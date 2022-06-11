@extends('layouts.page.hedder')
@section('title') My Dashboard @endsection
@section('custom_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('custom_css')
<!-- calander-->
<link rel="stylesheet" href="{{ asset('calander/fonts/icomoon/style.css') }}">
<link rel="stylesheet" href="{{ asset('calander/css/rome.css') }}">
<link rel="stylesheet" href="{{ asset('calander/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
@endsection
@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Employee Management</h4>
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
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <div class="white-box row">
                        <div class="col-7">
                            <div class="col col-12">
                                <div id="calendar"></div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="col-lg-12 col-xlg-3 col-md-12">
                                <div class="white-box">
                                    <div class="user-bg"> <img width="100%" alt="user" src="{{ asset('plugins/images/large/img1.jpg') }}">
                                        <div class="overlay-box">
                                            <div class="user-content">
                                                <a href="#"><img src="{{ asset('plugins/images/users/genu.jpg') }}"
                                                    class="thumb-lg img-circle" alt="img">
                                                </a>
                                                    <h4 class="text-white mt-2">Create My Shift</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-btm-box mt-5 d-flex justify-content-center">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="btn btn-primary btn-lg btn-block collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Create Employee Shift
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse mt-4" aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <form class="row form-floating g-3" method="POST" action="{{ route('createMyShiftRequest') }}" autocomplete ="off">
                                                        @csrf
                                                        <div class="col-md-12 form-floating date">
                                                            <input type="text" class="form-control" name="date" id="input">
                                                            <label for="date">Select Date</label>
                                                        </div>
                                                        <button type="submit" class="btn btn-success btn-lg btn-block mx-auto">Create My Shift</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xlg-3 col-md-12">
                                <div class="white-box">
                                    <div class="user-bg"> <img width="100%" alt="user" src="{{ asset('plugins/images/large/img1.jpg') }}">
                                        <div class="overlay-box">
                                            <div class="user-content">
                                                <a href="javascript:void(0)"><img src="{{ asset('plugins/images/users/varun.jpg') }}"
                                                    class="thumb-lg img-circle" alt="img"></a>
                                                    <h4 class="text-white mt-2">Edit / Delete My Shift</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-btm-box mt-5 d-md-flex d-flex justify-content-center">
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item mx-auto">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="btn btn-primary btn-lg btn-block collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#editEvent" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Edit / Delete Shift
                                                    </button>
                                                </h2>
                                                <div id="editEvent" class="accordion-collapse collapse mt-4" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                    <form class="row form-floating g-3" method="POST" action="{{ route('editMyShiftRequest') }}" autocomplete ="off">
                                                        @csrf
                                                        <div class="col-md-12 form-floating date">
                                                            <input type="text" class="form-control" name="date" id="inputTwo">
                                                            <label for="date">Select Date</label>
                                                        </div>
                                                        <button type="submit" class="btn btn-success btn-lg btn-block mx-auto">Find My Shift</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<!-- Clander-->
<script src="{{ asset('calander/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('calander/js/popper.min.js') }}"></script>
<script src="{{ asset('calander/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('calander/js/rome.js') }}"></script>
<script src="{{ asset('calander/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script>

$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        defaultView: 'agendaWeek',
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:"{{URL::route('fullCalender')}}",
        selectable:true,
        eventColor:'#119D0C',
        selectHelper: true,
    });
});

</script>
@endsection
