<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Resignation Application')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hr.resign.store') }}" method="post" id="content_form">
            @csrf
            <div class="row">
                {{-- Emplouee --}}
                <div class="col-md-12 form-group">
                    <label for="employee_id">{{ _lang('Awarded Employee') }}</label>
                    <select name="employee_id" id="employee_id" class="form-control select" data-placeholder="Select Employee" required data-parsley-errors-container="#employee_id_error">
                        <option value="">{{ _lang('Select Employee') }}</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    <span id="employee_id_error"></span>
                </div>

                {{-- Notice Date --}}
                <div class="col-md-6 form-group">
                    <label for="notice_date">{{ _lang('Notice Date') }}</label>
                    <input type="text" name="notice_date" id="notice_date" class="form-control date" value="{{ date('Y-m-d') }}" required>
                </div>

                {{-- Resign Date --}}
                <div class="col-md-6 form-group">
                    <label for="resign_date">{{ _lang('Resign Date') }}</label>
                    <input type="text" name="resign_date" id="resign_date" class="form-control date" value="{{ date('Y-m-d') }}" required>
                </div>

                {{-- File --}}
                <div class="col-md-6 form-group">
                    <label for="file">{{ _lang('File') }}</label>
                    <input type="file" name="file" id="file" class="form-control dropify"> 
                    <span class="text-danger">Please use PDF, DOCX file and file must not be upper 1024 KB or 1 MB</span>
                </div>

                {{-- Reason --}}
                <div class="col-md-6 form-group">
                    <label for="reason">{{ _lang('Reason') }}</label>4
                    <textarea name="reason" id="reason" class="form-control" cols="30" rows="9" placeholder="Enter Resign Reason"></textarea>
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