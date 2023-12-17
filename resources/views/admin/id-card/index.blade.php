@extends('layouts.app', ['title' => _lang('Employee Id Card Template'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage Employee Id Card Template from here."><i class="fa fa-id-badge mr-2"></i> {{_lang('Employee Id Card Template')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('employee_id_card.create')
                        <button data-placement="bottom" title="Create New Employee Id Card Template" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.id-card-template.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.id-card-template.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Template Name')}}</th>
                                <th>{{_lang('For')}}</th>
                                <th>{{_lang('Width')}}</th>
                                <th>{{_lang('Height')}}</th>
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
    <script src="{{ asset('js/pages/id-card.js') }}"></script>
@endpush