@extends('layouts.app', ['title' => _lang('Employee Leave Type'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage Employee Leave Type from here."><i class="fa fa-connectdevelop mr-2"></i> {{_lang('Employee Leave Type')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('employee_leave_type.create')
                        <button data-placement="bottom" title="Create New Employee Leave Type" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.leave-type.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.leave_type.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Name')}}</th>
                                <th>{{_lang('Alias')}}</th>
                                <th>{{_lang('Description')}}</th>
                                <th>{{_lang('Active?')}}</th>
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
    <script src="{{ asset('js/employee/leave_type.js') }}"></script>
@endpush