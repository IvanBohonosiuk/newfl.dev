@if ($crud->hasAccess('update'))
	<a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> {{ trans('backpack::crud.edit') }}</a>
@endif