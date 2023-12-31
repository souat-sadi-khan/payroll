<div class="card">
    <div class="card-header">
        <h6>{{_lang('Ceate New Employee Document Type')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.document-type.store')}}" method="post" id="content_form">
            @csrf
                <div class="row">
                    {{-- Employee Document Type Name --}}
                    <div class="col-md-12 form-group">
                        <label for="name">{{_lang('Document Type Name')}} <span class="text-danger">*</span> </label>
                        <input autocomplete="off" type="text" name="name" id="name" class="form-control" placeholder="Enter Employee Document Type Name" required>
                    </div>
                    {{-- Employee Document Type Description --}}
                    <div class="col-md-12 form-group">
                        <label for="name">{{_lang('Document Type Description')}} </label>
                        <textarea name="description" class="form-control" placeholder="Enter Employee Document Type Description"></textarea>
                    </div>
                    @can('employee_document_type.create')
                        <div class="form-group col-md-12" align="right">
                            <button type="submit" class="btn btn-primary btn-sm"  id="submit">{{_lang('Create')}}<i class="fa ml-2 fa-plus-circle" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-success btn-sm " id="submiting" style="display: none;"><i class="fa fa-spinner fa-spin fa-fw"></i>{{_lang('Loading...')}} </button>
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        </div>
                    @endcan 
                </div>
        </form>
    </div>
</div>