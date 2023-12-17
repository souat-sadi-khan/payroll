<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Award Type')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hr.award-type.store') }}" method="post" id="content_form">
            @csrf
            <div class="row">
                {{-- name --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{ _lang('Name') }}</label>
                    <input type="text" autocomplete="off" name="name" id="name" class="form-control" placeholder="Enter Award Type Name">
                </div>
                
                {{-- Description --}}
                <div class="col-md-12 form-group">
                    <label for="description">{{ _lang('Description') }}</label>4
                    <textarea name="description" id="description" class="form-control" cols="30" rows="2" placeholder="Enter Award Type description"></textarea>
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