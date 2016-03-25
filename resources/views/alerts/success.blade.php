@if(Session::has('message-success'))
<div class="alert alert-success alert-dismissible" role="success">
	<button type="button" class="close" data-dismiss="alert" alia-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
	<i class="icon fa fa-check"></i>
	{{Session::get('message-success')}}
</div>
@endif