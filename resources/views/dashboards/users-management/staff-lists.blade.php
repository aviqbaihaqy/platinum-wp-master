@extends('layouts.dashboards-app.app')

@section('content')
<script type="text/javascript">
  function getMemberData(userId) {
    $.ajax({
      type: 'GET',
      url: '/dashboard/user/' + userId + '/get_details',
      cache: false,
      dataType: 'JSON',
      success: function(data) {
        var result = JSON.parse($.parseJSON(JSON.stringify(data)));

        var user = result.selectedUser
        var profile = user.profile

        console.log(profile)

        $('#edit_staff_form').attr('action', '/dashboard/staff/' + userId +'/update')

        $('#edit_staff_email').val(user.email)
        $('#edit_staff_status').val(user.status)
        $('#edit_staff_role select').val(user.role)

        $('#edit_staff_nip').val(profile.nip)
        $('#edit_staff_first_name').val(profile.first_name)
        $('#edit_staff_last_name').val(profile.last_name)
        $('#edit_staff_address').val(profile.address)
        $('#edit_staff_phone').val(profile.phone)
      }
    })
  }

  function confirmStaffDelete(userId) {
    $.ajax({
      type: 'GET',
      url: '/dashboard/user/' + userId + '/get_details',
      cache: false,
      dataType: 'JSON',
      success: function(data) {
        var result = JSON.parse($.parseJSON(JSON.stringify(data)));
        var user = result.selectedUser

        var deleteUrl = '/dashboard/user/' + user.id + '/destroy'

        console.log(deleteUrl)

        $('#delete_form').attr('action', deleteUrl)
        $('#csrf_delete').val('{{ csrf_token() }}');
      }
    })
  }
</script>

<div class="content-wrapper">
    <section class="content-header pt-3">
    	{{-- Title --}}
        <h1 class="text-black">
            Staff List
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- Card Box --}}
        @include('dashboards.widgets.card-box')

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                    	{{-- Title --}}
                        <h3 class="box-title text-black">
                            <i class="ion ion-ios-person mr-2"></i>Staffs List
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">

                        @if ($errors->any())
                            <div class="alert alert-danger first">
                                @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                                @endforeach
                            </div>

                            <br />
                        @endif
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}  
                            </div><br/>
                        @elseif(session()->get('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div><br/>
                        @endif
                        
                    	{{-- Button Add New --}}
                        <a class="btn btn-a mb-3" data-target="#modal-add-staff" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                            <i class="fa fa-plus mr-2"></i>Add Staff
                        </a>

                        <div class="table-responsive no-border">
                        	{{-- Table --}}
                            <table id="datatables" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Full Name</th>
                                        <th>Position</th>
                                        <th>E-Mail Address</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($staffs as $key => $staff)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $staff->details->nip }}</td>
                                            <td>
                                                <img src="{{ asset($staff->details->profile_photo) }}" class="img-circle-sm" alt="User Image">{{ $staff->details->first_name }} {{ $staff->details->last_name }}
                                            </td>
                                            <td>{{ ucfirst($staff->role )}}</td>
                                            <td>{{ $staff->email }}</td>
                                            <td>{{ $staff->details->phone }}</td>
                                            <td>
                                                <span class="label label-<?php echo $staff->status == 'active' ? 'success' : 'danger' ?>">{{ ucfirst($staff->status) }}</span>
                                            </td>
                                            <td>
                                                <!-- Button Edit -->
                                                <a class="btn-action mr-1" onclick="getMemberData('{{ $staff->id }}')" data-target="#modal-edit-staff" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <!-- End Button Edit -->
                                            
                                                <!-- Button Remove -->
                                                <a class="btn-action mr-1" onclick="confirmStaffDelete('{{ $staff->id }}')" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <!-- End Button Remove -->

                                                <!-- Button View -->
                                                {{-- <a class="btn-action" href="" data-toggle="tooltip" data-placement="bottom" title="View">
                                                    <i class="fa fa-user"></i>
                                                </a> --}}
                                                <!-- End Button View -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection