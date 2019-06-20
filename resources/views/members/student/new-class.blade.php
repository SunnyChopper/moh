@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<div class="gray-box">
					<h3 class="text-center mb-1">Create a Class</h3>
					<p class="text-center black">Fields with <span class="red">*</span> are required.</p>
					<form id="create_class_form" action="/members/student/class/create" method="POST">
						{{ csrf_field() }}
						<div class="form-group row">
							<div class="col-12">
								<h5 class="mb-2">Title<span class="red">*</span>:</h5>
								<input type="text" class="form-control" name="title" required>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<h5 class="mb-2">Description:</h5>
								<textarea class="form-control" rows="4" form="create_class_form" name="description"></textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<h5 class="mb-2">Category<span class="red">*</span>:</h5>
								<select class="form-control" form="create_class_form" name="category">
									<option value="Agriculture">Agriculture</option>
									<option value="Anthropology">Anthropology</option>
									<option value="Architecture and Design">Architecture and Design</option>
									<option value="Area Studies">Area Studies</option>
									<option value="Biology">Biology</option>
									<option value="Business">Business</option>
									<option value="Chemistry">Chemistry</option>
									<option value="Computer Science">Computer Science</option>
									<option value="Culinary Arts">Culinary Arts</option>
									<option value="Divinity">Divinity</option>
									<option value="Earth Sciences">Earth Sciences</option>
									<option value="Economics">Economics</option>
									<option value="Education">Education</option>
									<option value="Engineering and Technology">Engineering and Technology</option>
									<option value="Environmental Studies">Environmental Studies</option>
									<option value="Ethnic and Cultural Studies">Ethnic and Cultural Studies</option>
									<option value="Family and Consumer Science">Family and Consumer Science</option>
									<option value="Gender and Sexuality Studies">Gender and Sexuality Studies</option>
									<option value="Geography">Geography</option>
									<option value="History">History</option>
									<option value="Journalism">Journalism</option>
									<option value="Law">Law</option>
									<option value="Linguistics and Language">Linguistics and Language</option>
									<option value="Literature">Literature</option>
									<option value="Logic">Logic</option>
									<option value="Mathematics">Mathematics</option>
									<option value="Medicine">Medicine</option>
									<option value="Military Sciences">Military Sciences</option>
									<option value="Organizational Studies">Organizational Studies</option>
									<option value="Performing Arts">Performing Arts</option>
									<option value="Philosophy">Philosophy</option>
									<option value="Physics">Physics</option>
									<option value="Political Science">Political Science</option>
									<option value="Psychology">Psychology</option>
									<option value="Public Administration">Public Administration</option>
									<option value="Religion">Religion</option>
									<option value="Social Work">Social Work</option>
									<option value="Sociology">Sociology</option>
									<option value="Space Sciences">Space Sciences</option>
									<option value="Statistics">Statistics</option>
									<option value="Transportation">Transportation</option>
									<option value="Visual Arts">Visual Arts</option>
								</select>
							</div>
						</div>

						<div class="form-group row mt-32">
							<div class="col-12">
								<input type="submit" class="genric-btn primary rounded centered" style="font-size: 14px;" value="Create Class">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection