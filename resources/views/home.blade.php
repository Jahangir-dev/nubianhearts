@section('page-title', __tr('Home'))
@section('head-title', __tr('Home'))
@section('keywordName', __tr('Home'))
@section('keyword', __tr('Home'))
@section('description', __tr('Home'))
@section('keywordDescription', __tr('Home'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<?php 
  $time = freeTrial();
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h4 class="h5 mb-0 text-gray-200">
		<span class="text-primary"></span> <?= __tr('New members') ?>
	</h4>
</div>

@if(!__isEmpty($filterData))
	<div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-4" id="lwUserFilterContainer">
        @include('filter.find-matches')
	</div>
@else
    <!-- info message -->
   <div class="card">
				<div class="card-body">
					<div class="empty-state"><div class="empty-icon mb-4">
					    <i class="fa fa-users"></i>
					</div>
					<h5 class="empty-title">Users not found</h5>
					<p class="empty-subtitle">No new members found</p>
					  
					</div>
				</div>
			</div>
    <!-- / info message -->
@endif
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
	<h4 class="h5 mb-0 text-gray-200">
		<span class="text-primary"></span> <?= __tr('Encounters') ?>
	</h4>
</div>
<!-- user encounter main container -->
@if( $time['free_trial'] == true)
	@if(!__isEmpty($randomUserData))
		<!-- random user block -->
		<div class="lw-random-user-block">
			@if($randomUserData['isPremiumUser'])
			<span class="lw-premium-badge" title="<?= __tr('Premium User') ?>"></span>
			@endif
			<!-- user name -->
			<div class="lw-user-text">
				<a class="lw-user-text-link" href="<?= route('user.profile_view', ['username' => $randomUserData['username']]) ?>">
					<?= $randomUserData['userFullName'] ?>@if(isset($randomUserData['userAge'])),@endif
				</a>					
				<span class="lw-user-text-meta">
					@if($randomUserData['userAge'])
						<?= $randomUserData['userAge'] ?>
					@endif
					@if($randomUserData['countryName'])
						<?= $randomUserData['countryName'] ?>
					@endif
					@if($randomUserData['gender'])
						<?= $randomUserData['gender'] ?>
					@endif
				</span>
				<!-- show user online, idle or offline status -->
				@if($randomUserData['userOnlineStatus'])
					@if($randomUserData['userOnlineStatus'] == 1)
						<span class="lw-dot lw-dot-success float-right" title="Online"></span>
						@elseif($randomUserData['userOnlineStatus'] == 2)
						<span class="lw-dot lw-dot-warning float-right" title="Idle"></span>
						@elseif($randomUserData['userOnlineStatus'] == 3)
						<span class="lw-dot lw-dot-danger float-right" title="Offline"></span>
					@endif
				@endif
				<!-- /show user online, idle or offline status -->
			</div>
			<!-- /user name -->
			<div class="lw-profile-image-card-container lw-encounter-page">
			<!-- user image -->
				<img data-src="<?= $randomUserData['userImageUrl'] ?>" class="lw-lazy-img lw-profile-thumbnail">
				<!-- /user image -->
				<!-- user image -->
				<img data-src="<?= $randomUserData['userCoverUrl'] ?>" class="lw-lazy-img lw-cover-picture">
			<!-- /user image -->
			</div>
			<!-- action buttons -->
			<div class="lw-user-action-btn">
				<!-- like btn -->
				<a href data-action="<?= route('user.write.encounter.like_dislike', ['toUserUid' => $randomUserData['_uid'],'like' => 1]) ?>" data-callback="onLikeDisLikeCallback" data-method="post" class="lw-ajax-link-action lw-like-dislike-btn mr-3" title="Like" id="lwLikeBtn"><i class="far fa-thumbs-up"></i></a>
				<!-- /like btn -->

				<!-- skip btn -->
				<a href data-action="<?= route('user.write.encounter.skip_user', ['toUserUid' => $randomUserData['_uid']]) ?>" data-method="post" class="lw-ajax-link-action lw-like-dislike-btn lw-skip-btn mr-3" data-callback="onEncounterUserCallback" id="lwSkipBtn"><i class="fas fa-chevron-right"></i></a>
				<!-- /skip btn -->

				<!-- Dislike btn -->
				<a href data-action="<?= route('user.write.encounter.like_dislike', ['toUserUid' => $randomUserData['_uid'],'like' => 0]) ?>" data-callback="onLikeDisLikeCallback" data-method="post" class="lw-ajax-link-action lw-like-dislike-btn mr-3" title="Dislike"  id="lwDislikeBtn"><i class="far fa-thumbs-down"></i></a>
				<!-- /Dislike btn -->
			</div>
			<!-- /action buttons -->
		</div>
		<!-- /random user block -->
		@else
		<!-- info message -->
		<div class="alert alert-info">
			<?= __tr('No encounters found.') ?>
		</div>
		<!-- / info message -->
	@endif
@else
	<!-- info message -->
	<div class="alert alert-info">
		<?= __tr('This is a premium feature, to view encounter you need to buy premium plan first.') ?>
	</div>
	<!-- / info message -->
@endif
<!-- /user encounter main container -->

@push('appScripts')
<script>
	//disabled button on click
	$("#lwLikeBtn, #lwSkipBtn, #lwDislikeBtn").on('click', function(e) {
		$("#lwLikeBtn, #lwSkipBtn, #lwDislikeBtn").addClass('lw-disable-anchor-tag');
	});
	
	//on like Callback function
	function onLikeDisLikeCallback(response) {
		var requestData = response.data;
		//check reaction code is 1
		if (response.reaction == 1 && requestData.likeStatus == 1) {
			__Utils.viewReload();
		} else if (response.reaction == 1 && requestData.likeStatus == 2) {
			__Utils.viewReload();
		}
	}

	//on encounter(skip) user Callback function
	function onEncounterUserCallback(response) {
		//check reaction code is 1
		if (response.reaction == 1) {
			__Utils.viewReload();
		}
    }
</script>
@endpush