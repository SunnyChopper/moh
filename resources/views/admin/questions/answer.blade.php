@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-9 col-md-10 col-sm-12 col-12">
				<div class="gray-box">
					<form id="answer_question_form" action="/admin/questions/answer/submit" method="POST">
						{{ csrf_field() }}

						<div class="form-group">
							<h5><b>Title: </b> {{ $question->title }}</h5>
						</div>

						<div class="form-group">
							<p><b>Description: </b> {{ $question->description }}</p>
						</div>

						<div class="form-group">
							<label>Answer:</label>
							<textarea class="form-control" name="answer" form="answer_question_form" rows="5"></textarea>
						</div>

						<div class="form-group">
							<input type="submit" value="Answer Question" class="genric-btn primary rounded">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection