@extends('layouts.dashboards-app.app')

@section('content')

<script type="text/javascript">
    function confirmFeedbackDelete(feedbackId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/feedbacks/' + feedbackId + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var feedback = JSON.parse($.parseJSON(JSON.stringify(data)));

                var deleteUrl = '/dashboard/feedbacks/' + feedback.id

                console.log(deleteUrl)

                $('#delete_form').attr('action', deleteUrl)
                $('#csrf_delete').val('{{ csrf_token() }}');
            }
        })
    }
</script>

<div class="content-wrapper">
    <section class="content-header pt-3">
        <h1 class="text-black">
            Feedback
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- Card Box --}}
        @include('dashboards.widgets.card-box')
        
        <div class="row ">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        {{-- Title --}}
                        <h3 class="box-title text-black">
                            <i class="fa fa-comments mr-2"></i>Feedback
                        </h3>
                        
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                        <!-- <a class="btn btn-a mb-3" data-target="#modal-add-sales" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add">
                            <i class="fa fa-plus mr-2"></i>Place New Order
                        </a> -->
                        <div class="row mb-3">
                            <div class="col-xs-6 col-sm-2">
                                {{-- Sorting Dropdown --}}
                                <div id="toolbar">
                                    {{-- <select class="form-control">
                                        <option value="all">All</option>
                                        <option value="week">Week</option>
                                        <option value="month">Month</option>
                                        <option value="year">Year</option>
                                    </select> --}}
                                </div>
                            </div>
                        </div>

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

                        <div class="table-responsive no-border" id="printableSection">
                            {{-- Table --}}
                            <table id="datatables" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Feedback</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($feedbacks as $key => $feedback)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($feedback->created_at)->format('d M Y') }}</td>
                                            <td>{{ $feedback->name }}</td>
                                            <td>{{ $feedback->email }}</td>
                                            <td>{{ $feedback->feedback }}</td>
                                            <td>
                                                @if(Auth::user()->role == 'admin')
                                                    <!-- Button Remove -->
                                                    <a onclick="confirmFeedbackDelete('{{ $feedback->id }}')" class="btn-action" data-target="#modal-delete" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Delete" style="cursor: pointer">
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

@endsection