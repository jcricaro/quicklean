@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="clearfix">
						<span class="pull-left">Tips</span>
						<a href="{{ url('/tips/create') }}" class="btn btn-xs pull-right">Add</a>
					</div>
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									Title
								</th>
								<th class="col-md-1">
									
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tips as $tip)
							<tr>
								<td>
									{{ $tip->title }}
								</td>
								<td>
									<a href="{{ url('/tips') . '/' . $tip->id . '/edit' }}" class="btn btn-default btn-xs">Edit</a>
								</td>
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