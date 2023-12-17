@extends('layouts.app', ['title' => _lang('Finance Account'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Manage Finance Account from here.."><i class="fa fa-diamond mr-2"></i> {{_lang('Finance Account')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title" align="center">
                    @can('finance_account.create')
                        <button data-placement="bottom" title="Create New Employee Category" type="button" class="btn btn-info col-md-4" id="content_managment" data-url ="{{ route('admin.finance.account.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-sm table-bordered content_managment_table" data-url="{{ route('admin.finance.account.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Account Name')}}</th>
                                <th>{{_lang('Balance')}}</th>
                                <th>{{_lang('Account Numbr')}}</th>
                                <th>{{_lang('Bank Name')}}</th>
                                <th>{{_lang('Branch Name')}}</th>
                                <th>{{_lang('Status')}}</th>
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
    <script src="{{ asset('js/finance/account.js') }}"></script>
@endpush