@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Tips
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>
									Title
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach($tips as $tip)
							<tr>
								<td>
									{{ $tip->title }}
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