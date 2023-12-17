@extends('layouts.app', ['title' => _lang(' Payroll Transection'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage Employee Payroll Transection from here."><i class="fa fa-ticket mr-4"></i> {{_lang('Employee Payroll Transection')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('employee_payroll_transection.create')
                        <button data-placement="bottom" title="Create New Employee Initialization" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.payroll-transection.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.payroll-transection.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('Voucher')}}</th>
                                <th>{{_lang('Employee')}}</th>
                                <th>{{_lang('Head')}}</th>
                                <th>{{_lang('Pay Method')}}</th>
                                <th>{{_lang('Amount')}}</th>
                                <th>{{_lang('Created At')}}</th>
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

{{-- Script Section --}}
@push('scripts')
    <script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
    <script src="{{ asset('js/employee/payroll_transaction.js') }}"></script>
@endpush

