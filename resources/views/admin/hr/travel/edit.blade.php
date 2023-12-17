<div class="card">
    <div class="card-header">
        <h6>{{_lang('Update Travel Information')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hr.travel.update', $model->id) }}" method="post" id="content_form">
            @csrf
            @method('PATCH')
            <div class="row">
                {{-- Emplouee --}}
                <div class="col-md-12 form-group">
                    <label for="employee_id">{{ _lang('Employee') }}</label>
                    <select name="employee_id" id="employee_id" class="form-control select" data-placeholder="Select Employee" required data-parsley-errors-container="#employee_id_error">
                        <option value="">{{ _lang('Select Employee') }}</option>
                        @foreach ($employees as $employee)
                            <option {{ $model->employee_id == $employee->id ? 'selected' : '' }} value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    <span id="employee_id_error"></span>
                </div>

                {{-- Date --}}
                <div class="col-md-6 form-group">
                    <label for="start_date">{{ _lang('Start Date') }}</label>
                    <input type="text" name="start_date" id="start_date" class="form-control date" value="{{ formatDate($model->start_date) }}" required>
                </div>

                {{-- End Date --}}
                <div class="col-md-6 form-group">
                    <label for="end_date">{{ _lang('End Date') }}</label>
                    <input type="text" name="end_date" id="end_date" class="form-control date" value="{{ formatDate($model->end_date) }}" required>
                </div>

                {{-- Purpose of Visit --}}
                <div class="col-md-6 form-group">
                    <label for="purpose_of_visit">{{ _lang('Purpose of Visit') }}</label>
                    <input type="text" name="purpose_of_visit" id="purpose_of_visit" class="form-control" value="{{ $model->purpose_of_visit }}" placeholder="Enter Purpose of Visit">
                </div>

                {{-- Place to Visit --}}
                <div class="col-md-6 form-group">
                    <label for="place_to_visit">{{ _lang('Place to Visit') }}</label>
                    <input autocomplete="off" type="text" name="place_to_visit" value="{{ $model->place_to_visit }}" id="place_to_visit" class="form-control" placeholder="Enter Place to Visit">
                </div>

                {{-- Expected Budget --}}
                <div class="col-md-6 form-group">
                    <label for="expected_budget">{{ _lang('Expected Budget') }}</label>
                    <input autocomplete="off" value="{{ $model->expected_budget }}" type="text" name="expected_budget" id="expected_budget" class="form-control input_number" placeholder="Enter Expected Budget">
                </div>

                {{-- Actual Budget --}}
                <div class="col-md-6 form-group">
                    <label for="actual_budget">{{ _lang('Actual Budget') }}</label>
                    <input autocomplete="off" value="{{ $model->actual_budget }}" type="text" name="actual_budget" id="actual_budget" class="form-control input_number" placeholder="Enter Actual Budget">
                </div>

                {{-- Transfer Media --}}
                <div class="col-md-6 form-group">
                    <label for="transfer_media">{{ _lang('Transfer Media') }}</label>
                    <select name="transfer_media" id="transfer_media" class="form-control select" data-placeholder="Select One" data-parsley-errors-container="#transfer_media_error">
                        <option value="">{{ _lang('Select One') }}</option>
                        <option {{ $model->transfet_media == 'By Bus' ? 'selected' : '' }} value="By Bus">{{ _lang('By Bus') }}</option>
                        <option {{ $model->transfet_media == 'By Train' ? 'selected' : '' }} value="By Train">{{ _lang('By Train') }}</option>
                        <option {{ $model->transfet_media == 'By Plain' ? 'selected' : '' }} value="By Plain">{{ _lang('By Plain') }}</option>
                        <option {{ $model->transfet_media == 'By Taxi' ? 'selected' : '' }} value="By Taxi">{{ _lang('By Taxi') }}</option>
                        <option {{ $model->transfet_media == 'Other' ? 'selected' : '' }} value="Other">{{ _lang('Other') }}</option>
                    </select>
                    <span id="transfer_media_error"></span>
                </div>

                {{-- Arrangement Type --}}
                <div class="col-md-6 form-group">
                    <label for="arrangement_type">{{ _lang('Arrangement Type') }}</label>
                    <select name="arrangement_type" id="arrangement_type" class="form-control select" data-parsley-errors-container="#arrangement_type_error" data-placeholder="Select One">
                        <option value="">{{ _lang('Select One') }}</option>
                        <option {{ $model->arrangement_type == 'Corporate' ? 'selected' : ''}} value="Corporate">{{ _lang('Corporate') }}</option>
                        <option {{ $model->arrangement_type == 'Guest Hosue' ? 'selected' : ''}} value="Guest Hosue">{{ _lang('Guest Hosue') }}</option>
                    </select>
                    <span id="arrangement_type_error"></span>
                </div>

                <div class="form-group col-md-12" align="right">
                    <button type="submit" class="btn btn-primary btn-sm"  id="submit">{{_lang('Updaate')}}<i class="fa ml-2 fa-plus-circle" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-success btn-sm " id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>{{_lang('Loading...')}} </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>