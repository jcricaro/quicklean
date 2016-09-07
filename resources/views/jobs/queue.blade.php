@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@foreach($machines as $machine)
			<div class="col-md-4">
				<div class="panel panel-default
				@if( $machine->washJobs()->approved()->count() > 0 || $machine->dryJobs()->approved()->count() > 0 )
				panel-danger
				@else
				panel-success
				@endif">
					<div class="panel-heading">
						{{ $machine->name }}
					</div>
					<div class="panel-body">
						@if( $machine->washJobs()->approved()->count() > 0 || $machine->dryJobs()->approved()->count() > 0 )
						<table class="table">
							<!-- <tr>
								<th>
									UUID
								</th>
								<th>
									Customer Name
								</th>
								<th></th>
							</tr> -->
							@foreach($machine->washJobs as $job)
							<tr>
								<td>
									{{ $job->uuid }}
								</td>
								<td>
									{{ $job->name }}
								</td>
								<td>
									<a class="btn btn-primary btn-xs" href="{{ url('/done') }}">Done</a>
									<a class="btn btn-danger btn-xs" href="{{ url('/') }}">Cancel</a>
								</td>
							</tr>
							@endforeach

							@foreach($machine->dryJobs as $job)
							<tr>
								<td>
									{{ $job->uuid }}
								</td>
								<td>
									{{ $job->name }}
								</td>
								<td>
									<a class="btn btn-primary btn-xs" href="{{ url('/done') }}">Done</a>
									<a class="btn btn-danger btn-xs" href="{{ url('/') }}">Cancel</a>
								</td>
							</tr>
							@endforeach
						</table>
						@else
						Available!
						@endif
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@stop