@extends('layouts.dashboards-app.app')

@section('content')

<script type="text/javascript">
    function getUserData(userId) {
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

                $('#edit_member_email').val(user.email)

                $('#edit_member_form').attr('action', '/dashboard/user/' + userId +'/update')
                $('#edit_member_first_name').val(profile.first_name)
                $('#edit_member_last_name').val(profile.last_name)
                $('#edit_member_address').val(profile.address)
                $('#edit_member_phone').val(profile.phone)
                $('#edit_member_company').val(profile.company)
            }
        })
    }

    function confirmMemberDelete(userId) {
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
            Member List
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
                            <i class="ion ion-ios-people-outline mr-2"></i>Members List
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                        <!-- <a class="btn btn-a mb-3" data-target="#modal-add-staff" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                            <i class="fa fa-plus mr-2"></i>Add Member
                        </a> -->

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

                        <div class="table-responsive no-border">
                            {{-- Table --}}
                            <table id="datatables" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Full Name</th>
                                        <th>Address</th>
                                        <th>E-Mail Address</th>
                                        <th>Phone Number</th>
                                        <th>Company</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($members as $key => $member)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $member->details->first_name }} {{ $member->details->last_name }}</td>
                                        <td>{{ $member->details->address }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->details->phone }}</td>
                                        <td>{{ $member->details->company }}</td>
                                        <td>
                                            <!-- Button Edit -->
                                            <a class="btn-action mr-1" onclick="getUserData('{{ $member->id }}')" data-target="#modal-edit-member" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Edit" style="cursor: pointer">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <!-- End Button Edit -->
                                        
                                            <!-- Button Remove -->
                                            <a class="btn-action mr-1" onclick="confirmMemberDelete('{{ $member->id }}')" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
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