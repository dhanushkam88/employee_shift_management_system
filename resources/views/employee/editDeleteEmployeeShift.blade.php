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
            <h4 class="page-title">Edit / Delete Shift</h4>
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
            <span class="text-success" id="#nameSuccessMsg"></span>

            <form class="form-horizontal form-material" method="POST" action="{{ route('createMyShift') }}">
                @csrf
                <div class="white-box row">
                <h4 class="page-title">Assigning Shift</h4>
                @if(!empty($editShiftRequest))
                    @foreach($editShiftRequest as $key => $shift)
                            <div class="card text-white bg-primary mb-3 col-4" style="border-right: 1px solid;">
                                <div class="card-body class-text">
                                <h1 class="card-title display-4 class-text">Shift <br><small style="font-size: 70%"></small></h1>
                                    <p class="class-text">{{ $shift['title'] }}</p>
                                    <p class="class-text">{{ $shift['shift_id']->shift_start }} - {{ $shift['shift_id']->shift_end }}</p>
                                    <p class="class-text">{{ $shift['date'] }}</p>
                                </div>
                                <div class="footer bg-primary mx-auto">
                                    <a href="#editShift{{ $shift['id'] }}" class="btn btn-info btn-lg mr-1 open-AddBookDialog"
                                        data-toggle="modal" data-id= "{{ $shift['id'] }}" data-date="{{ $shift['date'] }}"2
                                        data-userid="{{ $shift['user_id'] }}" data-title= "{{ $shift['title'] }}"
                                        data-shift_id="{{ $shift['shift_id']->id }}"
                                        data-shift="{{ $shift['shift_id']->shift_start }} - {{ $shift['shift_id']->shift_end }}">
                                        Edit shift
                                    </a>
                                    <a href="#deleteShift{{ $shift['id'] }}" class="btn btn-danger btn-lg open-AddBookDialogs"
                                        data-toggle="modal" data-myid= "{{ $shift['id'] }}">
                                        Delete shift
                                    </a>
                                </div>
                            </div>
                    @endforeach
                </div>
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

  <!-- Edit Modal -->
<div class="modal fade" id="editShift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Shifts</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{ Form::open(array('class'=>'row g-3', 'user' => 'key', 'id' => 'edit-form')) }}
            @csrf
            <input type="hidden" id="id" name="id" value="" />
            <input type="hidden" id="shift" name="shift" value="" />
            <input type="hidden" id="userid" name="userid" value="" />
                <div class="row g-3">
                  <label for="inputEmail4" class="form-label">Employee Name</label>
                  <div class="col-8">
                  <input type="text" class="form-control" id="name" name="name" value="" readonly>
                  </div>
                  <div class="col-4">
                    <button type="button" class="btn btn-primary" id="changeEmployee" >Change employee</button>
                  </div>
                </div>
                <div class="col-md-12 hide" id="selectShift">
                    <label for="inputState" class="form-label">Availabale employees</label>
                    <select id="selectEmployee" name="selectEmployee" class="form-select">
                        <option value="" hidden>Select employee</option>
                    @if(!empty($editUsers))
                        @foreach($editUsers as $key => $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    @endif
                    </select>
                </div>
                <div class="col-md-12">
                    <label for="inputState" class="form-label">Selected shift</label>
                    <input type="text" class="form-control" id="select-shift" name="select-shift" value="" readonly>
                </div>
                <div class="col-md-12">
                  <label for="inputPassword4" class="form-label">Shift Date</label>
                  <input type="text" class="form-control" id="date" name="date" value="" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            {{ Form::close() }}
            </div>
        </div>
    </div>
<!-- end modal-->

<!-- Delete Modal -->
<div class="modal fade" id="deleteShift" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h2 class="display-6 text-center pb-2 pt-2"><b>Whoa, there!</b></h2>
            <p class="text-center">Once you delete this, there's no getting it back. <br> Make sure you want to do this.</p>
            {{ Form::open(array('user' => 'key', 'id' => 'delete-form')) }}
                <input type="hidden" id="deleteId" name="deleteId" value="" />
            <div class="row g-3">
                <input class="form-control form-control-lg" type="text" placeholder="Confirm by typing DELETE" id="confirmText" name="confirmText">
                <span class="text-danger" id="nameErrorMsg"></span>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light btn-lg" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn btn-danger btn-lg">YEP, DELETE IT</button>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>

@endsection
@section('custom_js')
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script>
        $(document).on("click", ".open-AddBookDialog", function () {
            var id = $(this).data('id');
            var userid = $(this).data('userid');
            var name = $(this).data('title');
            var date = $(this).data('date');
            var shift = $(this).data('shift_id');
            var selectShift = $(this).data('shift');
            $(".modal-body #edit-form").attr('user',id );
            $(".modal-body #id").val( id );
            $(".modal-body #userid").val( userid );
            $(".modal-body #name").val( name );
            $(".modal-body #date").val( date );
            $(".modal-body #shift").val( shift );
            $(".modal-body #select-shift").val( selectShift );;
            $('#editShift').modal('show');
        });
    </script>
    <script>
        $(document).on("click", ".open-AddBookDialogs", function () {
            var deleteId = $(this).data('myid');
            $(".modal-body #destroy-form").attr('user',deleteId );
            $(".modal-body #deleteId").val( deleteId );
        $('#deleteShift').modal('show');
    });
    </script>

    <script>
        $(document).ready(function() {
            $("body").on("click", "#changeEmployee", function() {
                $("#selectShift").show();
            });
        });
    </script>
    <script type="text/javascript">
        $('#edit-form').on('submit',function(e){
            e.preventDefault();
            let id = $('#id').val();
            let shift = $('#shift').val();
            let userid = $('#userid').val();
            let name = $('#name').val();
            let changeEmp = $('#selectEmployee').val();
            let selectShift = $('#select-shift').val();
            let date = $('#date').val();
            console.log($('#selectEmployee').val());
            $.ajax({
                    url: "/admin/edit-my-shift",
                    type:"POST",
                    data:{
                    "_token": "{{ csrf_token() }}",
                    id:id,
                    shift:shift,
                    userid:userid,
                    name:name,
                    changeEmp:changeEmp,
                    selectShift:selectShift,
                    date:date,
                },
                success:function(response){
                    console.log(response.success);
                $('#nameSuccessMsg').text(response.success);
                document.location.reload();
                },
                error: function(response) {
                    console.log(response);
                // $('#nameErrorMsg').text(response.responseJSON.errors.text);
                },
                });
        });
    </script>
    <script type="text/javascript">
        $('#delete-form').on('submit',function(e){
            e.preventDefault();
            let id = $('#deleteId').val();
            let text = $('#confirmText').val();
            $.ajax({
                url: "/admin/delete-my-shift",
                type:"POST",
                data:{
                "_token": "{{ csrf_token() }}",
                id:id,
                text:text,
                },
                success:function(response){
                    console.log(response.success);
                $('#nameSuccessMsg').text(response.success);
                document.location.reload();
                },
                error: function(response) {
                    console.log(response);
                $('#nameErrorMsg').text(response.responseJSON.errors.text);
                },
                });
        });
    </script>
@endsection
