@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Update Job
				</div>
				<div class="panel-body">

					@foreach($errors->all() as $error)
					<div class="alert alert-danger">
						{{ $error }}
					</div>
					@endforeach

					<form action="{{ url('/jobs') . '/' . $job->id }}" method="post">
						{{ method_field('PUT') }}

						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" placeholder="Name" class="form-control" value="{{ $job->name }}">
						</div>

						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" name="phone" placeholder="Phone" class="form-control" value="{{ $job->phone }}">
						</div>

						<div class="form-group">
							<label for="service_type">Service Type</label>
							<select name="service_type" id="service_type" class="form-control">
								<option value="self" {{ $job->service_type == 'Self' ? 'selected="selected"' : '' }}>Self</option>
								<option value="employee" {{ $job->service_type == 'Employee' ? 'selected="selected"' : '' }}>Employee</option>
							</select>
						</div>

						<div class="form-group">
							<label for="kilogram">Kilogram</label>
							<select name="kilogram" id="kilogram" class="form-control">
								<option value="8" {{ $job->kilogram == '8 kg' ? 'selected="selected"' : '' }}>8 kg</option>
								<option value="16" {{ $job->kilogram == '16 kg' ? 'selected="selected"' : '' }}>16 kg</option>
							</select>
						</div>

						<div class="form-group">
							<label for="washer_mode">Washer Mode</label>
							<select name="washer_mode" id="washer_mode" class="form-control">
								<option value="clean" {{ $job->washer_mode == 'Klean' ? 'selected="selected"' : '' }}>Klean</option>
								<option value="cleaner" {{ $job->washer_mode == 'Kleaner' ? 'selected="selected"' : '' }}>Kleaner</option>
								<option value="cleanest" {{ $job->washer_mode == 'Kleanest' ? 'selected="selected"' : '' }}>Kleanest</option>
							</select>
						</div>

						<div class="form-group">
							<label for="dyer_mode">Dryer Mode</label>
							<select name="dryer_mode" id="dryer_mode" class="form-control">
								<option value="19" {{ $job->dryer_mode == '19 mins' ? 'selected="selected"' : '' }}>19 mins</option>
								<option value="24" {{ $job->dryer_mode == '24 mins' ? 'selected="selected"' : '' }}>24 mins</option>
								<option value="29" {{ $job->dryer_mode == '29 mins' ? 'selected="selected"' : '' }}>29 mins</option>
							</select>
						</div>

						<div class="form-group">
							<label for="detergent">Detergent</label>
							<select name="detergent" id="detergent" class="form-control">
								<option value="ariel" {{ $job->detergent == 'Ariel' ? 'selected="selected"' : '' }}>Ariel</option>
								<option value="pride" {{ $job->detergent == 'Pride' ? 'selected="selected"' : '' }}>Pride</option>
								<option value="tide" {{ $job->detergent == 'Tide' ? 'selected="selected"' : '' }}>Tide</option>
								<option value="i_have_one" {{ $job->detergent == 'I have one' ? 'selected="selected"' : '' }}>I have one</option>
							</select>
						</div>

						<div class="form-group">
							<label for="bleach">Bleach</label>
							<select name="bleach" id="bleach" class="form-control">
								<option value="colorsafe" {{ $job->bleach == 'Colorsafe' ? 'selected="selected"' : '' }}>Colorsafe</option>
								<option value="original" {{ $job->bleach == 'Original' ? 'selected="selected"' : '' }}>Original</option>
								<option value="i_have_one" {{ $job->bleach == 'I have one' ? 'selected="selected"' : '' }}>I have one</option>
							</select>
						</div>

						<div class="form-group">
							<select name="fabric_conditioner" id="fabric_conditioner" class="form-control">
								<option value="downy" {{ $job->fabric_conditioner == 'Downy' ? 'selected="selected"' : '' }}>Downy</option>
								<option value="i_have_one" {{ $job->fabric_conditioner == 'I have one' ? 'selected="selected"' : '' }}>I have one</option>
							</select>
						</div>

						<div class="checkbox">
							<label for="is_press">
								<input type="checkbox" name="is_press" id="is_press" value="1" {{ $job->is_press ? 'checked' : '' }}> Pressed
							</label>
						</div>

						<div class="checkbox">
							<label for="is_fold">
								<input type="checkbox" name="is_fold" id="is_fold" value="1" {{ $job->is_fold ? 'checked' : '' }}> Folded
							</label>
						</div>

						{{ csrf_field() }}

						<button type="submit" class="btn btn-default">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop