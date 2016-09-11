@extends('layouts.app')

@section('content')
<div class="container">
	
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="clearfix">
						<span class="pull-left">Reservations</span>
						<a href="{{ url('/jobs/reservations/create') }}" class="btn btn-xs pull-right">Add</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>
									Uuid
								</th>
								<th>
									Customer
								</th>
								<th>
									Reservation time
								</th>
								<th>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($reservations as $reservation)
							<tr>
								<td>
									{{ $reservation->uuid }}
								</td>
								<td>
									{{ $reservation->name }}
								</td>
								<td>
									{{ $reservation->reserve_at->toDayDateTimeString() }}
								</td>
								<td>
									<form action="{{ url('/jobs/decline') . '/' . $reservation->id }}" method="POST">
										<button type="submit" class="btn btn-danger btn-xs">Decline</button>
	                                    {{ csrf_field() }}
	                                    {{ method_field('PUT') }}
	                                </form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="clearfix">
						<span class="pull-left">Walk-in Pending</span>
						<a href="{{ url('/jobs/walk-ins/create') }}" class="btn btn-xs pull-right">Add</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>
									Uuid
								</th>
								<th>
									Customer
								</th>
								<th>
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($pendings as $pending)
							<tr>
								<td>
									{{ $pending->uuid }}
								</td>
								<td>
									{{ $pending->name }}
								</td>
								<td>
									<form action="{{ url('/jobs/approve') . '/' . $pending->id }}" method="POST">
                                        <button type="submit" class="btn btn-xs">Approve</button>
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                    </form>
									<form action="{{ url('/jobs/decline') . '/' . $pending->id }}" method="POST">
										<button type="submit" class="btn btn-danger btn-xs">Decline</button>
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                    </form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		@foreach($machines as $machine)
		<div class="col-md-4">
			<div class="panel panel-default
			@if( $machine->washJobs()->approved()->count() > 0 || $machine->dryJobs()->approved()->count() > 0 )
			panel-warning
			@else
			panel-success
			@endif">
				<div class="panel-heading">
					{{ $machine->name }}
				</div>
				<div class="panel-body">
					@if( $machine->washJobs()->approved()->count() > 0 || $machine->dryJobs()->approved()->count() > 0 )
					<table class="table">
						<tr>
							<th>
								Uuid
							</th>
							<th>
								Customer Name
							</th>
							<th></th>
						</tr>
						@foreach($machine->washJobs()->approved()->get() as $index => $job)
						@if( $index == 0 )
						<tr class="info">
						@else
						<tr>
						@endif
							<td>
								{{ $job->uuid }}
							</td>
							<td>
								{{ $job->name }}
							</td>
							<td>
								@if( $index == 0 )
								<form action="{{ url('/jobs/done') . '/' . $job->id }}" method="POST">
									<button type="submit" class="btn btn-primary btn-xs">Done</button>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
								@endif

								<form action="{{ url('/jobs/cancel') . '/' . $job->id }}" method="POST">
									<button type="submit" class="btn btn-danger btn-xs">Cancel</button>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
							</td>
						</tr>
						@endforeach

						@foreach($machine->dryJobs()->approved()->get() as $index => $job)
						@if( $index == 0 )
						<tr class="info">
						@else
						<tr>
						@endif
							<td>
								{{ $job->uuid }}
							</td>
							<td>
								{{ $job->name }}
							</td>
							<td>
								@if( $index == 0 )
								<form action="{{ url('/jobs/done') . '/' . $job->id }}" method="POST">
									<button type="submit" class="btn btn-primary btn-xs">Done</button>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
								@endif

								<form action="{{ url('/jobs/cancel') . '/' . $job->id }}" method="POST">
									<button type="submit" class="btn btn-danger btn-xs">Cancel</button>
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                </form>
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
@stop