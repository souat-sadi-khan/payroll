@can('finance_deposit.view')
    <button data-toggle="tooltip" data-placement="bottom" title="Show {{ $model->account_name }}" class="btn btn-success btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.finance.deposit.show',$model->id)}}" ><i class="fa fa-eye"></i></button>
@endcan
@can('finance_deposit.update')
    <button data-toggle="tooltip" data-placement="bottom" title="Edit {{ $model->account_name }}" class="btn btn-info btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.finance.deposit.edit',$model->id)}}" ><i class="fa fa-edit"></i></button>
@endcan
@can('finance_deposit.delete')
    <button  data-toggle="tooltip" data-placement="bottom" title="Delete {{ $model->account_name }}" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.finance.deposit.destroy',$model->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null" data-placement="bottom"><i class="fa fa-trash"></i></button>
@endcan