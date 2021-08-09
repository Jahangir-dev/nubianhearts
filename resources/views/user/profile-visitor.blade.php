@section('page-title', __tr('Visitors'))
@section('head-title', __tr('Visitors'))
@section('keywordName', __tr('Visitors'))
@section('keyword', __tr('Visitors'))
@section('description', __tr('Visitors'))
@section('keywordDescription', __tr('Visitors'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<?php 
	$route = Illuminate\Support\Facades\Route::currentRouteName(); 
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h5 class="h5 mb-0 text-gray-200">
		@if($route == 'user.profile_visit_view')
		<span class="text-primary"></span> <?= __tr('My views') ?>
		@else
		<span class="text-primary"></span> <?= __tr('They viewd me') ?>
		@endif
	</h5>
</div>

<!-- profile visitors container -->
<div class="container-fluid">
	@if(!__isEmpty($usersData))
	<div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4" id="lwProfileVisitorsContainer">
		@include('user.partial-templates.my-liked-users')
	</div>
	@else
		<!-- info message -->
		<div class="alert alert-info">
			<?= __tr('There are no visitors.') ?>
		</div>
		<!-- / info message -->
	@endif
</div>
<!-- / profile visitors container -->

@push('appScripts')
	<script type="text/javascript">
		function loadNextLikedUsers(response) {
			if (response.data != '') {
				$("#lwNextPageLink").remove();
				$("#lwProfileVisitorsContainer").append(response.data);
			}
		};
	</script>
@endpush