@section('page-title', __tr('I like them'))
@section('head-title', __tr('I like them'))
@section('keywordName', __tr('I like them'))
@section('keyword', __tr('I like them'))
@section('description', __tr('I like them'))
@section('keywordDescription', __tr('I like them'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h5 class="h5 mb-0 text-gray-200">
	<span class="text-primary"></i></span>
	<?= __tr('I like them') ?></h5>
</div>

<!-- liked people container -->
<div class="container-fluid">
	@if(!__isEmpty($usersData))
	<div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4" id="lwLikedUsersContainer">
		@include('user.partial-templates.my-liked-users')
	</div>
	@else
		<!-- info message -->
		
			<div class="card">
				<div class="card-body">
					<div class="empty-state"><div class="empty-icon mb-4">
					    <i class="fa fa-users"></i>
					</div>
					<h5 class="empty-title">Nothing to display</h5>
					<p class="empty-subtitle">You haven’t liked anyone yet</p>
					    <div class="empty-action">
					        <a class="btn btn-primary" href="<?= route('user.read.find_matches') ?>">Browse people</a>    </div>
					</div>
				</div>
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
				$("#lwLikedUsersContainer").append(response.data);
			}
		};
	</script>
@endpush