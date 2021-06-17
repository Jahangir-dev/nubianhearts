@section('page-title', strip_tags($userData['userName']))
@section('head-title', strip_tags($userData['userName']))
@section('page-url', url()->current())

@if(isset($userData['aboutMe']))
	@section('keywordName', strip_tags($userProfileData['aboutMe']))
	@section('keyword', strip_tags($userProfileData['aboutMe']))
	@section('description', strip_tags($userProfileData['aboutMe']))
	@section('keywordDescription', strip_tags($userProfileData['aboutMe']))
@endif

@if(isset($userData['profilePicture']))
	@section('page-image', $userData['profilePicture'])
@endif
@if(isset($userData['coverPicture']))
	@section('twitter-card-image', $userData['coverPicture'])
@endif
<?php
	$stars = array('libra'=> 'libra','aries'=>'aries','cancer'=>'cancer','capricorn'=>'capricorn','gemini'=>'gemini','lion'=>'lion','pisces'=>'pisces','sagittarius'=>'sagittarius','scorpio'=>'scorpio','taurus'=>'taurus','aquarius'=>'aquarius','virgo'=>'virgo');

 ?>
 

<!-- if user block then don't show profile page content -->
@if($isBlockUser)
	<!-- info message -->
	<div class="alert alert-info">
		<?= __tr('This user is unavailable.') ?>
	</div>
	<!-- / info message -->
@elseif($blockByMeUser)
	<!-- info message -->
	<div class="alert alert-info">
		<?= __tr('You have blocked this user.') ?>
	</div>
	<!-- / info message -->
@else
    <div class="">
		<!-- User Profile and Cover photo -->
		<div class="card mb-4 lw-profile-image-card-container">
			<div class="card-body">
				@if($isOwnProfile)
				<span class="lw-profile-edit-button-container">
					<a class="lw-icon-btn" href role="button" id="lwEditProfileAndCoverPhoto">
						<i class="fa fa-pencil-alt"></i>
					</a>
					<a class="lw-icon-btn" href role="button" id="lwCloseProfileAndCoverBlock" style="display: none;">
						<i class="fa fa-times"></i>
					</a>
				</span>
				@endif
				<div class="row" id="lwProfileAndCoverStaticBlock">     
					<div class="col-lg-12">
						<div class="card mb-3 lw-profile-image-card-container">
						<img class="lw-profile-thumbnail lw-photoswipe-gallery-img lw-lazy-img" id="lwProfilePictureStaticImage" data-src="<?= imageOrNoImageAvailable($userData['profilePicture']) ?>">
							<img class="lw-cover-picture card-img-top lw-lazy-img" id="lwCoverPhotoStaticImage" data-src="<?= imageOrNoImageAvailable($userData['coverPicture']) ?>">
						</div>
					</div> 
				</div>
				@if($isOwnProfile)
					<div class="row" id="lwProfileAndCoverEditBlock" style="display: none;">
						<div class="col-lg-3">
							<input type="file" 
								name="filepond"
								class="filepond lw-file-uploader"
								id="lwFileUploader" 
								data-remove-media="true"
								data-instant-upload="true" 
								data-action="<?= route('user.upload_profile_image') ?>"
								data-label-idle="<?= __tr('Drag & Drop your picture or') ?> <span class='filepond--label-action'><?= __tr('Browse') ?></span>"
								data-image-preview-height="170"
								data-image-crop-aspect-ratio="1:1"
								data-style-panel-layout="compact circle"
								data-style-load-indicator-position="center bottom"
								data-style-progress-indicator-position="right bottom"
								data-style-button-remove-item-position="left bottom"
								data-style-button-process-item-position="right bottom"
								data-callback="afterUploadedProfilePicture">
						</div>
						<div class="col-lg-9">
							<input type="file" 
								name="filepond"
								class="filepond lw-file-uploader mt-5"
								id="lwFileUploader" 
								data-remove-media="false"
								data-instant-upload="true" 
								data-action="<?= route('user.upload_cover_image') ?>"
								data-callback="afterUploadedCoverPhoto"
								data-label-idle="<?= __tr('Drag & Drop your picture or') ?> <span class='filepond--label-action'><?= __tr('Browse') ?></span>">
						</div>
					</div>
				@endif
			</div>            
		</div>
		<!-- /User Profile and Cover photo -->
		
		<!-- mobile view premium block -->
		@if($isPremiumUser)
		<div class="mb-4 d-block d-md-none">
			<div class="card">
				<div class="card-body">
					<span class="lw-premium-badge" title="<?= __tr('Premium User') ?>"></span>
				</div> 
			</div>
		</div>
		@endif
		<!-- /mobile view premium block -->

		<!-- mobile view like dislike block -->
		@if(!$isOwnProfile)
        <div class="mb-4 d-block d-md-none">
			<!-- profile related -->
			<div class="card">
				<div class="card-header">
					<?= __tr('Like Dislike') ?>
				</div>
				<div class="card-body">
					<!-- Like and dislike buttons -->
					@if(!$isOwnProfile)
					<div class="lw-like-dislike-box">
						<!-- like button -->
						<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $userData['userUId'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action lw-like-action-btn" id="lwLikeBtn">
							<span class="lw-animated-heart lw-animated-like-heart <?= (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? 'lw-is-active' : '' ?>"></span>
						</a>
						<span data-model="userLikeStatus"><?= (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? __tr('Liked') : __tr('Like')  ?>
						</span>
						<!-- /like button -->
					</div>
					<div class="lw-like-dislike-box">
						<!-- dislike button -->
						<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $userData['userUId'],'like' => 0]) ?>" data-method="post" data-callback="onLikeCallback" title="Dislike" class="lw-ajax-link-action lw-dislike-action-btn" id="lwDislikeBtn">
							<span class="lw-animated-heart lw-animated-broken-heart <?= (isset($userLikeData['like']) and $userLikeData['like'] == 0) ? 'lw-is-active' : '' ?>"></span>
						</a>
						<span data-model="userDislikeStatus"><?= (isset($userLikeData['like']) and $userLikeData['like'] == 0) ? __tr('Disliked') : __tr('Dislike')  ?>
						</span>
						<!-- /dislike button -->
					</div>
                    @endif
				</div> 
				<!-- / Like and dislike buttons -->
			</div>
			<div class="card mt-3">
				<div class="card-header">
					<?= __tr('Send Message') ?>
				</div>
				<div class="card-body text-center">
                    <!-- message button -->
                    <a class="mr-3 btn-link btn" onclick="getChatMessenger('<?= route('user.read.individual_conversation', ['specificUserId' => $userData['userId']]) ?>')" href id="lwMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog"><i class="far fa-comments fa-3x"></i>
                        <br> <?= __tr('Message') ?></a>

                </div>
            </div>
		</div>
		@endif
			
		@if(!__isEmpty($photosData) or $isOwnProfile)
		<div class="card mb-3">
			<div class="card-header">
				@if($isOwnProfile)
					<span class="float-right">
						<a class="lw-icon-btn" href="<?= route('user.photos_setting', ['username' => getUserAuthInfo('profile.username')]) ?>" role="button">
							<i class="fas fa-cog"></i>
						</a>
					</span>
				@endif
			<h5><i class="fas fa-images text-warning"></i> <?= __tr('Photos') ?></h5>
			</div>
			
			<div class="card-body">
				<div class="row text-center text-lg-left lw-horizontal-container pl-2">
					@if(!__isEmpty($photosData))
						@foreach($photosData as $key =>  $photo)
							<img class="lw-user-photo lw-photoswipe-gallery-img lw-lazy-img" data-img-index="<?= $key ?>" data-src="<?= imageOrNoImageAvailable($photo['image_url']) ?>" >
						@endforeach
					@else
						<?= __tr('Ooops... No images found...') ?>
					@endif
				</div>
			</div>
		</div>
		@endif
    
	
		<!-- /user gift data -->

		<!-- User Basic Information -->
		<div class="card mb-3">            
			<!-- Basic information Header -->
			<div class="card-header">
				<!-- Check if its own profile -->
				@if($isOwnProfile)
					<span class="float-right">
						<a class="lw-icon-btn" href role="button" id="lwEditBasicInformation">
							<i class="fa fa-pencil-alt"></i>
						</a>
						<a class="lw-icon-btn" href role="button" id="lwCloseBasicInfoEditBlock" style="display: none;">
							<i class="fa fa-times"></i>
						</a>
					</span>
				@endif
				<!-- /Check if its own profile -->
				<h5><i class="fas fa-info-circle text-info"></i>  <?= __tr('Basic Information') ?></h5>
			</div>
			<!-- /Basic information Header -->
			<!-- Basic Information content -->
			<div class="card-body">

				<!-- Static basic information container -->
				<div id="lwStaticBasicInformation">
					<div class="form-group row">
						<!-- User Name -->
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label for="user_name"><strong><?= __tr('User Name') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userData.userName"><?= __ifIsset($userData['userName'], $userData['userName'], '-') ?></div>
						</div>
						<!-- /User Name -->
						<!-- Gender -->
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label for="select_gender"><strong><?= __tr('Gender') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="profileData.gender_text">
							<?= __ifIsset($userProfileData['gender_text'], $userProfileData['gender_text'], '-') ?>
							</div>
						</div>
						<!-- /Gender -->
						
					</div>
					<div class="form-group row">
						<!-- Birthday -->
						<div class="col-sm-6">
							<label for="birthday"><strong><?= __tr('Birthday') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="profileData.birthday">
								<?= __ifIsset($userProfileData['birthday'], $userProfileData['birthday'], '-') ?>
							</div>
						</div>
						<!-- /Birthday -->
						<!-- Looking For -->
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label for="mobile_number"><strong><?= __tr('Looking For') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="profileData.looking_for">
								@foreach($genders as $genderKey => $gender)
										@if(__ifIsset($userProfileData['looking_for']) and $genderKey == $userProfileData['looking_for'])
											<?= $gender ?>
										@endif
										 
								@endforeach
								
							</div>
						</div>
						<!-- /Looking For -->
					</div>

					<div class="form-group row">
						<!-- Star Sign -->
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label for="star_sign"><strong><?= __tr('Star Sign') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="profileData.star_sign">
								<?= __ifIsset($userProfileData['star_sign'], $userProfileData['star_sign'], '-') ?>
							</div>
						</div>
						<!-- /Star Sign -->
						<!-- Born Country -->
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label for="star_sign"><strong><?= __tr('Born Country') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="profileData.born_country">
								<?= __ifIsset($userProfileData['born_country'], $userProfileData['born_country'], '-') ?>
							</div>
						</div>
						<!-- /Born Country -->
					</div>
					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<label for="seeking"><strong><?= __tr('Seeking') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="profileData.seeking">
								<?= __ifIsset($userProfileData['seeking'], str_replace("'",'',$userProfileData['seeking']), '-') ?>
							</div>
						</div>
					</div>
				</div>
				<!-- /Static basic information container -->
				
				@if($isOwnProfile)
					<!-- User Basic Information Form -->
					<form class="lw-ajax-form lw-form" lwSubmitOnChange method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>" data-callback="getUserProfileData" style="display: none;" id="lwUserBasicInformationForm">
						<div class="form-group row">
							<input type="hidden" name="first_name" value="<?=$userData['first_name']?>">
							<input type="hidden" name="last_name" value="<?=$userData['last_name']?>">
							<!-- First Name -->
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="first_name"><?= __tr('User Name') ?></label>
								<input type="text" readonly="" value="<?= $userData['userName'] ?>" class="form-control" name="client_name"
								placeholder="<?= __tr('User Name') ?>">
							</div>
							<!-- /First Name -->
							
							<!-- Gender -->
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="select_gender"><?= __tr('Gender') ?></label>
								<select name="gender" class="form-control" id="select_gender">
									<option value="" selected disabled><?= __tr('Choose your gender') ?></option>
									@foreach($genders as $genderKey => $gender)
										<option value="<?= $genderKey ?>" <?= (__ifIsset($userProfileData['gender']) and $genderKey == $userProfileData['gender']) ? 'selected' : '' ?>><?= $gender ?></option>
									@endforeach
								</select>
							</div>

							<!-- /Gender -->
							<!-- Birthday -->
							
						</div>
						
						<div class="form-group row">
							<!-- Birthday -->
							<div class="col-sm-6">
                                <label for="birthday"><?= __tr('Birthday') ?></label>
                                <input type="date" name="birthday" value="<?= __ifIsset($userProfileData['dob'], $userProfileData['dob']) ?>" placeholder="<?= __tr('YYYY-MM-DD') ?>" class="form-control" required dateISO="true">
							</div>
							<!-- /Birthday -->
						
						@if($isOwnProfile)
							<!-- Education -->
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="looking_for"><?= __tr('Looking For') ?></label>
								<select name="looking_for" class="form-control" id="looking_for">
									<option value="" selected disabled><?= __tr('Looking For') ?></option>
									@foreach($genders as $genderKey => $gender)
										<option value="<?= $genderKey ?>" <?= (__ifIsset($userProfileData['looking_for']) and $genderKey == $userProfileData['looking_for']) ? 'selected' : '' ?>><?= $gender ?></option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="looking_for"><?= __tr('Star Sign') ?></label>
								<select id="profile-star_sign" class="form-control" name="star_sign">
									<option value="" selected disabled>Select Star Sign</option>
									@foreach($stars as $starKey => $star)
										<option value="<?= $starKey ?>" <?= (__ifIsset($userProfileData['star_sign']) and $starKey == $userProfileData['star_sign']) ? 'selected' : '' ?>><?= $star ?></option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="looking_for"><?= __tr('In which country were you born?') ?></label>
								<select name="born_country" class="form-control" id="born_country">
									<option value="" selected disabled><?= __tr('Select Country ') ?></option>
									@foreach($countries as $countKey => $country)
											<option value="<?= $country['id'] ?>" <?= (__ifIsset($userProfileData['country_id']) and $country['id']== $userProfileData['country_id']) ? 'selected' : '' ?>><?= $country['name'] ?></option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="looking_for"><?= __tr('Seeking') ?></label>
								<input type="hidden" id="seeking" name="seeking" value="">
								<select id="example-getting-started" multiple="multiple">
								    <option value="friendship">Friendship</option>
								    <option value="dating">Dating</option>
								    <option value="marriage">Marriage</option>
								    <option value="penpal">Penpal</option>
								</select>
							</div>
						</div>
						@endif
					</form>
					<!-- /User Basic Information Form -->
				@endif
			</div>
		</div>
		<!-- /User Basic Information -->
		<!-- User Basic Information -->
		<div class="card mb-3">            
			<!-- Basic information Header -->
			<div class="card-header">
				<!-- Check if its own profile -->
				@if($isOwnProfile)
					<span class="float-right">
						<a class="lw-icon-btn" href role="button" id="lwEditUserLocation">
							<i class="fa fa-pencil-alt"></i>
						</a>
						<a class="lw-icon-btn" href role="button" id="lwCloseLocationBlock" style="display: none;">
							<i class="fa fa-times"></i>
						</a>
					</span>
				@endif
				<!-- /Check if its own profile -->
				<h5><i class="fas fa-map-marker-alt text-info"></i>  <?= __tr('Location') ?></h5>
			</div>
				<!-- Basic Information content -->
				<div class="card-body">
					<!-- Static basic information container -->
					<div id="lwUserStaticLocation">
						
						
						<div class="form-group row">
						<!-- City -->
						<div class="col-sm-4 mb-3 mb-sm-0">
							<label for="city"><strong><?= __tr('City') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.city"><?= __ifIsset($userProfileData['city'],$userProfileData['city'] ,'-') ?></div>
						</div>
						<!-- /City -->
						<!-- State -->
						<div class="col-sm-4">
							<label for="last_name"><strong><?= __tr('State') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.state"><?= __ifIsset($userProfileData['state'],$userProfileData['state'],'-') ?></div>
						</div>
						<!-- /State -->
						<!-- Country -->
						<div class="col-sm-4">
							<label for="last_name"><strong><?= __tr('Country') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.country"><?= __ifIsset($userProfileData['country_name'],$userProfileData['country_name'],'-') ?></div>
						</div>
						<!-- /Country -->
					
						</div>
						
					</div>
					@if($isOwnProfile)
					<!-- User Basic Information Form -->
					<form class="lw-ajax-form lw-form" lwSubmitOnChange method="post" data-show-message="true" action="<?= route('user.write.profile_setting') ?>" data-callback="getUserProfileData" style="display: none;" id="lwUserEditableLocation">
						<div class="card-body">
							@if(getStoreSettings('allow_google_map'))
				            <div id="lwUserEditableLocation">
				                <div class="form-group">
				                    <label for="address_address"><?= __tr('Location') ?></label>
				                    <input type="text" id="address-input" name="address_address" class="form-control map-input">
				                    <input type="hidden" name="address_latitude" id="address-latitude" value="<?= $userProfileData['latitude'] ?>" />
				                    <input type="hidden" name="address_longitude" id="address-longitude" value="<?= $userProfileData['longitude'] ?>" />
				                </div>
				                <div id="address-map-container" style="width:100%;height:400px; ">
				                    <div style="width: 100%; height: 100%" id="address-map"></div>
				                </div>
				            </div>
							@else
								<!-- info message -->
								<div class="alert alert-info">
									<?= __tr('Something went wrong with Google Api Key, please contact to system administrator.') ?>
								</div>
								<!-- / info message -->
							@endif
			        	</div>
					</form>
					@endif
				</div>
		</div>

		<!-- User Specifications -->
		@if(!__isEmpty($userSpecificationData))
			@foreach($userSpecificationData as $specificationKey => $specifications)
				<div class="card mb-3">
					<!-- User Specification Header -->
					<div class="card-header">
						<!-- Check if its own profile -->
						@if($isOwnProfile)
							<span class="float-right">
								<a class="lw-icon-btn" href role="button" id="lwEdit<?= $specificationKey ?>" onclick="showHideSpecificationUser('<?= $specificationKey ?>', event)">
									<i class="fa fa-pencil-alt"></i>
								</a>
								<a class="lw-icon-btn" href role="button" id="lwClose<?= $specificationKey ?>Block" onclick="showHideSpecificationUser('<?= $specificationKey ?>', event)" style="display: none;">
									<i class="fa fa-times"></i>
								</a>
							</span>
						@endif
						<!-- /Check if its own profile -->
						<h5><?= $specifications['icon'] ?> <?= $specifications['title'] ?></h5>
					</div>
					<!-- /User Specification Header -->
					<div class="card-body">
						<!-- User Specification static container -->
						<div id="lw<?= $specificationKey ?>StaticContainer">
							@foreach(collect($specifications['items'])->chunk(2) as $specKey => $specification)
								<div class="form-group row">
									@foreach($specification as $itemKey => $item)
										<div class="col-sm-6 mb-3 mb-sm-0">
											<label><strong><?= $item['label'] ?></strong></label>
											<div class="lw-inline-edit-text" data-model="specificationData.<?= $item['name'] ?>">
												<?= $item['value'] ?>
											</div>
										</div>
									@endforeach
								</div>
							@endforeach
						</div>
						<!-- /User Specification static container -->
						@if($isOwnProfile)
							<!-- User Specification Form -->
							<form class="lw-ajax-form lw-form" method="post" lwSubmitOnChange action="<?= route('user.write.profile_setting') ?>" data-callback="getUserProfileData" id="lwUser<?= $specificationKey ?>Form" style="display: none;">
								@foreach(collect($specifications['items'])->chunk(2) as $specification)
								<div class="form-group row">
									@foreach($specification as $itemKey => $item)
										<div class="col-sm-6 mb-3 mb-sm-0">
											@if($item['input_type'] == 'select')
												<label for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
												<select name="<?= $item['name'] ?>" class="form-control">
													<option value="" selected disabled><?= __tr('Choose __label__', [
													'__label__' => $item['label']
												]) ?></option>
													@foreach($item['options'] as $optionKey => $option)
														<option value="<?= $optionKey ?>" <?= $item['selected_options'] == $optionKey ? 'selected' : '' ?>>
															<?= $option ?>
														</option>
													@endforeach
												</select>
											@elseif($item['input_type'] == 'textbox')
												<label for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
												<input type="text" id="<?= $item['name'] ?>" name="<?= $item['name'] ?>" class="form-control" value="<?= $item['selected_options'] ?>">
											@elseif($item['input_type'] == 'textarea')
												<label for="<?= $item['name'] ?>"><?= $item['label'] ?></label>
												<textarea maxlength="1600" id="<?= $item['name'] ?>" name="<?= $item['name'] ?>" class="form-control"><?= $item['selected_options'] ?></textarea>                
											@endif
										</div>
									@endforeach
								</div>
								@endforeach
							</form>
							<!-- /User Specification Form -->
						@endif
					</div>
				</div>
			@endforeach
		@endif
		
		</div>
	</div>

	<!-- user report Modal-->
	<div class="modal fade" id="lwReportUserDialog" tabindex="-1" role="dialog" aria-labelledby="userReportModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="userReportModalLabel"><?= __tr('Abuse Report to __username__', [
					'__username__' => $userData['fullName']]) ?></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<form class="lw-ajax-form lw-form" id="lwReportUserForm" method="post" data-callback="userReportCallback" action="<?= route('user.write.report_user', ['sendUserUId' => $userData['userUId']]) ?>">
					<div class="modal-body">
						<!-- reason input field -->
						<div class="form-group">
							<label for="lwUserReportReason"><?= __tr('Reason') ?></label>
							<textarea class="form-control" rows="3" id="lwUserReportReason" name="report_reason" required></textarea>
						</div>
						<!-- / reason input field -->
					</div>

					<!-- modal footer -->
					<div class="modal-footer mt-3">
						<button class="btn btn-light btn-sm" id="lwCloseUserReportDialog"><?= __tr('Cancel') ?></button>
						<button type="submit" class="btn btn-primary btn-sm lw-ajax-form-submit-action btn-user lw-btn-block-mobile"><?= __tr('Report') ?></button>
					</div>
				</form>
				<!-- modal footer -->
			</div>
		</div>
	</div>
	<!-- /user report Modal-->

	<!-- send gift Modal-->
	<div class="modal fade" id="lwSendGiftDialog" tabindex="-1" role="dialog" aria-labelledby="sendGiftModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
                    <?php $totalAvailableCredits = totalUserCredits() ?>
					<h5 class="modal-title" id="sendGiftModalLabel"><?= __tr('Send Gift') ?> <small class="text-muted"><?= __tr('(Credits Available:  __availableCredits__)', [
                        '__availableCredits__' => $totalAvailableCredits
                    ]) ?></small></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				@if(isset($giftListData) and !__isEmpty($giftListData))

				<!-- insufficient balance error message -->
				<div class="alert alert-info" id="lwGiftModalErrorText" style="display: none">
					<?= __tr('Your credit balance is too low, please') ?>
					<a href="<?= route('user.credit_wallet.read.view') ?>"><?= __tr('purchase credits') ?></a>
				</div>
				<!-- / insufficient balance error message -->

				<form class="lw-ajax-form lw-form" id="lwSendGiftForm" method="post" data-callback="sendGiftCallback" action="<?= route('user.write.send_gift', ['sendUserUId' => $userData['userUId']]) ?>">
					<div class="modal-body">
						<div class="btn-group-toggle" data-toggle="buttons">
							@foreach($giftListData as $key => $gift)
							<span class="btn lw-group-radio-option-img" id="lwSendGiftRadioBtn_<?= $gift['_uid'] ?>">
								<input type="radio" value="<?= $gift['_uid'] ?>" name="selected_gift"/>
								<span>
									<img class="lw-lazy-img" data-src="<?= imageOrNoImageAvailable($gift['gift_image_url']) ?>"/><br>
									<?= $gift['formattedPrice'] ?>
								</span>
							</span>
							@endforeach
						</div>
						
						<!-- select private / public -->
						<div class="custom-control custom-checkbox custom-control-inline mt-3">
							<input type="checkbox" class="custom-control-input" id="isPrivateCheck"  name="isPrivateGift">
							<label class="custom-control-label" for="isPrivateCheck"><?=  __tr( 'Private' )  ?></label>
						</div>
						<!-- /select private / public -->
					</div>
					<!-- modal footer -->
					<div class="modal-footer mt-3">
						<button class="btn btn-light btn-sm" id="lwCloseSendGiftDialog"><?= __tr('Cancel') ?></button>
						<button type="submit" class="btn btn-primary btn-sm lw-ajax-form-submit-action btn-user lw-btn-block-mobile"><?= __tr('Send') ?></button>
					</div>
					<!-- modal footer -->
				</form>
				@else
					<!-- info message -->
					<div class="alert alert-info">
						<?= __tr('There are no gifts') ?>
					</div>
					<!-- / info message -->
				@endif
			<div>
		<div>
	</div>
	<!-- /send gift Modal-->
</div>
</div>
</div>
	<!-- User block Confirmation text html -->
	<div id="lwBlockUserConfirmationText" style="display: none;">
		<h3><?= __tr('Are You Sure!') ?></h3>
		<strong><?= __tr('You want to block this user.') ?></strong>
	</div>
	<!-- /User block Confirmation text html -->

	<!-- Content for sidebar -->
	@push('sidebarProfilePage')
		<li class="mt-4 d-none d-md-block profile-section">
			<!-- profile related -->
			<div class="card left-profile-area ">
				<div class="card-header top-bag">
					
				</div>
				<div class="p-inner-content">
					<div class="profile-img">
						<img class="lw-profile-thumbnail profile-img-1 lw-lazy-img" data-src="<?= imageOrNoImageAvailable($userData['profilePicture']) ?>">
					@if(!$isOwnProfile)
						@if($userOnlineStatus == 1)
						<span class="lw-dot lw-dot-success float-none active-online" title="<?= __tr("Online") ?>"></span>
						@elseif($userOnlineStatus == 2)
						<span class="lw-dot lw-dot-warning float-none active-online" title="<?= __tr("Idle") ?>"></span>
						@elseif($userOnlineStatus == 3)
						<span class="lw-dot lw-dot-danger float-none active-online" title="<?= __tr("Offline") ?>"></span>
						@endif
					@endif
					</div>
					<h5 class="name"><?= $userData['fullName'] ?></h5>
	                <ul class="p-b-meta-one">
	                    <li>
	                        @if(!__isEmpty($userData['userAge'])) <span data-model="userData.userAge"><?= $userData['userAge'] ?> @endif Years Old</span>
	                    </li>
	                    <li>
	                        <span> <i class="fas fa-map-marker-alt"></i><?= $userProfileData['city'],',',$userProfileData['country_name'] ?></span>
	                    </li>
	                </ul>
	                <div class="p-b-meta-two">
                        <div class="left">
                            <div class="icon">
                                <i class="far fa-heart"></i>
                            </div> <?= $totalUserLike ?>
                        </div>
                        <div class="right">
                        	@if($isPremiumUser)
								<span class="lw-premium-badge" title="<?= __tr('Premium User') ?>"></span>
							@else
                            <a href="#" class="custom-button">
                                <i class="fab fa-cloudversify"></i> <?= __tr('Be Premium') ?></a>
                            @endif
                        </div>
                    </div>
					<!-- Like and dislike buttons -->
					@if(!$isOwnProfile)
					<div class="lw-like-dislike-box">
						<!-- like button -->
						<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $userData['userUId'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action" id="lwLikeBtn">
							<span class="lw-animated-heart lw-animated-like-heart <?= (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? 'lw-is-active' : '' ?>"
								></span>
						</a>
						<span data-model="userLikeStatus"><?= (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? __tr('Liked') : __tr('Like')  ?>
						</span>
						<!-- /like button -->
					</div>
					<div class="lw-like-dislike-box">
						<!-- dislike button -->
						<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $userData['userUId'],'like' => 0]) ?>" data-method="post" data-callback="onLikeCallback" title="Dislike" class="lw-ajax-link-action" id="lwDislikeBtn">
							<span class="lw-animated-heart lw-animated-broken-heart <?= (isset($userLikeData['like']) and $userLikeData['like'] == 0) ? 'lw-is-active' : '' ?>"
								></span>
						</a>
						<span data-model="userDislikeStatus"><?= (isset($userLikeData['like']) and $userLikeData['like'] == 0) ? __tr('Disliked') : __tr('Dislike')  ?>
						</span>
						<!-- /dislike button -->
					</div>
				</div> 
				<!-- / Like and dislike buttons -->
			</div>
			<div class="card mt-3">
				<div class="card-header">
					<?= __tr('Send Message') ?>
				</div>
				<div class="card-body text-center">
				<!-- message button -->
				<a class="mr-lg-3 btn-link" onclick="getChatMessenger('<?= route('user.read.individual_conversation', ['specificUserId' => $userData['userId']]) ?>')" href id="lwMessageChatButton" data-chat-loaded="false" data-toggle="modal" data-target="#messengerDialog"><i class="far fa-comments fa-3x"></i>
					<br> <?= __tr('Message') ?></a>

					</div>
				</div>
			@endif
		</li>
	@endpush
@endif
<!-- /if user block then don't show profile page content -->

@push('appScripts')
@if(getStoreSettings('allow_google_map'))
<script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize" async defer></script>
@endif
<script>

    $(document).ready(function() {
    	
        $('#example-getting-started').multiselect({
            includeSelectAllOption: true,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#example-getting-started option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#seeking').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#example-getting-started option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#seeking').val(selected);
    		},
        });
        
        	@if($userProfileData['seeking'] != null || $userProfileData['seeking'] != '')
        	
        	$('#example-getting-started').multiselect('select', [<?= $userProfileData['seeking']?>]);
        	@endif
        
    });
    // Get user profile data
    function getUserProfileData(response) {
        // If successfully stored data
        if (response.reaction == 1) {
            __DataRequest.get("<?= route('user.get_profile_data', ['username' => getUserAuthInfo('profile.username')]) ?>", {}, function(responseData) {
                var requestData = responseData.data;
                var specificationUpdateData = [];
                _.forEach(requestData.userSpecificationData, function(specification) {
                    _.forEach(specification['items'], function(item) {
                        specificationUpdateData[item.name] = item.value;
                    });
                });
                
                if(requestData.userProfileData.looking_for == 0)
                {
                	requestData.userProfileData.looking_for = 'Looking For';
                }

                if(requestData.userProfileData.looking_for == 1)
                {
                	requestData.userProfileData.looking_for = 'Male';
                }

                if(requestData.userProfileData.looking_for == 2)
                {
                	requestData.userProfileData.looking_for = 'Female';
                } 

                if(requestData.userProfileData.looking_for == 3)
                {
                	requestData.userProfileData.looking_for = 'Secret';
                }
                $('#example-getting-started').multiselect('select', [requestData.userProfileData.seeking]);
                if(requestData.userProfileData.seeking != null || requestData.userProfileData.seeking != ''){
                	var result = requestData.userProfileData.seeking.replace(/'/g, "");
                	requestData.userProfileData.seeking = result;

                }
                __DataRequest.updateModels('userData', requestData.userData);
                __DataRequest.updateModels('profileData', requestData.userProfileData);
                __DataRequest.updateModels('specificationData', specificationUpdateData);
                __DataRequest.updateModels('countries', requestData.countries);
            });
        }
    }

	/**************** User Like Dislike Fetch and Callback Block Start ******************/
	//add disabled anchor tag class on click
	$(".lw-like-action-btn, .lw-dislike-action-btn").on('click', function() {
		$('.lw-like-dislike-box').addClass("lw-disable-anchor-tag");
	});
	//on like Callback function
	function onLikeCallback(response) {
		var requestData = response.data;
		//check reaction code is 1 and status created or updated and like status is 1
		if (response.reaction == 1 && requestData.likeStatus == 1 && (requestData.status == "created" || requestData.status == 'updated')) {
			__DataRequest.updateModels({
				'userLikeStatus' 	: '<?= __tr('Liked') ?>', //user liked status
				'userDislikeStatus' : '<?= __tr('Dislike') ?>', //user dislike status
			});
			//add class
			$(".lw-animated-like-heart").toggleClass("lw-is-active");
			//check if updated then remove class in dislike heart
			if (requestData.status == 'updated') {
				$(".lw-animated-broken-heart").toggleClass("lw-is-active");
			}
		}
		//check reaction code is 1 and status created or updated and like status is 2
		if (response.reaction == 1 && requestData.likeStatus == 2 && (requestData.status == "created" || requestData.status == 'updated')) {
			__DataRequest.updateModels({
				'userLikeStatus' 	: '<?= __tr('Like') ?>', //user like status
				'userDislikeStatus' : '<?= __tr('Disliked') ?>', //user disliked status
			});
			//add class
			$(".lw-animated-broken-heart").toggleClass("lw-is-active");
			//check if updated then remove class in like heart
			if (requestData.status == 'updated') {
				$(".lw-animated-like-heart").toggleClass("lw-is-active");
			}
		}
		//check reaction code is 1 and status deleted and like status is 1
		if (response.reaction == 1 && requestData.likeStatus == 1 && requestData.status == "deleted") {
			__DataRequest.updateModels({
				'userLikeStatus' 	: '<?= __tr('Like') ?>', //user like status
			});
			$(".lw-animated-like-heart").toggleClass("lw-is-active");
		}
		//check reaction code is 1 and status deleted and like status is 2
		if (response.reaction == 1 && requestData.likeStatus == 2 && requestData.status == "deleted") {
			__DataRequest.updateModels({
				'userDislikeStatus' 	: '<?= __tr('Dislike') ?>', //user like status
			});
			$(".lw-animated-broken-heart").toggleClass("lw-is-active");
		}
		//remove disabled anchor tag class
		_.delay(function() {
			$('.lw-like-dislike-box').removeClass("lw-disable-anchor-tag");
		}, 1000);
	}
	/**************** User Like Dislike Fetch and Callback Block End ******************/


	//send gift callback
	function sendGiftCallback(response) {
		//check success reaction is 1
		if (response.reaction == 1) {
			var requestData = response.data;
			//form reset after success
			$("#lwSendGiftForm").trigger("reset");
			//remove active class after success on select gift radio option
			$("#lwSendGiftRadioBtn_"+requestData.giftUid).removeClass('active');
			//close dialog after success
			$('#lwSendGiftDialog').modal('hide');
			//reload view after 2 seconds on success reaction
			_.delay(function() {
				__Utils.viewReload();
			}, 1000)
		//if error type is insufficient balance then show error message
		} else if (response.data['errorType'] == 'insufficient_balance') {
			//show error div
			$("#lwGiftModalErrorText").show();
		} else {
			//hide error div
			$("#lwGiftModalErrorText").hide();
		}
	}

	//close Send Gift Dialog
	$("#lwCloseSendGiftDialog").on('click', function(e) {
		e.preventDefault();
		//form reset after success
		$("#lwSendGiftForm").trigger("reset");
		//close dialog after success
		$('#lwSendGiftDialog').modal('hide');
	});

	//user report callback
	function userReportCallback(response) {
		//check success reaction is 1
		if (response.reaction == 1) {
			var requestData = response.data;
			//form reset after success
			$("#lwReportUserForm").trigger("reset");
			//close dialog after success
			$('#lwReportUserDialog').modal('hide');
			//reload view after 2 seconds on success reaction
			_.delay(function() {
				__Utils.viewReload();
			}, 1000)
		}
	}

	//close User Report Dialog
	$("#lwCloseUserReportDialog").on('click', function(e) {
		e.preventDefault();
		//form reset after success
		$("#lwReportUserForm").trigger("reset");
		//close dialog after success
		$('#lwReportUserDialog').modal('hide');
	});

	//block user confirmation
	$("#lwBlockUserBtn").on('click', function(e) {
		var confirmText = $('#lwBlockUserConfirmationText');
		//show confirmation 
		showConfirmation(confirmText, function() {
			var requestUrl = '<?= route('user.write.block_user') ?>',
				formData = {
					'block_user_id' : '<?= $userData['userUId'] ?>',
				};					
			// post ajax request
			__DataRequest.post(requestUrl, formData, function(response) {
				if (response.reaction == 1) {
					__Utils.viewReload();
				}
			});
		});
    });
    
    // Click on edit / close button 
    $('#lwEditBasicInformation, #lwCloseBasicInfoEditBlock').click(function(e) {
        e.preventDefault();
        showHideBasicInfoContainer();
    });

    // Show / Hide basic information container
    function showHideBasicInfoContainer() {
        $('#lwUserBasicInformationForm').toggle();
        $('#lwStaticBasicInformation').toggle();
        $('#lwCloseBasicInfoEditBlock').toggle();
        $('#lwEditBasicInformation').toggle();
    }
    // Show hide specification user settings
    function showHideSpecificationUser(formId, event) {
        event.preventDefault();
        $('#lwEdit'+formId).toggle();
        $('#lw'+formId+'StaticContainer').toggle();
        $('#lwUser'+formId+'Form').toggle();
        $('#lwClose'+formId+'Block').toggle();
    }
    // Click on profile and cover container edit / close button 
    $('#lwEditProfileAndCoverPhoto, #lwCloseProfileAndCoverBlock').click(function(e) {
        e.preventDefault();
        showHideProfileAndCoverPhotoContainer();
    });
    // Hide / show profile and cover photo container
    function showHideProfileAndCoverPhotoContainer() {
        $('#lwProfileAndCoverStaticBlock').toggle();
        $('#lwProfileAndCoverEditBlock').toggle();
        $('#lwEditProfileAndCoverPhoto').toggle();
        $('#lwCloseProfileAndCoverBlock').toggle();
    }
     // After successfully upload profile picture
    function afterUploadedProfilePicture(responseData) {
        $('#lwProfilePictureStaticImage, .lw-profile-thumbnail').attr('src', responseData.data.image_url);
    }
    // After successfully upload Cover photo
    function afterUploadedCoverPhoto(responseData) {
        $('#lwCoverPhotoStaticImage').attr('src', responseData.data.image_url);
    }
</script>
<script>
// Click on edit / close button 
$('#lwEditUserLocation, #lwCloseLocationBlock').click(function(e) {
    e.preventDefault();
    showHideLocationContainer();
});
// Show hide location container
function showHideLocationContainer() {
    $('#lwUserStaticLocation').toggle();
    $('#lwUserEditableLocation').toggle();
    $('#lwEditUserLocation').toggle();
    $('#lwCloseLocationBlock').toggle();
}

function initialize() {

    $('form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
    const locationInputs = document.getElementsByClassName("map-input");

    const autocompletes = [];
    const geocoder = new google.maps.Geocoder;
    for (let i = 0; i < locationInputs.length; i++) {

        const input = locationInputs[i];
        const fieldKey = input.id.replace("-input", "");
        const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

        const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
        const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

        const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
            center: {lat: latitude, lng: longitude},
            zoom: 13
        });
        const marker = new google.maps.Marker({
            map: map,
            position: {lat: latitude, lng: longitude},
        });

        marker.setVisible(isEdit);

        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.key = fieldKey;
        autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
    }

    for (let i = 0; i < autocompletes.length; i++) {
        const input = autocompletes[i].input;
        const autocomplete = autocompletes[i].autocomplete;
        const map = autocompletes[i].map;
        const marker = autocompletes[i].marker;

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            marker.setVisible(false);
            const place = autocomplete.getPlace();

            geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    const lat = results[0].geometry.location.lat();
                    const lng = results[0].geometry.location.lng();
                    setLocationCoordinates(autocomplete.key, lat, lng, place);
                }
            });

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                input.value = "";
                return;
            }

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

        });
    }
}

function setLocationCoordinates(key, lat, lng, placeData) {
    __DataRequest.post("<?= route('user.write.location_data') ?>", {
        'latitude': lat,
        'longitude': lng,
        'placeData': placeData.address_components
    }, function(responseData) {
        showHideLocationContainer();
        var requestData = responseData.data;
        __DataRequest.updateModels('profileData', {
            city: requestData.city,
            country_name: requestData.country_name,
            state: requestData.state,
            latitude: lat,
            longitude: lng
        });
         __DataRequest.updateModels('userProfileData', {
            city: requestData.city,
            country_name: requestData.country_name,
             state: requestData.state,
            latitude: lat,
            longitude: lng
        });
        var mapSrc = "https://maps.google.com/maps/place?q="+lat+","+lng+"&output=embed";
        $('#gmap_canvas').attr('src', mapSrc)
    });
};

// $(".lw-animated-heart").on("click", function() {
//     $(this).toggleClass("lw-is-active");
// });
</script>
@endpush

