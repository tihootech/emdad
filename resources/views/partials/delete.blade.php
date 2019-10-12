<form class="d-inline" action="{{url("$key/{$$key->id}")}}" method="post" id="delete-{{$key}}-{{$$key->id}}">
	@method('DELETE')
	@csrf
	<button type="button" class="btn @isset($btn_sm) btn-sm @endisset btn-outline-danger delete" @if($dtype=='hover') data-toggle="popover" data-content="حذف" data-trigger="hover" data-placement="top" data-target="delete-{{$key}}-{{$$key->id}}" @endif>
		<i class="fa fa-{{$dicon ?? 'trash'}} ml-1"></i>
		@if ($dtype=='text')
			{{$dword ?? 'حذف'}}
		@endif
	</button>
</form>
