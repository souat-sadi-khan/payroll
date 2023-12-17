<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Award')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hr.award.store') }}" method="post" id="content_form">
            @csrf
            <div class="row">
                {{-- Emplouee --}}
                <div class="col-md-6 form-group">
                    <label for="employee_id">{{ _lang('Awarded Employee') }}</label>
                    <select name="employee_id" id="employee_id" class="form-control select" data-placeholder="Select Employee" required data-parsley-errors-container="#employee_id_error">
                        <option value="">{{ _lang('Select Employee') }}</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    <span id="employee_id_error"></span>
                </div>

                {{-- Award Type --}}
                <div class="col-md-6 form-group">
                    <label for="award_type_id">{{ _lang('Award') }}</label>
                    <select name="award_type_id" id="award_type_id" class="form-control select" data-placeholder="Select One" required data-parsley-errors-container="#award_type_id_error">
                        <option value="">{{ _lang('Select One') }}</option>
                        @foreach ($award_types as $award_type)
                            <option value="{{ $award_type->id }}">{{ $award_type->name }}</option>
                        @endforeach
                    </select>
                    <span id="award_type_id_error"></span>
                </div>

                {{-- Date --}}
                <div class="col-md-6 form-group">
                    <label for="date">{{ _lang('Date') }}</label>
                    <input type="text" name="date" id="date" class="form-control date" value="{{ date('Y-m-d') }}" required>
                </div>

                {{-- Month adn Year --}}
                <div class="col-md-6 form-group">
                    <label for="month">{{ _lang('Awarded Month adn Year') }}</label>
                    <input type="text" name="month" id="month" class="form-control month_year" readonly required>
                </div>

                {{-- Gift --}}
                <div class="col-md-6 form-group">
                    <label for="gift">{{ _lang('Gift') }}</label>
                    <input type="text" name="gift" id="gift" class="form-control" placeholder="Enter Awarded Gift">
                </div>

                {{-- Cash --}}
                <div class="col-md-6 form-group">
                    <label for="cash">{{ _lang('Cash') }}</label>
                    <input autocomplete="off" type="text" name="cash" id="cash" class="form-control input_number" placeholder="Enter Awarded Cash">
                </div>
                
                {{-- Notes --}}
                <div class="col-md-12 form-group">
                    <label for="notes">{{ _lang('Notes') }}</label>
                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="2" placeholder="Enter Notes"></textarea>
                </div>

                {{-- File --}}
                <div class="col-md-6 form-group">
                    <label for="photo">{{ _lang('Photo') }}</label>
                    <input type="file" name="photo" id="photo" class="form-control dropify"> 
                    <span class="text-danger">Please use JPG, JPEG, PNG file and file must not be upper 1024 KB or 1 MB</span>
                </div>

                {{-- Award Info --}}
                <div class="col-md-6 form-group">
                    <label for="award_info">{{ _lang('Award Information') }}</label>4
                    <textarea name="award_info" id="award_info" class="form-control" cols="30" rows="9" placeholder="Enter Award Information"></textarea>
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