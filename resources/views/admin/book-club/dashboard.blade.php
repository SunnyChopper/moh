@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.book-club.modals.refund')

	<div class='container pt-64 pb-64'>
		<div class='row justify-content-center'>
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<h2 class="mb-4 light-font">New Book Club Members</h2>
				<div>
					{!! $new_users_chart->container() !!}
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h4 class="text-center mb-3">Quick Actions</h4>
					<a href="{{ url('/admin/book-club/' . $current_book->id . '/dashboard') }}" class="genric-btn info rounded full-width mt-2" style="font-size: 14px;">Go to Current Book Dashboard</a>
					<a href="{{ url('/admin/book-club/votes') }}" class="genric-btn primary rounded full-width mt-2" style="font-size: 14px;">View Voting Results</a>
					<a href="{{ url('/admin/book-club/questions') }}" class="genric-btn primary rounded full-width mt-2" style="font-size: 14px;">View Open Questions</a>
				</div>
			</div>
		</div>
	</div>

	<div style="background: #EAEAEA;">
		<div class="container pt-64 pb-64">
			<div class="row">
				<div class="col-12">
					<h2 class="text-center light-font">Active Members</h2>
				</div>
			</div>

			<div class="row justify-content-center mt-32">
				@if(count($members) > 0)
				<div class="col-12">
					<div style="overflow: auto;">
						<table id="members_table" class="table" style="min-width: 600px;">
							<thead>
								<tr>
									<th style="min-width: 120px;">Enroll Date</th>
									<th style="min-width: 120px;">Name</th>
									<th>Email</th>
									<th>Customer ID</th>
									<th>Subscription ID</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($members as $member)
								<tr>
									<td style="vertical-align: middle;">{{ $member->created_at->format('M jS, Y') }}</td>
									@if($member->user->first_name != "")
									<td style="vertical-align: middle;">{{ $member->user->first_name }} {{ $member->user->last_name }}</td>
									@else
									<td style="vertical-align: middle;">N/A</td>
									@endif
									<td style="vertical-align: middle;">{{ $member->user->email }}</td>
									<td style="vertical-align: middle;">{{ $member->customer_id }}</td>
									<td style="vertical-align: middle;">{{ $member->subscription_id }}</td>
									<td style="vertical-align: middle;">
										<button type="button" data-subscription="{{ $member->subscription_id }}" class="genric-btn danger rounded small m-1 refund_button" style="float: right">Refund</button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				@else
				<div class="col-lg-5 col-md-6 col-sm-8 col-12">
					<h3 class="text-center">No Members</h3>
					<p class="text-center mb-0">There are no members in the system. Go out there and sell.</p>
				</div>
				@endif
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	{!! $new_users_chart->script() !!}

	<script type='text/javascript'>
		var _token = '{{ csrf_token() }}';
		
		/* ---------------------- *\
			Button Bindings
		\* ---------------------- */

		$(".refund_button").on('click', function() {
			var subscription_id = $(this).data('subscription');
			$("#delete_subscription_id").val(subscription_id);
			$("#refund_member_modal").modal();
		});
	</script>
@endsection