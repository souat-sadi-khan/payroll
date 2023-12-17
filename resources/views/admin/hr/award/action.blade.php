@can('hr_award.view')
    <button data-toggle="tooltip" data-placement="bottom" title="Show" class="btn btn-success btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.hr.award.show',$model->id)}}" ><i class="fa fa-edit"></i></button>
@endcan
@can('hr_award.update')
    <button data-toggle="tooltip" data-placement="bottom" title="Edit" class="btn btn-info btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.hr.award.edit',$model->id)}}" ><i class="fa fa-edit"></i></button>
@endcan
@can('hr_award.delete')
    <button  data-toggle="tooltip" data-placement="bottom" title="Delete" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.hr.award.destroy',$model->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null" data-placement="bottom"><i class="fa fa-trash"></i></button>
@endcan
