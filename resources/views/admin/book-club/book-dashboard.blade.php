@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.book-club.modals.update-notes')
	@include('admin.book-club.modals.create-link')

	<div class='container pt-64 pb-64'>
		<div class='row justify-content-center'>
			<div class="col-lg-8 col-md-8 col-sm-12 col-12">
				<div class="row" style="display: flex;">
					<div class="col-lg-3 col-md-3 col-sm-12 col-12" style="margin: auto;">
						<img src="{{ $book->cover_url }}" class="image-height-256">
					</div>

					<div class="col-lg-9 col-md-9 col-sm-12 col-12" style="margin: auto;">
						<h1 class="light-font mb-2 mt-32-mobile">{{ $book->title }}</h1>
						<p class="black" style="font-size: 14px; line-height: 2em;">{{ $book->description }}</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-32-mobile">
				<div class="gray-box">
					<h4 class="text-center mb-3">Quick Actions</h4>
					<button type="button" data-id="{{ $book->id }}" class="genric-btn info rounded full-width update_notes_button mt-2" style="font-size: 15px;">Update Book Notes</button>
					<button type="button" class="genric-btn info rounded full-width new_links_button mt-2" style="font-size: 15px;">Create New External Link</button>
					<button type="button" class="genric-btn info rounded full-width new_downloadable_button mt-2" style="font-size: 15px;">Create New Downloadable</button>
					<button type="button" class="genric-btn info rounded full-width new_downloadable_button mt-2" style="font-size: 15px;">View Book Forums</button>
				</div>
			</div>
		</div>
	</div>

	<div style="background: #EAEAEA;">
		<div class="container pt-64 pb-64">
			<div class="row">
				<div class="col-12">
					<h2 class="text-center light-font">Book Notes</h2>
				</div>
			</div>

			@if($notes != null)
			@if($notes->html != "")
			<div class="row justify-content-center mt-32">
				<div class="col-12">
				{!! $notes->html !!}
				</div>
			</div>
			@else
			<h3 class="text-center mt-64 mb-2 ultra-light-font">No Notes Found</h3>
			<p class="text-center light-font">Please create a new instance of notes for this book from the 'Quick Actions' menu.</p>
			@endif
			@else
			<h3 class="text-center mt-64 mb-2 ultra-light-font">No Notes Found</h3>
			<p class="text-center light-font">Please create a new instance of notes for this book from the 'Quick Actions' menu.</p>
			@endif
		</div>
	</div>
@endsection

@section('page_js')
	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xq9hzw57g3zkmakqchurmgo9hnprenmg1yopn8cirghphy2x'></script>
	<script type='text/javascript'>
		var _token = '{{ csrf_token() }}';

		tinymce.init({
			selector: '#book_notes',
			plugins: "code",
			height : '400px'
		});

		$(".new_links_button").on('click', function() {
			$("#create_link_modal").modal();
		});

		$(".create_link").on('click', function() {
			if ($("#create_link_title").val() != "" && $("#create_link_url").val() != "") {
				$("#create_link_error").hide();
				$.ajax({
					url : '/api/book-club/links/create',
					type : 'POST',
					data : {
						'_token' : _token,
						'book_id' : $("#create_link_book_id").val(),
						'title' : $("#create_link_title").val(),
						'url' : $("#create_link_url").val()
					},
					success : function(data) {
						if ('success' in data) {
							$("#create_link_modal").modal('hide');
						} else {
							$("#create_link_error").html('Error while creating link...');
							$("#create_link_error").show();
						}
					}
				});
			} else {
				$("#create_link_error").html('Please fill out all fields.');
				$("#create_link_error").show();
			}
		});

		$(".update_notes_button").on('click', function() {
			var book_id = $(this).data('id');
			$.ajax({
				url : '/api/book-club/book/notes',
				type : 'GET',
				data : {
					'book_id' : book_id
				},
				success : function(data) {
					tinymce.get('book_notes').setContent(data);
					$("#update_notes_book_id").val(book_id);
					$("#update_notes_modal").modal();
				}
			})
		});

		$(".update_notes").on('click', function() {
			var html = tinymce.get('book_notes').getContent();
			$.ajax({
				url : '/api/book-club/book/notes/update',
				type : 'POST',
				data : {
					'_token' : _token,
					'book_id' : $("#update_notes_book_id").val(),
					'html' : html
				},
				success : function(data) {
					if ('success' in data) {
						$("#update_notes_modal").modal('hide');
					}
				}
			});
		});

		$(document).on('focusin', function(e) {
		  if ($(e.target).closest(".mce-window").length) {
		    e.stopImmediatePropagation();
		  }
		});
	</script>
@endsection