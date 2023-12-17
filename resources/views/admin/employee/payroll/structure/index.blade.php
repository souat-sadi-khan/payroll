@extends('layouts.app', ['title' => _lang(' Salary Structure'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage Employee Salary Structure from here."><i class="fa fa-universal-access mr-4"></i> {{_lang('Employee Salary Structure')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('employee_payroll_salary_structure.create')
                        <button data-placement="bottom" title="Create New Employee Salary Structure" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.payroll-s-structure.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.employee-s-structure.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Employee')}}</th>
                                <th>{{_lang('Payroll Template')}}</th>
                                <th>{{_lang('Date Effective')}}</th>
                                <th>{{_lang('Net Salary')}}</th>
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
    <script src="{{ asset('js/employee/salary_structure.js') }}"></script>
@endpush