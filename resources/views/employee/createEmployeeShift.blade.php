@extends('layouts.page.hedder')
@section('title') My Dashboard @endsection
@section('custom_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('custom_css')
    <style>
        .class-text {
            color: white;
        }
    </style>
@endsection
@section('content')
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Create Shift</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal form-material" method="POST" action="{{ route('createMyShift') }}">
                @csrf
                <input type="hidden" value="{{ $date }}" name="date" id="date">
                <div class="white-box row">
                <h4 class="page-title">Available Shift</h4>
                @if(count($availableShifts) >0)
                @foreach ($availableShifts as $key => $availableShift)
                    <div class="card text-white bg-primary mb-3 col-4" style="border-right: 1px solid;">
                        <div class="card-body class-text">
                        <h1 class="card-title display-4 class-text">Shift <br><small style="font-size: 70%">{{$availableShift->shift_start}} - {{$availableShift->shift_end}}</small></h1>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shifts" id="shifts" value="{{ $availableShift->id }}" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                <p class="class-text">Select Your Shift</p>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-6">
            <div class="form-floating">
                <select class="form-select" id="employee" name="employee" aria-label="Floating label select example">
                  <option selected hidden>Select employee</option>
                  @foreach ($availableUsers as $availableUser)
                   <option value="{{ $availableUser->id }}">{{ $availableUser->name }}</option>
                  @endforeach
                </select>
                <label for="floatingSelect">Works with selects</label>
              </div>
        </div>
        <div class="col-6" >
            <button type="submit" class="btn btn-primary btn-lg mt-2 ">Confirm identity</button>
        </div>
        @else
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                No available shifts for selected date !
            </div>
        </div>
        @endif
    </form>
    </div>
</div>
@endsection
@section('custom_js')
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
@endsection
