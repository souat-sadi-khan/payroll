@extends('layouts.app', ['title' => _lang('Employee Leave'), 'modal' => 'lg'])

@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Employee Leave."><i class="fa fa-cube mr-2"></i>
            {{_lang('Employee Leave')}}</h1>
    </div>
</div>
@stop

@section('content')
<div class="row">

    <div class="col-md-5 mx-auto">
        <div class="card card-box border border-primary">
            <div class="card-body text-center">
                <i class="fa fa-folder-open-o fa-4x" aria-hidden="true"></i>
                <h4 class="card-title">{{_lang('Leave Allocation')}} </h4>
                <p class="card-text font-80pc">{{_lang('Allocate leaves to your employee for selected duration, check leave
                    credit & utilized report')}} </p> 
                    @can('employee_leave_allocation.view')
                        <a href="{{ route('admin.employee-leave-allocation.index') }}" class="btn btn-info btn-sm">{{_lang('Go to Leave Allocation')}} </a>
                    @endcan
            </div>
        </div>
    </div>
    <div class="col-md-5 mx-auto">
        <div class="card card-box border border-primary">
            <div class="card-body text-center">
                <i class="fa fa-send-o fa-4x" aria-hidden="true"></i>
                <h4 class="card-title">{{_lang('Leave Request')}} </h4>
                <p class="card-text font-80pc">{{_lang('Request leave for your employee, take action on leave request')}} <br> </p> 
                @can('employee_leave_request.view')
                    <a href="{{ route('admin.employee-leave-request.index') }}" class="btn btn-info btn-sm">{{_lang('Go to Leave Request')}}</a>
                @endcan
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