@extends('layouts.app', ['title' => _lang('HR Resignation'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage HR Resignation from here.."><i class="fa fa-dropbox mr-2"></i> {{_lang('HR Resignation')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('hr_resign.create')
                        <button data-placement="bottom" title="Create New HR Resignation" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.hr.resign.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-sm table-bordered content_managment_table" data-url="{{ route('admin.hr.resign.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Employee')}}</th>
                                <th>{{_lang('Notice Date')}}</th>
                                <th>{{_lang('Resign Date')}}</th>
                                <th>{{_lang('Approved Level')}}</th>
                                <th>{{_lang('Action')}}</th>
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
    <script src="{{ asset('js/hr/resign.js') }}"></script>
@endpush