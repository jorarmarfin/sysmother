@if(Session::has('message-errors'))
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" alia-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<i class="icon fa fa-ban"></i>
	{{Session::get('message-errors')}}
</div>
@endif