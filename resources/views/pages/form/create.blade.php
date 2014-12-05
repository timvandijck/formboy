@extends('app')

@section('content')
<div class="container">
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">Create a new form</div>
			<div class="panel-body">

				@include('partials.errors.basic')

				<form class="form-horizontal" role="form" method="POST" action="/form/create" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Name</label>
						<div class="col-sm-6">
							<input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Template</label>
						<div class="col-sm-6">
							<input type="file" id="template_file" name="template_file">
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-3 control-label">CSS</label>
						<div class="col-sm-6">
							<input type="file" id="css_file" name="css_file">
						</div>
					</div>
					<div class="form-group">
						<label for="password_confirmation" class="col-sm-3 control-label">Javascript</label>
						<div class="col-sm-6">
							<input type="file" id="js_file" name="js_file">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-3">
							<button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-cloud-upload"></i>Create Form</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
</div>
@stop
