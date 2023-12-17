<div class="card">
    <div class="card-header">
        <h6>{{_lang('Show Full View Award Information for -') }} </b> {{ $model->month . '-'. $model->year }} </b> </h6>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- Emplouee --}}
            <div class="col-md-6 form-group">
                <label for="employee_id">{{ _lang('Awarded Employee') }}</label>
                <input class="form-control" type="text" readonly value="{{ $model->employee->name }} ( {{ employee_designation($model->employee_id) }} ) ">
            </div>

            {{-- Award Type --}}
            <div class="col-md-6 form-group">
                <label for="award_type_id">{{ _lang('Award') }}</label>
                <input class="form-control" type="text" readonly value="{{ $model->award->name }}">
            </div>

            {{-- Date --}}
            <div class="col-md-6 form-group">
                <label for="date">{{ _lang('Date') }}</label>
                <input class="form-control" type="text" readonly value="{{ formatDate($model->date) }}">
            </div>

            {{-- Month adn Year --}}
            <div class="col-md-6 form-group">
                <label for="month">{{ _lang('Awarded Month adn Year') }}</label>
                <input class="form-control" type="text" readonly value="{{ $model->month . '-'. $model->year }}">
            </div>

            {{-- Gift --}}
            <div class="col-md-6 form-group">
                <label for="gift">{{ _lang('Gift') }}</label>
                <input class="form-control" type="text" readonly value="{{ $model->gift }}">
            </div>

            {{-- Cash --}}
            <div class="col-md-6 form-group">
                <label for="cash">{{ _lang('Cash') }}</label>
                <input class="form-control" type="text" readonly value="{{ $model->cash != null ? get_option('currency') . ' ' . number_format($model->cash, 2) : '' }}">
            </div>
                
            {{-- Notes --}}
            <div class="col-md-12 form-group">
                <label for="notes">{{ _lang('Notes') }}</label>
                <textarea readonly class="form-control" cols="30" rows="2">{{ $model->notes }}</textarea>
            </div>

            {{-- File --}}
            <div class="col-md-6 form-group">
                <label for="photo">{{ _lang('Photo') }}</label>
                <div style="background-color: #E9ECEF; border:1px solid #" class="text-center p-3">
                    @if ($model->photo != null)
                        @if (get_option('host') == 1)
                            <img class="w-50 rounded" src="{{ asset('storage/hr/award/'. $model->photo) }}" alt="Award Photo">
                            <br>
                            <a class="pt-2" href="{{ asset('storage/hr/award/'. $model->photo) }}" download><i class="fa fa-download mr-2" aria-hidden="true"></i>{{ _lang('Download File') }} </a>
                        @else 
                            <img class="w-50 rounded" src="{{ asset('uploads//'. $model->photo) }}" alt="Award Photo">
                            <a class="mt-2" href="{{ asset('uploads/'. $model->photo) }}" download><i class="fa fa-download mr-2" aria-hidden="true"></i>{{ _lang('Download File') }} </a>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Award Info --}}
            <div class="col-md-6 form-group">
                <label for="award_info">{{ _lang('Award Information') }}</label>
                <textarea readonly class="form-control" cols="30" rows="5">{{ $model->award_info }}</textarea>
            </div>

        </div>
    </div>
</div>