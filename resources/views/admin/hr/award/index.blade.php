@extends('layouts.app', ['title' => _lang('HR Award'), 'modal' => 'xl'])

@push('admin.css')
    <link rel="stylesheet" href="{{asset('css/MonthPicker.css')}}">
@endpush

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage HR Award from here.."><i class="fa fa-dropbox mr-2"></i> {{_lang('HR Award')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('hr_award.create')
                        <button data-placement="bottom" title="Create New HR Award Type" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.hr.award.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-sm table-bordered content_managment_table" data-url="{{ route('admin.hr.award.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Award')}}</th>
                                <th>{{_lang('Employee')}}</th>
                                <th>{{_lang('Month')}}</th>
                                <th>{{_lang('Gift')}}</th>
                                <th>{{_lang('Price')}}</th>
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
    <script src="{{ asset('js/MonthPicker.js') }}"></script>
    <script src="{{ asset('js/hr/award.js') }}"></script>
@endpush