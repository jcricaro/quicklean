@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add Tip
				</div>
				<div class="panel-body">
					@foreach($errors->all() as $error)
					<div class="alert alert-danger">
						{{ $error }}
					</div>
					@endforeach

					<form action="{{ url('/tips') }}" method="post">
						<div class="form-group">
							<label for="title">Title</label>
							<input type="text" name="title" placeholder="Title" class="form-control">
						</div>

						<div class="form-group">
							<textarea name="content" id="content" cols="80" rows="10">
								
							</textarea>

							<script>
								CKEDITOR.replace('content');
							</script>
						</div>
						
						{{ csrf_field() }}

						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('head')
<script src="//cdn.ckeditor.com/4.5.11/basic/ckeditor.js"></script>
@stop