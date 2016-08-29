@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
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