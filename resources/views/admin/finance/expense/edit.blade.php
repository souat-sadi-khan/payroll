<div class="card">
    <div class="card-header">
        <h6>{{_lang('Update Expense Information')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.finance.expense.update', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
                <div class="row">
                    {{-- Account ID --}}
                    <div class="col-md-4 form-group">
                        <label for="account_id">{{ _lang('Account For Deposit') }}</label>
                        <select name="account_id" id="account_id" class="form-control select" data-placeholder="Select One" required data-parsley-errors-container="#account_id_error">
                            <option value="">{{ _lang('Select One') }}</option>
                            @foreach ($accounts as $account)
                                <option {{ $model->account_id == $account->id ? 'selected' : '' }} value="{{ $account->id }}">{{ $account->account_name }}</option>
                            @endforeach
                        </select>
                        <span id="account_id_error"></span>
                    </div>

                    {{-- Payees ID --}}
                    <div class="col-md-4 form-group">
                        <label for="payees_id">{{ _lang('Payees') }}</label>
                        <select name="payees_id" id="payees_id" class="form-control select" data-placeholder="Select One" required data-parsley-errors-container="#payees_id_error">
                            <option value="">{{ _lang('Select One') }}</option>
                            @foreach ($employees as $employee)
                                <option {{ $model->payees_id == $employee->id ? 'selected' : '' }} value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                        <span id="payees_id_error"></span>
                    </div>

                    {{-- Amount --}}
                    <div class="col-md-4 form-group">
                        <label for="amount">{{ _lang('Amount') }}</label>
                        <input value="{{ $model->amount }}" type="text" autocomplete="off" name="amount" id="amount" class="form-control input_number" required placeholder="Enter Amount">
                    </div>

                    {{-- Date --}}
                    <div class="col-md-4 form-group">
                        <label for="date">{{ _lang('Date') }}</label>
                        <input type="text" autocomplete="off" name="date" id="date" class="form-control date" required value="{{ $model->date }}">
                    </div>

                    {{-- Payment Method --}}
                    <div class="col-md-4 form-group">
                        <label for="payment_method">{{ _lang('Payment Method') }}</label>
                        <select name="payment_method" id="payment_method" data-parsley-errors-container="#payment_method_error" class="form-control select" data-placeholder="Select One">
                            <option value="">{{ _lang('Select One') }}</option>
                            <option {{ $model->payment_method == 'Cash' ? 'selected' : ''}} value="Cash">{{ _lang('Cash') }}</option>
                            <option {{ $model->payment_method == 'Bank Cheque' ? 'selected' : ''}} value="Bank Cheque">{{ _lang('Bank Cheque') }}</option>
                            <option {{ $model->payment_method == 'Mobile Banking' ? 'selected' : ''}} value="Mobile Banking">{{ _lang('Mobile Banking') }}</option>
                            <option {{ $model->payment_method == 'Other' ? 'selected' : ''}} value="Other">{{ _lang('Other') }}</option>
                        </select>
                        <span id="payment_method_error"></span>
                    </div>

                    {{-- Reference Number --}}
                    <div class="col-md-4 form-group">
                        <label for="ref_no">{{ _lang('Reference Number') }}</label>
                        <input value="{{ $model->ref_no }}" type="text" autocomplete="off" name="ref_no" id="ref_no" class="form-control" placeholder="Enter Reference Number">
                    </div>

                    {{-- Notes --}}
                    <div class="col-md-6 form-group">
                        <label for="notes">{{ _lang('Notes') }}</label>4
                        <textarea name="notes" id="notes" class="form-control" cols="30" rows="9" placeholder="Enter Deposit Notes">{{ $model->notes }}</textarea>
                    </div>

                    {{-- File --}}
                    <div class="col-md-6 form-group">
                        <label for="file">{{ _lang('File') }}</label>
                        <input type="file" name="file" id="file" class="form-control dropify" data-default-file="{{ get_option('host') == 1 ? asset('storage/finance/expense/'.$model->photo) : asset('uploads/'. $model->photo) }}"> 
                    </div>

                    <div class="form-group col-md-12" align="right">
                        <button type="submit" class="btn btn-primary btn-sm"  id="submit">{{_lang('Update')}}<i class="fa ml-2 fa-plus-circle" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-success btn-sm " id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>{{_lang('Loading...')}} </button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </form>
    </div>
</div>