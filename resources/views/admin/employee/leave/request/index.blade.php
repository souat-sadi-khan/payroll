@extends('layouts.app', ['title' => _lang('Employee Leave Request'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage Employee Leave Request from here."><i class="fa fa-cube mr-2"></i> {{_lang('Employee Leave Request')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('employee_leave_request.create')
                    <button data-placement="bottom" title="Create New Employee Leave Request" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.employee-leave-request.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.leave_request.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Name')}}</th>
                                <th>{{_lang('Designation')}}</th>
                                <th>{{_lang('Leave Type')}}</th>
                                <th>{{_lang('Period')}}</th>
                                <th>{{_lang('Count')}}</th>
                                <th>{{_lang('Status')}}</th>
                                <th>{{_lang('Requested by')}}</th>
                                <th>{{_lang('action')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
    <script src="{{ asset('js/employee/leave_request.js') }}"></script>
@endpush