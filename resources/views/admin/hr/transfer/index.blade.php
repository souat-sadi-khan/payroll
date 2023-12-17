@extends('layouts.app', ['title' => _lang('HR Employee Department Transfer'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage HR Employee Transfer from here.."><i class="fa fa-dropbox mr-2"></i> {{_lang('HR Employee Department Transfer')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('hr_transfer.create')
                        <button data-placement="bottom" title="Create New HR Employee Transfer" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.hr.transfer.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-sm table-bordered content_managment_table" data-url="{{ route('admin.hr.transfer.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Employee')}}</th>
                                <th>{{_lang('Past Department')}}</th>
                                <th>{{_lang('New Department')}}</th>
                                <th>{{_lang('Date')}}</th>
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
    <script src="{{ asset('js/MonthPicker.js') }}"></script>
    <script src="{{ asset('js/hr/transfer.js') }}"></script>
@endpush