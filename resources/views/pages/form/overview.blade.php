@extends('app')

@section('content')
<div class="container">
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">My Forms</div>
			<div class="panel-body">

				@include('partials.errors.basic')

				<table class="table table-striped">
				<thead>
				    <tr>
				        <th>Name</th>
				        <th>Created At</th>
				        <th></th>
				    </tr>
				</thead>
				<tbody>
				@foreach($forms as $form)
                    <tr>
                        <td><a href="/form/{{ $form->id }}/dashboard">{{ $form->name }}</a></td>
                        <td>{{ $form->created_at }}</td>
                        <td><a class="btn btn-default" href="/form/{{ $form->id }}">Show</a></td>
                    </tr>
                @endforeach
				</tbody>

				</table>

				<a class="btn btn-primary" href="/form/create">New Form</a>

			</div>
		</div>
	</div>
</div>
</div>
@stop
