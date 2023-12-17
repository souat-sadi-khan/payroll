<div class="card">
    <div class="card-header">
        <h6>{{_lang('Resignation Application Full View Information')}}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- Emplouee --}}
            <div class="col-md-6 form-group">
                <label for="employee_id">{{ _lang('Awarded Employee') }}</label>
                <input type="text" class="form-control" readonly value="{{ $model->employee->name }} ( {{ employee_designation($model->employee_id) }} )">
            </div>

            <div class="col-md-6 form-group">
                <label for="approved_lavel">{{ _lang('Approved Level') }}</label>
                <input type="text" class="form-control" readonly value="{{ $model->approve_level == null ? 'Not Set Yet' : $model->approve_level }}">
            </div>

            {{-- Notice Date --}}
            <div class="col-md-6 form-group">
                <label for="notice_date">{{ _lang('Notice Date') }}</label>
                <input type="text" readonly class="form-control" value="{{ formatDate($model->notice_datedate) }}">
            </div>

            {{-- Resign Date --}}
            <div class="col-md-6 form-group">
                <label for="resign_date">{{ _lang('Resign Date') }}</label>
                <input type="text" readonly class="form-control" value="{{ formatDate($model->resign_date) }}">
            </div>

            {{-- File --}}
            <div class="col-md-6 form-group">
                <label for="file">{{ _lang('File') }}</label>
                <div style="background-color: #E9ECEF; border:1px solid #" class="text-center p-3">
                    @if ($model->file != null)
                        @if (get_option('host') == 1)
                            <a class="pt-2" href="{{ asset('storage/hr/resign/'. $model->file) }}" download><i class="fa fa-download mr-2" aria-hidden="true"></i>{{ _lang('Download File') }} </a>
                        @else 
                            <a class="mt-2" href="{{ asset('uploads/'. $model->file) }}" download><i class="fa fa-download mr-2" aria-hidden="true"></i>{{ _lang('Download File') }} </a>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Reason --}}
            <div class="col-md-6 form-group">
                <label for="reason">{{ _lang('Reason') }}</label>4
                <textarea readonly class="form-control" cols="30" rows="2">{{ $model->resign_reason }}</textarea>
            </div>

            <div class="form-group col-md-12" align="right">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>