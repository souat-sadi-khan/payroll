<div class="card">
    <div class="card-header">
        <h6>{{_lang('Show Full View Travel Information')}}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- Emplouee --}}
            <div class="col-md-12 form-group">
                <label for="employee_id">{{ _lang('Employee') }}</label>
                <input type="text" class="form-control" readonly value="{{ $model->employee->name }} ( {{ employee_designation($model->employee_id) }} )">
            </div>

            {{-- Date --}}
            <div class="col-md-6 form-group">
                <label for="start_date">{{ _lang('Start Date') }}</label>
                <input type="text" readonly class="form-control" value="{{ formatDate($model->start_date) }}">
            </div>

            {{-- End Date --}}
            <div class="col-md-6 form-group">
                <label for="end_date">{{ _lang('End Date') }}</label>
                <input type="text" readonly class="form-control" value="{{ formatDate($model->end_date) }}">
            </div>

            {{-- Purpose of Visit --}}
            <div class="col-md-6 form-group">
                <label for="purpose_of_visit">{{ _lang('Purpose of Visit') }}</label>
                <input type="text" readonly class="form-control" value="{{ $model->purpose_of_visit }}">
            </div>

            {{-- Place to Visit --}}
            <div class="col-md-6 form-group">
                <label for="place_to_visit">{{ _lang('Place to Visit') }}</label>
                <input type="text" readonly class="form-control" value="{{ $model->place_to_visit }}">
            </div>

            {{-- Expected Budget --}}
            <div class="col-md-6 form-group">
                <label for="expected_budget">{{ _lang('Expected Budget') }}</label>
                <input type="text" readonly class="form-control" value="{{ get_option('currency') . ' '. number_format($model->expected_budget) }}">
            </div>

            {{-- Actual Budget --}}
            <div class="col-md-6 form-group">
                <label for="actual_budget">{{ _lang('Actual Budget') }}</label>
                <input type="text" readonly class="form-control" value="{{ get_option('currency') . ' '. number_format($model->actual_budget) }}">
            </div>

            {{-- Transfer Media --}}
            <div class="col-md-6 form-group">
                <label for="transfer_media">{{ _lang('Transfer Media') }}</label>
                <input type="text" readonly class="form-control" value="{{ $model->transfer_media }}">
            </div>

            {{-- Arrangement Type --}}
            <div class="col-md-6 form-group">
                <label for="arrangement_type">{{ _lang('Arrangement Type') }}</label>
                <input type="text" readonly class="form-control" value="{{ $model->arrangement_type }}">
            </div>

            <div class="form-group col-md-12" align="right">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>