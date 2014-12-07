@extends('app')

@section('content')
<div class="container">
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">Form Dashboard</div>
			<div class="panel-body">

				@include('partials.errors.basic')

				<h1>{{ $form->name }}</h1>

				<h2>Fields</h2>

				<table class="table table-striped">
				    <thead>
				        <tr>
				            <th>Field</th>
				            <th>Required</th>
				        </tr>
				    </thead>
				    <tbody>
				        @foreach($form->fields as $field)
				        <tr>
				            <td>{{ $field->name }}</td>
                            <td>{{ $field->required }}</td>
				        </tr>
				        @endforeach
				    </tbody>
                </table>

			</div>
		</div>
	</div>
</div>
</div>
@stop
