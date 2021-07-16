@foreach($usersData as $user)

<div class="col-md-4 col-sm-12 mb-4">
	<div class="card text-center lw-user-thumbnail-block <?= (isset($user['isPremiumUser']) and $user['isPremiumUser'] == true) ? 'lw-has-premium-badge' : '' ?>">
		<!-- show user online, idle or offline status -->
		@if($user['userOnlineStatus'])
			<div class="pt-2">
				@if($user['userOnlineStatus'] == 1)
					<span class="lw-dot lw-dot-success" title="Online"></span>
					@elseif($user['userOnlineStatus'] == 2)
					<span class="lw-dot lw-dot-warning" title="Idle"></span>
					@elseif($user['userOnlineStatus'] == 3)
					<span class="lw-dot lw-dot-danger" title="Offline"></span>
				@endif
			</div>
		@endif
		<!-- /show user online, idle or offline status -->
		<a href="<?= route('user.profile_view', ['username' => $user['username']]) ?>">
				<img data-src="<?= imageOrNoImageAvailable($user['userImageUrl']) ?>" class="lw-user-thumbnail lw-lazy-img"/>
		</a>
					
				
		<div class="card-title" style="border-top: 1px solid #898996;">
			<div class="row justify-content-md-center">
				<div class="col-md-2 col-sm-2">
					@if($user['isBlockUser'] == true)
					<!-- like button -->
					<a data-toggle="tooltip" title="This user is blocked!"  title="Like" class=" lw-like-dislike-box" id="lwLikeBtn" style="border:0; margin-top:13px;">
						<span class="lw-animated-heart lw-animated-like-heart <?= (isset($user['like']) and $user['like'] == 1) ? 'lw-is-active' : '' ?>"
							></span>
					</a>
					<!-- /like button -->
					@else
					<!-- like button -->
					<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $user['liked_user'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-dislike-box" id="lwLikeBtn" style="border:0; margin-top:13px;">
						<span class="lw-animated-heart lw-animated-like-heart <?= (isset($user['like']) and $user['like'] == 1) ? 'lw-is-active' : '' ?>"
							></span>
					</a>
					<!-- /like button -->
					@endif
				</div>
				<div class="col-md-6 col-sm-6">
					<h5>
			           	<a class="text-secondary name-changes" style="color: black !important;" href="<?= route('user.profile_view', ['username' => $user['username']]) ?>">
			                <?= $user['userFullName'] ?>
			            </a>
			            <?= $user['detailString'] ?> &nbsp;
			            @if($user['countryName'])
			                <?= $user['countryName'] ?>
			            @endif
					</h5>
					
					@if($user['last_sent'] != null)
					@if(isset($likedme) && $likedme == true)
						<span>Recieved :<?= $user['last_sent'] ?></span>
					@else
						<span>Sent :<?= $user['last_sent'] ?></span>
					@endif
					@endif
				</div>
				
				<div class="col-md-2 col-sm-2">
					@if($user['isBlockUser'] == true)
						<!-- message button -->
							<a class="mr-lg-3 mt-4 btn-link" data-toggle="tooltip" title="This user is blocked!" style="font-size: 13px; cursor: pointer;"><i class="far fa-comments fa-2x"></i>
								<br> <?= __tr('Message') ?></a>
						<!-- /message button -->
					@else
					<!-- message button -->
						<a class="mr-lg-3 mt-4 btn-link" onclick="getChatMessenger('<?= route('user.read.individual_conversation', ['specificUserId' => $user['liked_user']]) ?>')" href id="lwMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog" style="font-size: 13px;"><i class="far fa-comments fa-2x"></i>
							<br> <?= __tr('Message') ?></a>
					<!-- /message button -->
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach


@if(!__isEmpty($nextPageUrl))
<div id="lwNextPageLink" class="col-sm-12 col-md-12 col-lg-12">
	<a href="<?= $nextPageUrl ?>" class="btn btn-light btn-block lw-ajax-link-action" data-method="get" data-callback="loadNextLikedUsers"><?= __tr('Load more') ?></a>
</div>
@else
<div class="col-sm-12 col-md-12 col-lg-12 alert alert-dark text-center bg-purple text-light  border-0 mt-5"><?= __tr('Looks like you reached the end.') ?></div>
@endIf

<style type="text/css">
	.name-changes {
		border-bottom:0 !important;
		padding-bottom: 0 !important;
		margin-top : 33px;
	}
</style>