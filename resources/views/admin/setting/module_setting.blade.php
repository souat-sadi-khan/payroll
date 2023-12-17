@extends('layouts.app', ['title' => _lang('Module Configuration'), 'modal' => false])

@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-toggle="tooltip" data-placement="bottom" title="Change Your Software Module Configuration from here."><i class="fa fa-wrench mr-2"></i> {{_lang('Module Configuration')}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="bs-component">

                    <!-- Tab panes -->
                    {!! Form::open(['route' => 'admin.setting', 'id' => 'content_form','files' => true, 'method' => 'POST']) !!}
                        <div class="tab-content">
                            {{-- This is for Home Section --}}
                            <h3 class="text-center">Employee Configaration</h3><hr>
                                <div class="row">
                                    {{-- Employee Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('employee_code_prefix', _lang('Employee Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('employee_code_prefix', get_option('employee_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Employee Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Employee Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_employee_code', _lang('Digits Employee Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_employee_code', get_option('digits_employee_code'), ['class' => 'form-control input_number', 'placeholder' => _lang('Type Digits Employee Code')]) }}
                                    </div>
                                </div>
                        </div>
                        @can('module_configuration.update')
                            {{-- This is for submit Button --}}
                            <div class="text-right mr-2 mt-4">
                                <button data-placement="bottom" title="Update The Change"  type="submit" class="btn btn-primary"  id="submit">{{_lang('Update')}}</button>
                                <button type="button" class="btn btn-success btn-sm " id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>{{_lang('Loading...')}} </button>
                            </div>
                        @endcan
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
    <script src="{{ asset('js/pages/setting.js') }}"></script>
@endpush
