@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			@if(count($questions) > 0)
				<div class="col-12">
					<div style="overflow: auto;">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Username</th>
									<th>Title</th>
									<th>Deadline</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($questions as $question)
									<tr>
										<td style="vertical-align: middle;">{{ \App\Custom\UsersHelper::getUsername($question->user_id) }}</td>
										<td style="vertical-align: middle;">{{ $question->title }}</td>
										<td style="vertical-align: middle;">{{ $question->created_at->addDay()->format('h:i M jS, Y') }}</td>
										<td style="vertical-align: middle;">
											<button id="{{ $question->id }} " class="genric-btn primary rounded small">Answer</button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@else
				<div class="col-lg-7 col-md-8 col-sm-10 col-12">
					<div class="gray-box">
						<h3 class="text-center">No Open Questions</h3>
						<p class="text-center mb-0">There are currently no open direct questions right now.</p>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection