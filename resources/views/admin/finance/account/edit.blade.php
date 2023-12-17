<div class="card">
    <div class="card-header">
        <h6>{{_lang('Update Account - ')}} {{ $model->account_name }} </h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.finance.account.update', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
                <div class="row">
                    {{-- Account Name --}}
                    <div class="col-md-6 form-group">
                        <label for="account_name">{{ _lang('Account Name') }}</label>
                        <input value="{{ $model->account_name }}" type="text" autocomplete="off" name="account_name" id="account_name" class="form-control" required placeholder="Enter Account Name">
                    </div>

                    {{-- Primary Balance --}}
                    <div class="col-md-6 form-group">
                        <label for="balance">{{ _lang('Primary Balance') }}</label>
                        <input value="{{ $model->balance }}" type="text" autocomplete="off" name="balance" id="balance" class="form-control input_number" required placeholder="Enter Iniatial Balance">
                    </div>

                    {{-- Account Number --}}
                    <div class="col-md-6 form-group">
                        <label for="account_no">{{ _lang('Account Number') }}</label>
                        <input value="{{ $model->account_no }}" type="text" autocomplete="off" name="account_no" id="account_no" class="form-control" required placeholder="Enter Account Number">
                    </div>

                    {{-- Bank Name --}}
                    <div class="col-md-6 form-group">
                        <label for="bank_name">{{ _lang('Bank Name') }}</label>
                        <input value="{{ $model->bank_name }}" type="text" autocomplete="off" name="bank_name" id="bank_name" class="form-control" required placeholder="Enter Bank Name">
                    </div>

                    {{-- Branch Name --}}
                    <div class="col-md-6 form-group">
                        <label for="branch_name">{{ _lang('Branch Name') }}</label>
                        <input value="{{ $model->branch_name }}" type="text" autocomplete="off" name="branch_name" id="branch_name" class="form-control" required placeholder="Enter Branch Name">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6 form-group">
                        <label for="status">{{ _lang('Status') }}</label>
                        <select name="status" id="status" class="form-control select" data-placeholder="Select One" required data-parsley-errors-container="status_error">
                            <option value="">{{ _lang('Select One') }}</option>
                            <option {{ $model->status == 1 ? 'selected' : ''}} value="1">{{ _lang('Active') }}</option>
                            <option {{ $model->status == 0 ? 'selected' : ''}} value="0">{{ _lang('Inactive') }}</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12" align="right">
                        <button type="submit" class="btn btn-primary btn-sm"  id="submit">{{_lang('Create')}}<i class="fa ml-2 fa-plus-circle" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-success btn-sm " id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>{{_lang('Loading...')}} </button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </form>
    </div>
</div>