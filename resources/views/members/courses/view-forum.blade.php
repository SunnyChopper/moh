@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<p class="text-left">{{ $forum->description }}</p>
				<hr />
				<p>Forum by {{ \App\Custom\UserHelper::getFirstName($forum->user_id) }}</p>
				<a href="{{ url('/members/courses/' . $course->id . '/dashboard') }}" class="genric-btn info rounded small">Back to Course Dashboard</a>


				<div class="gray-box mt-64">
					<h5 class="mb-3">Post a Comment</h5>
					<form id="create_comment_form" action="/members/courses/forums/comment/create" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="forum_id" value="{{ $forum->id }}">

						<div class="form-group">
							<textarea class="form-control" rows="3" name="comment" required></textarea>
						</div>

						<div class="form-group">
							<input type="submit" class="genric-btn primary rounded small" value="Create Comment" style="font-size: 14px;">
						</div>
					</form>
				</div>

				<div class="mt-32">
					@if(count($comments) > 0)
						@foreach($comments as $comment)
						<div class="row">
							<div class="col-12">
								<h5 class="mb-1">{{ \App\Custom\UserHelper::getFirstName($comment->user_id) }}</h5>
								<p class="mb-0">{{ $comment->comment }}</p>
								<p class="mb-0"><small>{{ $comment->created_at->format('M jS, Y') }} at {{ $comment->created_at->format('h:i A') }}</small>
								<hr />
							</div>
						</div>
						@endforeach
					@else
						<h5 class="text-center">There are no comments for this forum.</h5>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection