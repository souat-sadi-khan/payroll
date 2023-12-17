<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Employee Department Transfer')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hr.transfer.store') }}" method="post" id="content_form">
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

                {{-- Date --}}
                <div class="col-md-6 form-group">
                    <label for="date">{{ _lang('Date') }}</label>
                    <input type="text" name="date" id="date" class="form-control date" value="{{ date('Y-m-d') }}">
                </div>

                {{-- Current Department --}}
                <div class="col-md-6 form-group">
                    <label for="current_designation">{{ _lang('Current Department') }}</label>
                    <input type="text" class="form-control" id="current_designation" value="Select Employee"  readonly>
                    <input type="hidden" name="current_department" id="current_department">
                </div>

                {{-- New Department --}}
                <div class="col-md-6 form-group">
                    <label for="new_department">{{ _lang('New Department') }}</label>
                    <select name="new_department" id="new_department" class="form-control select" data-placeholder="Select Employee Department" required data-parsley-errors-container="#new_department_error">
                        <option value="">{{ _lang('Select Employee Department') }} </option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    <span id="new_department_error"></span>
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

<script>
    $('#employee_id').change(function() {
        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/hr/get_employee_designation",
            data: { id : id},
            cache: false,
            success: function(data){
                $("#current_designation").val(data.name);
                $('#current_department').val(data.id);
            }
        });
    })
</script>