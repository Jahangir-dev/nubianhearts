@section('page-title', __tr('They like me'))
@section('head-title', __tr('They like me'))
@section('keywordName', __tr('They like me'))
@section('keyword', __tr('They like me'))
@section('description', __tr('They like me'))
@section('keywordDescription', __tr('They like me'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h5 class="h5 mb-0 text-gray-200">
	<span class="text-primary"></span>
	<?= __tr('They like me') ?></h5>
</div>

<!-- liked people container -->
<div class="container-fluid">
		@if(!__isEmpty($usersData))
		<div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4" id="lwWhoLikedUsersContainer">
			@include('user.partial-templates.my-liked-users')
		</div>
		@else
			<!-- info message -->
			<div class="alert alert-info">
				<?= __tr('There are no people liked me.') ?>
			</div>
			<!-- / info message -->
		@endif
</div>
<!-- / liked people container -->

@push('appScripts')
	<script type="text/javascript">
		function loadNextLikedUsers(response) {
			if (response.data != '') {
				$("#lwNextPageLink").remove();
				$("#lwWhoLikedUsersContainer").append(response.data);
			}
		};
	</script>
@endpush