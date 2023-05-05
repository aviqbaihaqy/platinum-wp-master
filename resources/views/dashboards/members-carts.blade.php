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

                $('#clientName').text(profile.first_name + ' ' + profile.last_name)
                $('#clientAddress').text(profile.address)
                $('#clientEmail').text(user.email)
                $('#clientPhone').text(profile.phone)
                $('#clientCompany').text(profile.company)
            }
        })
    }

    function confirmCartDelete(userId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/user/' + userId + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var result = JSON.parse($.parseJSON(JSON.stringify(data)));
                var user = result.selectedUser

                var deleteUrl = '/dashboard/carts/' + user.id + '/destroy_user_cart'

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
            Members Carts
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
                            <i class="fa fa-tags mr-2"></i>Members Carts
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive no-border">
                        	{{-- Table --}}
                            <table id="datatables" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Last Added Items</th>
                                        <th>Client</th>
                                        <th>Cart Order</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        $counter = 1;
                                    ?>
                                    @foreach($carts as $user => $cartItems)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ Carbon\Carbon::parse($cartItems->lastAddedItem)->format('d / M / Y') }}</td>
                                        <td>
                                            <a onclick="getUserData('{{ $cartItems->userId }}')" data-target="#modal-view-client" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                                {{ $user }}
                                            </a>
                                        </td>
                                        <td>
                                            <a data-target="#modal-view-carts-{{ $cartItems->userId }}" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                            {{ count($cartItems) }} Product
                                            </a>
                                        </td>
                                        <td>
                                            @if(Auth::user()->role == 'admin')
                                                <!-- Button Remove -->
                                                <a onclick="confirmCartDelete('{{ $cartItems->userId }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <!-- End Button Remove -->
                                            @endif
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


@include('layouts.dashboards-app.modals.modal-view-carts')

@endsection