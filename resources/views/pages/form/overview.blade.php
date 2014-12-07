@extends('app')

@section('content')
<div class="container">
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">My Forms</div>
			<div class="panel-body">

				@include('partials.errors.basic')

				<table class="table">
				    @foreach($forms as $form)
				        <tr>
				            <td><a href="/form/{{ $form->id }}/dashboard">{{ $form->name }}</a></td>
				        </tr>
				    @endforeach
				</table>

				<a class="btn btn-primary" href="/form/create">New Form</a>

			</div>
		</div>
	</div>
</div>
</div>
@stop
