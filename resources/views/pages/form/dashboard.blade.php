@extends('app')

@section('content')
<div class="container">
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">Form Dashboard</div>
			<div class="panel-body">

				@include('partials.errors.basic')

				<h1>{{ $form->name }} <a class="btn btn-default" href="/form/{{ $form->id }}">Show</a></h1>

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

                <h2>Submissions</h2>

                <table class="table table-striped">
                    <thead>
                        <tr>
                        @foreach($form->fields as $field)
                            <th>{{ucfirst($field->name)}}</th>
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                        <tr>
                            @foreach($form->fields as $field)
                                @if(isset($submission[$field->id]))
                                    <td>{{$submission[$field->id]}}</td>
                                @endif
                            @endforeach
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
