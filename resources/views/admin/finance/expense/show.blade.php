<div class="card">
    <div class="card-header">
        <h6>{{_lang('View Expense Full View Information')}}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="account_id">{{ _lang('Account For Deposit') }}</label>
                <input readonly type="text" class="form-control" value="{{ $model->account->account_name }}">
            </div>

            {{-- Payees ID --}}
            <div class="col-md-4 form-group">
                <label for="payees_id">{{ _lang('Payees') }}</label>
                <input readonly type="text" class="form-control" value="{{ $model->employee->name }}">
            </div>

            {{-- Amount --}}
            <div class="col-md-4 form-group">
                <label for="amount">{{ _lang('Amount') }}</label>
                <input type="text"class="form-control" readonly value="{{ get_option('currency') }} {{ number_format($model->amount, 2) }}">
            </div>

            {{-- Date --}}
            <div class="col-md-4 form-group">
                <label for="date">{{ _lang('Date') }}</label>
                <input type="text" readonly class="form-control" value="{{ formatDate($model->date) }}">
            </div>

            {{-- Payment Method --}}
            <div class="col-md-4 form-group">
                <label for="payment_method">{{ _lang('Payment Method') }}</label>
                <input type="text" readonly class="form-control" value="{{ ($model->payment_method) }}">
            </div>

            {{-- Reference Number --}}
            <div class="col-md-4 form-group">
                <label for="ref_no">{{ _lang('Reference Number') }}</label>
                <input type="text" readonly class="form-control" value="{{ $model->ref_no }}">
            </div>

            {{-- Notes --}}
            <div class="col-md-6 form-group">
                <label for="notes">{{ _lang('Notes') }}</label>
                <textarea class="form-control" cols="30" rows="9" readonly>{{ $model->notes }}</textarea>
            </div>

            {{-- File --}}
            <div class="col-md-6 form-group">
                <label for="file">{{ _lang('File') }}</label>
                <div style="background-color: #E9ECEF; border:1px solid #" class="text-center p-3">
                    @if ($model->file != null)
                        @if (get_option('host') == 1)
                            <a class="pt-2" href="{{ asset('storage/finance/expense/'. $model->file) }}" download><i class="fa fa-download mr-2" aria-hidden="true"></i>{{ _lang('Download File') }} </a>
                        @else 
                            <img class="w-50 rounded" src="{{ asset('uploads//'. $model->file) }}" alt="Award Photo">
                            <a class="mt-2" href="{{ asset('uploads/'. $model->file) }}" download><i class="fa fa-download mr-2" aria-hidden="true"></i>{{ _lang('Download File') }} </a>
                        @endif
                    @endif
                </div>
            </div>

            <div class="form-group col-md-12" align="right">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>