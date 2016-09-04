@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Add Machine
				</div>
				<div class="panel-body">
					@foreach($errors->all() as $error)
					<div class="alert alert-danger">
						{{ $error }}
					</div>
					@endforeach

					<form action="{{ url('/machines') }}" method="post">
						<div class="form-group">
							<label for="name">
								Name
							</label>
							<input type="text" name="name" placeholder="Name" class="form-control">
						</div>

						<div class="form-group">
							<label for="type">
								Type
							</label>
							<select name="type" id="" class="form-control">
								<option value="washer">Washer</option>
								<option value="dryer">Dryer</option>
							</select>
						</div>

						{{ csrf_field() }}

						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Machines</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Type</th>
								<th>Availability</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($machines as $machine)
							<tr>
								<td>
									{{ $machine->name }}
								</td>
								<td>
									{{ $machine->type }}
								</td>
								<td>
									{{ $machine->availability }}
								</td>
								<td>
									<a href="">Delete</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					{{ $machines->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@stop