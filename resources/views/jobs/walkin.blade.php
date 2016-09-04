@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Reserve
				</div>
				<div class="panel-body">
					
					@foreach($errors->all() as $error)
					<div class="alert alert-danger">
						{{ $error }}
					</div>
					@endforeach

					<form action="{{ url('/jobs/walk-in') }}" method="post">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" placeholder="Name" class="form-control">
						</div>

						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" name="phone" placeholder="Phone" class="form-control">
						</div>

						<div class="form-group">
							<label for="service_type">Service Type</label>
							<select name="service_type" id="service_type" class="form-control">
								<option value="self">Self</option>
								<option value="employee">Employee</option>
							</select>
						</div>

						<div class="form-group">
							<label for="kilogram">Kilogram</label>
							<select name="kilogram" id="kilogram" class="form-control">
								<option value="8">8 kg</option>
								<option value="16">16 kg</option>
							</select>
						</div>

						<div class="form-group">
							<label for="washer_mode">Washer Mode</label>
							<select name="washer_mode" id="washer_mode" class="form-control">
								<option value="clean">Klean</option>
								<option value="cleaner">Kleaner</option>
								<option value="cleanest">Kleanest</option>
							</select>
						</div>

						<div class="form-group">
							<label for="dyer_mode">Dryer Mode</label>
							<select name="dryer_mode" id="dryer_mode" class="form-control">
								<option value="19">19 mins</option>
								<option value="24">24 mins</option>
								<option value="29">29 mins</option>
							</select>
						</div>

						<div class="form-group">
							<label for="detergent">Detergent</label>
							<select name="detergent" id="detergent" class="form-control">
								<option value="ariel">Ariel</option>
								<option value="pride">Pride</option>
								<option value="tide">Tide</option>
								<option value="i_have_one">I have one</option>
							</select>
						</div>

						<div class="form-group">
							<label for="bleach">Bleach</label>
							<select name="bleach" id="bleach" class="form-control">
								<option value="colorsafe">Colorsafe</option>
								<option value="original">Original</option>
								<option value="i_have_one">I have one</option>
							</select>
						</div>

						<div class="form-group">
							<select name="fabric_conditioner" id="fabric_conditioner" class="form-control">
								<option value="downy">Downy</option>
								<option value="i_have_one">I have one</option>
							</select>
						</div>

						<div class="checkbox">
							<label for="is_press">
								<input type="checkbox" name="is_press" id="is_press" value="1"> Pressed
							</label>
						</div>

						<div class="checkbox">
							<label for="is_fold">
								<input type="checkbox" name="is_fold" id="is_fold" value="1"> Folded
							</label>
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