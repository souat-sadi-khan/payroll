@extends('layouts.app', ['title' => _lang('My Logs'), 'modal' => 'lg'])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Details Information about my Logs of all time.."><i class="fa fa-diamond mr-2"></i> {{_lang('My Logs')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-sm table-hover table-bordered content_managment_table" data-url="{{ route('admin.my-log.datatable') }}">
                        <thead>
                            <th width="20px">No</th>
                            <th>Subject</th>
                            <th>URL</th>
                            <th>Method</th>
                            <th>Ip</th>
                            <th width="300px">User Agent</th>
                            <th>User</th>
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
    <script src="{{ asset('js/pages/log.js') }}"></script>
@endpush