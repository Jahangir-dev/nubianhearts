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
				<!-- /Check if its own profile -->
				<h5><i class="fas fa-info-circle text-info"></i>  <?= __tr('Basic Information') ?></h5>
			</div>
			<!-- /Basic information Header -->
			<!-- Basic Information content -->
			<div class="card-body">
				@if(!$isOwnProfile)
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
				@endif
				@if($isOwnProfile)
					<!-- User Basic Information Form -->
					<form class="lw-ajax-form lw-form"  method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>" data-callback="getUserProfileData"  id="lwUserBasicInformationForm">
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
						<div class="form-group">
							<div class="col-sm-2 mb-3 mb-sm-0 mr-0 float-right">
								<input type="submit" class="bg-purple" name="Save" value="Save">
							</div>
						</div>
						@endif
					</form>
					<!-- /User Basic Information Form -->
				@endif
			</div>
		</div>
		<!-- /User Basic Information -->
		<!-- Location Information -->
		<div class="card mb-3">            
			<!-- Basic information Header -->
			<div class="card-header">
				<h5><i class="fas fa-map-marker-alt text-info"></i>  <?= __tr('Location') ?></h5>
			</div>
				<!-- Basic Information content -->
				<div class="card-body">
					@if(!$isOwnProfile)
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
					@endif
					@if($isOwnProfile)
					<!-- User Basic Information Form -->
					<form class="lw-ajax-form lw-form" method="post" data-show-message="true" action="<?= route('user.write.location_data') ?>" data-callback="getUserProfileData" id="lwUserEditableLocation">
						<div class="card-body">
							<input type="hidden" name="location_store">
				            <div id="lwUserEditableLocation">
				                <div class="form-group row">
			            		<div class="col-sm-6 mb-3 mb-sm-0">
									<label for="looking_for"><?= __tr('Select Country') ?></label>
									<select name="country" class="form-control" id="country">
										<option value="" selected disabled><?= __tr('Select Country') ?></option>
										@foreach($countries as $countKey => $country)
												<option value="<?= $country['id'] ?>" <?= (__ifIsset($userProfileData['user_country_id']) and $country['id']== $userProfileData['user_country_id']) ? 'selected' : '' ?>><?= $country['name'] ?></option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="looking_for"><?= __tr('Select State') ?></label>
								<select name="state" class="form-control" id="state">
									<option value="" selected disabled><?= __tr('Select State') ?></option>
									@foreach($userProfileData['states'] as $state)
										<option value="<?= $state['code'] ?>" <?= (__ifIsset($userProfileData['state_code']) and $state['code']== $userProfileData['state_code']) ? 'selected' : '' ?>><?= $state['name'] ?></option>
									@endforeach
									
								</select>
							</div>
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="looking_for"><?= __tr('Select City') ?></label>
								<select name="city" class="form-control" id="citySave">
									<option value="" selected disabled><?= __tr('Select City') ?></option>
									@foreach($userProfileData['state_cities'] as $city)
										<option value="<?= $city['code'] ?>" <?= (__ifIsset($userProfileData['city_code']) and $city['code']== $userProfileData['city_code']) ? 'selected' : '' ?>><?= $city['name'] ?></option>
									@endforeach
								</select>
							</div>

			            	</div>
			            	<div class="form-group">
							<div class="col-sm-2 mb-3 mb-sm-0 mr-0 float-right">
								<input type="submit" class="bg-purple" name="Save" value="Save">
							</div>
						</div>
				            </div>
							
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
						
						<!-- /Check if its own profile -->
						<h5><?= $specifications['icon'] ?> <?= $specifications['title'] ?></h5>
					</div>
					<!-- /User Specification Header -->
					<div class="card-body">
						@if(!$isOwnProfile)
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
						@endif
						<!-- /User Specification static container -->
						@if($isOwnProfile)
							<!-- User Specification Form -->
							<form class="lw-ajax-form lw-form" method="post" data-show-message="true" action="<?= route('user.write.profile_setting') ?>" data-callback="getUserProfileData" id="lwUser<?= $specificationKey ?>Form">
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
								<div class="form-group">
							<div class="col-sm-2 mb-3 mb-sm-0 mr-0 float-right">
								<input type="submit" class="bg-purple" name="Save" value="Save">
							</div>
						</div>
							</form>
							<!-- /User Specification Form -->
						@endif
					</div>
				</div>
			@endforeach
		@endif
		
		</div>
		
		<div class="card mb-3">            
			<!-- Looking For Header -->
			<div class="card-header">
				
				<!-- /Check if its own profile -->
				<h5><i class="fas fa-eye text-info"></i>  <?= __tr('Looking For') ?></h5>
			</div>
			<div class="card-body">
					<!-- Static basic information container -->
					@if(!$isOwnProfile)
					<div id="lwUserStaticLooking">
						
						
						<div class="form-group row">
						<!-- Description -->
						<div class="col-sm-12 mb-3 mb-sm-0">
							<label for="description"><strong>Please tell us what you are looking for in your ideal partner? <i>(Max 1600 characters)</i> ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_description"><?= __ifIsset($userProfileData['looking_for_description'],$userProfileData['looking_for_description'] ,'-') ?></div>
						</div>
						<!-- /Description -->
						<!-- From age -->
						<div class="col-sm-4">
							<label for="from_age"><strong><?= __tr('From Age') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_from_age"><?= __ifIsset($userProfileData['looking_for_from_age'],$userProfileData['looking_for_from_age'],'-') ?></div>
						</div>
						<!-- /From age -->
						<!-- To Age -->
						<div class="col-sm-4">
							<label for="to_age"><strong><?= __tr('To Age') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_from_age"><?= __ifIsset($userProfileData['looking_for_from_age'],$userProfileData['looking_for_from_age'],'-') ?></div>
						</div>
						<!-- /To Age -->
						<!-- Ethnicity -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Ethnicity') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_ethnicity"><?= __ifIsset($userProfileData['looking_for_ethnicity'], str_replace("'",'',$userProfileData['looking_for_ethnicity']),'-') ?></div>
						</div>
						<!-- /Ethnicity -->
						<!-- Nationality -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Their Nationality') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.selected_country"><?= __ifIsset($userProfileData['selected_country'], str_replace("'",'',$userProfileData['selected_country']),'-') ?></div>
						</div>
						<!-- /Nationality -->
						<!-- Religion -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Their Religion') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_religion"><?= __ifIsset($userProfileData['looking_for_religion'], str_replace("'",'',$userProfileData['looking_for_religion']),'-') ?></div>
						</div>
						<!-- /Religion -->
						<!-- Lives In -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Lives In') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.selected_lives"><?= __ifIsset($userProfileData['selected_lives'], str_replace("'",'',$userProfileData['selected_lives']),'-') ?></div>
						</div>
						<!-- /Lives In -->
						<!-- /living situation -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Living situation') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_living_situation"><?= __ifIsset($userProfileData['looking_for_living_situation'], str_replace("'",'',$userProfileData['looking_for_living_situation']),'-') ?></div>
						</div>
						<!-- /living situation -->
						<!-- /kids -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Do they have kids?') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_kids"><?= __ifIsset($userProfileData['looking_for_kids'], str_replace("'",'',$userProfileData['looking_for_kids']),'-') ?></div>
						</div>
						<!-- /kids -->
						<!-- /best feature -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Their best feature?') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_best_feature"><?= __ifIsset($userProfileData['looking_for_best_feature'], str_replace("'",'',$userProfileData['looking_for_best_feature']),'-') ?></div>
						</div>
						<!-- /best feature -->
						<!-- best feature -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Born In') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.selected_borns"><?= __ifIsset($userProfileData['selected_borns'], str_replace("'",'',$userProfileData['selected_borns']),'-') ?></div>
						</div>
						<!-- /best feature -->
						<!-- Occupation -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Occupation') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_occupation"><?= __ifIsset($userProfileData['looking_for_occupation'], str_replace("'",'',$userProfileData['looking_for_occupation']),'-') ?></div>
						</div>
						<!-- /Occupation -->
						<!-- Annual Salary(USD) -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Annual Salary(USD)') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_salary"><?= __ifIsset($userProfileData['looking_for_salary'], str_replace("'",'',$userProfileData['looking_for_salary']),'-') ?></div>
						</div>
						<!-- /Annual Salary(USD) -->
						<!-- Education -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Education') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_education"><?= __ifIsset($userProfileData['looking_for_education'], str_replace("'",'',$userProfileData['looking_for_education']),'-') ?></div>
						</div>
						<!-- /Education -->
						<!-- Do they smoke? -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Do they smoke?') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_smoking"><?= __ifIsset($userProfileData['looking_for_smoking'], str_replace("'",'',$userProfileData['looking_for_smoking']),'-') ?></div>
						</div>
						<!-- /Do they smoke? -->
						<!-- Do they drink alcohol? -->
						<div class="col-sm-4">
							<label for=""><strong><?= __tr('Do they drink alcohol?') ?></strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.looking_for_alcohol"><?= __ifIsset($userProfileData['looking_for_alcohol'], str_replace("'",'',$userProfileData['looking_for_alcohol']),'-') ?></div>
						</div>
						<!-- /Do they drink alcohol? -->
						</div>
						
					</div>
					@endif
					@if($isOwnProfile)
					<!-- User Basic Information Form -->
					<form class="lw-ajax-form lw-form" method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>" data-callback="getUserProfileData" id="lwUserEditableLooking">
						<div class="card-body">
							<input type="hidden" name="first_name" value="<?= $userData['first_name']?>">
							<input type="hidden" name="last_name"  value="<?= $userData['last_name']?>">
							
							<input type="hidden" name="form_looking"  value="">
							
				            <div id="lwUserEditableLooking">
				                <div class="form-group row">
									<!-- City -->
									<div class="col-sm-12 mb-3 mb-sm-0">
										<label for="city"><strong>Please tell us what you are looking for in your ideal partner? <i>(Max 1600 characters)</i></strong></label>
										<textarea maxlength="1600" name="looking_for_description">
											<?= $userProfileData['looking_for_description'] ?>
										</textarea>
							        </div>
							    </div>
							    <div class="form-group row">
							        <div class="col-sm-3">
							        	<input type="number" class="form-control" name="looking_for_from_age" value="<?= $userProfileData['looking_for_from_age'] ?? '' ?>">
							        </div>
							        <div class="col-sm-2 text-center">
							        	<label style="color: #6f6f6f;font-size: 17px;" class="form-label">to</label>
							        </div>
							        <div class="col-sm-3">
							        	<input type="number" class="form-control" name="looking_for_to_age" value="<?= $userProfileData['looking_for_to_age'] ?? '' ?>">
							        </div>
							        <?php 
							        $ethnicities = $userSpecificationData['background']['items'][0]['options'];
							        $nations = $userSpecificationData['background']['items'][1]['options'];
							        $religions = $userSpecificationData['looks']['items'][6]['options'];
							        $lives = $userSpecificationData['lifestyle']['items'][4]['options'];
							        $childrens = $userSpecificationData['lifestyle']['items'][7]['options'];
							        $occupations = $userSpecificationData['lifestyle']['items'][2]['options'];
							        $incomes = $userSpecificationData['lifestyle']['items'][3]['options'];
							        $educations = $userSpecificationData['lifestyle']['items'][1]['options'];
							        $smokes = $userSpecificationData['lifestyle']['items'][5]['options'];
							        $drinks = $userSpecificationData['lifestyle']['items'][6]['options'];
							        $features = $userSpecificationData['looks']['items'][8]['options'];
							        ?>
							        <div class="col-sm-4">
							        	<label for="looking_for_ethnicity"><?= __tr('Ethnicity') ?></label>
										<input type="hidden" id="for_ethnicity" name="looking_for_ethnicity" value="<?= $userProfileData['looking_for_ethnicity'] ?>">
										<select id="looking_for_ethnicity" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($ethnicities as $key => $ethencity)
												<option value="<?= $key ?>"><?= $ethencity ?></option>
											@endforeach
										</select>
							        </div>
							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_nationality"><?= __tr('Their Nationallity') ?></label>
										<input type="hidden" id="for_nationality" name="looking_for_nationality" value="<?= $userProfileData['looking_for_nationality'] ?>">
										<select id="looking_for_nationality" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($nations as $key => $nation)
												<option value="<?= $key ?>"><?= $nation ?></option>
											@endforeach
										</select>
							        </div>
							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_religion"><?= __tr('Their Religion') ?></label>
										<input type="hidden" id="for_religion" name="looking_for_religion" value="<?= $userProfileData['looking_for_religion'] ?>">
										<select id="looking_for_religion" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($religions as $key => $religion)
												<option value="<?= $key ?>"><?= $religion ?></option>
											@endforeach
										</select>
							        </div>
							        <div class="col-sm-4 mt-2 mb-0 ">
							        	<label for="looking_for_lives_in"><?= __tr('Lives In') ?></label>
										<input type="hidden" id="for_lives_in" name="looking_for_lives_in" value="<?= $userProfileData['looking_for_lives_in'] ?>">
										<select id="looking_for_lives_in" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($nations as $key => $nation)
												<option value="<?= $key ?>"><?= $nation ?></option>
											@endforeach
										</select>
							        </div>
							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_living_situation"><?= __tr('Living situation') ?></label>
										<input type="hidden" id="for_living_situation" name="looking_for_living_situation" value="<?= $userProfileData['looking_for_living_situation'] ?>">
										<select id="looking_for_living_situation" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($lives as $key => $live)
												<option value="<?= $key ?>"><?= $live ?></option>
											@endforeach
										</select>
							        </div>
							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_kids"><?= __tr('Do they have kids?') ?></label>
										<input type="hidden" id="for_kids" name="looking_for_kids" value="<?= $userProfileData['looking_for_kids'] ?>">
										<select id="looking_for_kids" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($childrens as $key => $children)
												<option value="<?= $key ?>"><?= $children ?></option>
											@endforeach
										</select>
							        </div>
							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_best_feature"><?= __tr('Their best feature') ?></label>
										<input type="hidden" id="for_best_feature" name="looking_for_best_feature" value="<?= $userProfileData['looking_for_best_feature'] ?>">
										<select id="looking_for_best_feature" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($features as $key => $feature)
												<option value="<?= $key ?>"><?= $feature ?></option>
											@endforeach
										</select>
							        </div>

							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_born_in"><?= __tr('Born In') ?></label>
										<input type="hidden" id="for_born_in" name="looking_for_born_in" value="<?= $userProfileData['looking_for_born_in'] ?>">
										<select id="looking_for_born_in" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($nations as $key => $nation)
												<option value="<?= $key ?>"><?= $nation ?></option>
											@endforeach
										</select>
							        </div>

							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_occupation"><?= __tr('Occupation') ?></label>
										<input type="hidden" id="for_occupation" name="looking_for_occupation" value="<?= $userProfileData['looking_for_occupation'] ?>">
										<select id="looking_for_occupation" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($occupations as $key => $occupation)
												<option value="<?= $key ?>"><?= $occupation ?></option>
											@endforeach
										</select>
							        </div>

							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_salary"><?= __tr('Annual Salary(USD)') ?></label>
										<select id="looking_for_salary" name="looking_for_salary" class="form-control">
											@foreach($incomes as $key => $income)
												<option @if($userProfileData['looking_for_salary'] == $key) selected="selected" @endif value="<?= $key ?>"><?= $income ?></option>
											@endforeach
										</select>
							        </div>

							         <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_education"><?= __tr('Education') ?></label>
										<input type="hidden" id="for_education" name="looking_for_education" value="<?= $userProfileData['looking_for_education'] ?>">
										<select id="looking_for_education" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($educations as $key => $education)
												<option value="<?= $key ?>"><?= $education ?></option>
											@endforeach
										</select>
							        </div>
							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_smoking"><?= __tr('Do they smoke?') ?></label>
										<input type="hidden" id="for_smoking" name="looking_for_smoking" value="<?= $userProfileData['looking_for_smoking'] ?>">
										<select id="looking_for_smoking" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($smokes as $key => $smoke)
												<option value="<?= $key ?>"><?= $smoke ?></option>
											@endforeach
										</select>
							        </div>
							        <div class="col-sm-4 mt-2 mb-0">
							        	<label for="looking_for_alcohol"><?= __tr('Do they drink alcohol?') ?></label>
										<input type="hidden" id="for_alcohol" name="looking_for_alcohol" value="<?= $userProfileData['looking_for_alcohol'] ?>">
										<select id="looking_for_alcohol" class="form-control" multiple="multiple" style="position:relative !important;">
											@foreach($drinks as $key => $drink)
												<option value="<?= $key ?>"><?= $drink ?></option>
											@endforeach
										</select>
							        </div>
								</div>	
							</div>
			        	</div>
			        	<div class="form-group">
							<div class="col-sm-2 mb-3 mb-sm-0 mr-0 float-right">
								<input type="submit" class="bg-purple" name="Save" value="Save">
							</div>
						</div>
					</form>
					@endif
				</div>
		</div>

		<div class="card mb-3">            
			<!-- Looking For Header -->
			<div class="card-header">
				
				<h5><i class="fas fa-eye text-info"></i>  <?= __tr('Hobbies & Interests') ?></h5>
			</div>
			<div class="card-body">
					<!-- Static basic information container -->
					@if(!$isOwnProfile)
					<div id="lwUserStaticIntrest">
						<div class="form-group row">
						<!-- Description -->
						<div class="col-sm-4 mb-3 mb-sm-0">
							<label for="description"><strong>fun/entertainment</strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.entertainment"><?= __ifIsset($userProfileData['entertainment'],str_replace("'",'',$userProfileData['entertainment']) ,'-') ?></div>
						</div>
						<div class="col-sm-4 mb-3 mb-sm-0">
							<label for="description"><strong>sports</strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.sports"><?= __ifIsset($userProfileData['sports'],str_replace("'",'',$userProfileData['sports']) ,'-') ?></div>
						</div>
						<div class="col-sm-4 mb-3 mb-sm-0">
							<label for="description"><strong>food</strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.foods"><?= __ifIsset($userProfileData['foods'],str_replace("'",'',$userProfileData['foods']) ,'-') ?></div>
						</div>
						<div class="col-sm-4 mb-3 mb-sm-0">
							<label for="description"><strong>music</strong></label>
							<div class="lw-inline-edit-text" data-model="userProfileData.music"><?= __ifIsset($userProfileData['music'],str_replace("'",'',$userProfileData['music']) ,'-') ?></div>
						</div>
					</div>
					@endif
				</div>
				@if($isOwnProfile)
					<!-- User Basic Information Form -->
					<form class="lw-ajax-form lw-form" method="post" data-show-message="true" action="<?= route('user.write.basic_setting') ?>" data-callback="getUserProfileData"  id="lwUserEditableIntrest">
						<div class="card-body">
							<input type="hidden" name="first_name" value="<?= $userData['first_name']?>">
							<input type="hidden" name="last_name"  value="<?= $userData['last_name']?>">
							
							<input type="hidden" name="intrest"  value="">
						  <div id="lwUserEditableIntrest">
			                <div class="form-group row">
								<div class="col-sm-3 mt-2 mb-0">
							        	<label for="entertainment"><?= __tr('fun/entertainment') ?></label>
										<input type="hidden" id="for_entertainment" name="entertainment" value="<?= $userProfileData['entertainment'] ?? '' ?>">
										<select id="entertainment" class="form-control" multiple="multiple" style="position:relative !important;">
											<option value="Antiques">Antiques</option>
											<option value="Bars/Pubs/Nightclubs">Bars/Pubs/Nightclubs</option>
											<option value="Cars / Mechanics">Cars / Mechanics</option>
											<option value="Philosophy / Spirituality">Philosophy / Spirituality</option>
											<option value="Computers / Internet">Computers / Internet</option>
											<option value="Pets">Pets</option>
											<option value="Movies/Camera">Movies/Camera</option>
											<option value="Beach Parties">Beach Parties</option>
											<option value="Art / Painting">Art / Painting</option>
											<option value="Education">Education</option>
											<option value="Astrology">Astrology</option>
											<option value="Board /Card Games">Board /Card Games</option>
											<option value="Concerts / Live Music">Concerts / Live Music</option>
											<option value="Dancing">Dancing</option>
											<option value="Camping / Nature">Camping / Nature</option>
											<option value="Family">Family</option>
											<option value="Crafts">Crafts</option>
											<option value="News / Politics">News / Politics</option>
											<option value="Poetry">Poetry</option>
										</select>
							        </div>
							    <div class="col-sm-3 mt-2 mb-0">
							        	<label for="sports"><?= __tr('sports') ?></label>
										<input type="hidden" id="for_sports" name="sports" value="<?= $userProfileData['sports'] ?? '' ?>">
										<select id="sports" class="form-control" multiple="multiple" style="position:relative !important;">
												<option value="aerobics">Aerobics</option>
												<option value="Auto Racing">Auto Racing</option>
												<option value="Extreme Sports">Extreme Sports</option>
												<option value="hiking">Hiking</option>
												<option value="diving">Diving</option>
												<option value="biking">Biking</option>
												<option value="Motor Sports">Motor Sports</option>
												<option value="jet">Jet / Water Skiing</option>
												<option value="Hang Gliding / Paragliding">Hang Gliding / Paragliding</option>
												<option value="archery">Archery</option>
												<option value="bodybuilding">Bodybuilding</option>
												<option value="bowling">Bowling</option>
												<option value="Figure Skating">Figure Skating</option>
												<option value="boxing">Boxing</option>
												<option value="yoga">Yoga / Pilates</option>
												<option value="Horse Riding">Horse Riding</option>
												<option value="Skating / Ice Hockey">Skating / Ice Hockey</option>
										</select>
								</div>
								<div class="col-sm-3 mt-2 mb-0">
							        	<label for="food"><?= __tr('food') ?></label>
										<input type="hidden" id="for_food" name="food" value="<?= $userProfileData['food'] ?? '' ?>">
										<select id="food" class="form-control" multiple="multiple" style="position:relative !important;">
												<option value="american">American</option>
												<option value="vegetarian" >Vegetarian / Organic</option>
												<option value="california">California-Fusion</option>
												<option value="german" >German</option>
												<option value="vegan">Vegan</option>
												<option value="mexican">Mexican</option>
												<option value="Eastern European">Eastern European</option>
												<option value="vietnamese">Vietnamese</option>
												<option value="chinese">Chinese / Dim Sum</option>
												<option value="greek">Greek</option>
												<option value="cajun">Cajun / Southern</option>
												<option value="japanese">Japanese / Sushi</option>
												<option value="Fast Food / Pizza">Fast Food / Pizza</option>
												<option value="italian">Italian</option>
												<option value="seafood">Seafood</option>
												<option value="barbecue">Barbecue</option>
												<option value="Middle Eastern">Middle Eastern</option>
												<option value="South American">South American</option>
												<option value="Jewish / Kosher">Jewish / Kosher</option>
										</select>
								</div>
								<div class="col-sm-3 mt-2 mb-0">
							        	<label for="music"><?= __tr('music') ?></label>
										<input type="hidden" id="for_music" name="music" value="<?= $userProfileData['music'] ?? '' ?>">
										<select id="music" class="form-control" multiple="multiple" style="position:relative !important;">
											<option value="alternative">Alternative</option>
											<option value="soft_rock" >Soft Rock</option>
											<option value="rap" >Rap</option>
											<option value="dance" >Dance / Techno</option>
											<option value="world" >World</option>
											<option value="rnb">RnB / Hip Hop</option>
											<option value="new_age">New Age</option>
											<option value="folk">Country / Folk</option>
											<option value="religious">Religious</option>
											<option value="pop">Pop</option>
											<option value="classical">Classical / Opera</option>
											<option value="rock">Rock</option>
											<option value="jazz">Jazz / Blues</option>
										</select>
								</div>
						    </div>
					
						<div class="form-group">
							<div class="col-sm-2 mb-3 mr-0 float-right">
								<input type="submit" class="bg-purple" name="Save" value="Save">
							</div>
						</div>
						</div>
					</div>	
					</form>
				@endif
			</div>
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
                        	@if(!$isOwnProfile)
							<div class="lw-like-dislike-box" style="border-left:0;padding-bottom: 0;    margin-top: 9px;margin-left: -34px;display: flex;">
								<!-- like button -->
								<a href data-action="<?= route('user.write.like_dislike', ['toUserUid' => $userData['userUId'],'like' => 1]) ?>" data-method="post" data-callback="onLikeCallback" title="Like" class="lw-ajax-link-action" id="lwLikeBtn" style="display: flex;">
									<span class="lw-animated-heart lw-animated-like-heart <?= (isset($userLikeData['like']) and $userLikeData['like'] == 1) ? 'lw-is-active' : '' ?>" style="display: inline-block; margin-top: -34px;"
										></span>
										<span><?= $totalUserLike ?></span>
								</a>
								<!-- /like button -->
							</div>
					@else

                            <div class="icon">
                                <i class="far fa-heart"></i>
                            </div> <span class="ml-3"><?= $totalUserLike ?></span>
                    @endif
                        </div>
                        <div class="right">
                        	@if($isPremiumUser)
								<span class="lw-premium-badge" title="<?= __tr('Premium User') ?>"></span>
							@else
                            <a href="#" class="custom-button">
                                <i class="fab fa-cloudversify"></i> <?= __tr('Buy Membership') ?></a>
                            @endif
                        </div>
                    </div>
					<!-- Like and dislike buttons -->
					@if(!$isOwnProfile)
					
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
            numberDisplayed: 1,
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

        $('#looking_for_ethnicity').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_ethnicity option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_ethnicity').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_ethnicity option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_ethnicity').val(selected);
    		},
        });
        
        $('#looking_for_nationality').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_nationality option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_nationality').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_nationality option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_nationality').val(selected);
    		},
        });

        $('#looking_for_religion').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_religion option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_religion').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_religion option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_religion').val(selected);
    		},
        });

        $('#looking_for_lives_in').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_lives_in option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_lives_in').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_lives_in option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_lives_in').val(selected);
    		},
        });

        $('#looking_for_living_situation').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_living_situation option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_living_situation').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_living_situation option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_living_situation').val(selected);
    		},
        });

        $('#looking_for_kids').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_kids option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_kids').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_kids option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_kids').val(selected);
    		},
        }); 

        $('#looking_for_best_feature').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_best_feature option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_best_feature').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_best_feature option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_best_feature').val(selected);
    		},
        });

        $('#looking_for_born_in').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_born_in option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_born_in').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_born_in option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_born_in').val(selected);
    		},
        });

        $('#looking_for_occupation').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_occupation option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_occupation').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_occupation option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_occupation').val(selected);
    		},
        });

        $('#looking_for_education').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_education option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_education').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_education option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_education').val(selected);
    		},
        });

        $('#looking_for_smoking').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_smoking option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_smoking').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_smoking option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_smoking').val(selected);
    		},
        });

        $('#looking_for_alcohol').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#looking_for_alcohol option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_alcohol').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#looking_for_alcohol option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_alcohol').val(selected);
    		},
        });

        $('#entertainment').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#entertainment option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_entertainment').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#entertainment option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_entertainment').val(selected);
    		},
        }); 

        $('#sports').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#sports option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_sports').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#sports option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_sports').val(selected);
    		},
        });

        $('#food').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#food option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_food').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#food option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_food').val(selected);
    		},
        });

        $('#music').multiselect({
            includeSelectAllOption: true,
            numberDisplayed: 1,
            selectAllValue: 'multiselect-all',
            onSelectAll: function(element, checked) {
		    	var selected = [];
			    $('#music option:selected').each(function(index, brand) {
			      selected.push(["'"+$(this).val()+"'"]);
			    });
			    $('#for_music').val(selected);
  			},
            onChange: function(element, checked) {
		        var brands = $('#music option:selected');
		        var selected = [];
		        $(brands).each(function(index, brand){
		            selected.push(["'"+$(this).val()+"'"]);
		        });
    			$('#for_music').val(selected);
    		},
        });
    	
    	@if($userProfileData['music'] != null || $userProfileData['music'] != '')
    	
    	$('#music').multiselect('select', [<?= $userProfileData['music']?>]);
    	@endif

    	@if($userProfileData['foods'] != null || $userProfileData['foods'] != '')
    	
    	$('#food').multiselect('select', [<?= $userProfileData['foods']?>]);
    	@endif

        @if($userProfileData['sports'] != null || $userProfileData['sports'] != '')
    	
    	$('#sports').multiselect('select', [<?= $userProfileData['sports']?>]);
    	@endif

    	@if($userProfileData['entertainment'] != null || $userProfileData['entertainment'] != '')
    	
    	$('#entertainment').multiselect('select', [<?= $userProfileData['entertainment']?>]);
    	@endif

    	@if($userProfileData['seeking'] != null || $userProfileData['seeking'] != '')
    	
    	$('#example-getting-started').multiselect('select', [<?= $userProfileData['seeking']?>]);
    	@endif

    	@if($userProfileData['looking_for_religion'] != null || $userProfileData['looking_for_religion'] != '')
    	
    	$('#looking_for_religion').multiselect('select', [<?= $userProfileData['looking_for_religion']?>]);
    	@endif

    	@if($userProfileData['looking_for_ethnicity'] != null || $userProfileData['looking_for_ethnicity'] != '')
    	
    	$('#looking_for_ethnicity').multiselect('select', [<?= $userProfileData['looking_for_ethnicity']?>]);
    	@endif

    	@if($userProfileData['looking_for_nationality'] != null || $userProfileData['looking_for_nationality'] != '')
    	
    	$('#looking_for_nationality').multiselect('select', [<?= $userProfileData['looking_for_nationality']?>]);
    	@endif

    	@if($userProfileData['looking_for_lives_in'] != null || $userProfileData['looking_for_lives_in'] != '')
    	
    	$('#looking_for_lives_in').multiselect('select', [<?= $userProfileData['looking_for_lives_in']?>]);
    	@endif

    	@if($userProfileData['looking_for_living_situation'] != null || $userProfileData['looking_for_living_situation'] != '')
    	
    	$('#looking_for_living_situation').multiselect('select', [<?= $userProfileData['looking_for_living_situation']?>]);
    	@endif

    	@if($userProfileData['looking_for_kids'] != null || $userProfileData['looking_for_kids'] != '')
    	
    	$('#looking_for_kids').multiselect('select', [<?= $userProfileData['looking_for_kids']?>]);
    	@endif

    	@if($userProfileData['looking_for_best_feature'] != null || $userProfileData['looking_for_best_feature'] != '')
    	
    	$('#looking_for_best_feature').multiselect('select', [<?= $userProfileData['looking_for_best_feature']?>]);
    	@endif

    	@if($userProfileData['looking_for_born_in'] != null || $userProfileData['looking_for_born_in'] != '')
    	
    	$('#looking_for_born_in').multiselect('select', [<?= $userProfileData['looking_for_born_in']?>]);
    	@endif

    	@if($userProfileData['looking_for_occupation'] != null || $userProfileData['looking_for_occupation'] != '')
    	
    	$('#looking_for_occupation').multiselect('select', [<?= $userProfileData['looking_for_occupation']?>]);
    	@endif

    	@if($userProfileData['looking_for_education'] != null || $userProfileData['looking_for_education'] != '')
    	
    	$('#looking_for_education').multiselect('select', [<?= $userProfileData['looking_for_education']?>]);
    	@endif

    	@if($userProfileData['looking_for_smoking'] != null || $userProfileData['looking_for_smoking'] != '')
    	
    	$('#looking_for_smoking').multiselect('select', [<?= $userProfileData['looking_for_smoking']?>]);
    	@endif

    	@if($userProfileData['looking_for_alcohol'] != null || $userProfileData['looking_for_alcohol'] != '')
    	
    	$('#looking_for_alcohol').multiselect('select', [<?= $userProfileData['looking_for_alcohol']?>]);
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

$('#lwEditUserLooking, #lwCloseLookingBlock').click(function(e) {
    e.preventDefault();
    showHideLookingContainer();
});

function showHideLookingContainer() {
    $('#lwUserStaticLooking').toggle();
    $('#lwUserEditableLooking').toggle();
    $('#lwEditUserLooking').toggle();
    $('#lwCloseLookingBlock').toggle();
}

$('#lwEditUserIntrest, #lwCloseIntrestBlock').click(function(e) {
    e.preventDefault();
    showHideIntrestContainer();
});

function showHideIntrestContainer() {
    $('#lwUserStaticIntrest').toggle();
    $('#lwUserEditableIntrest').toggle();
    $('#lwEditUserIntrest').toggle();
    $('#lwCloseIntrestBlock').toggle();
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

$('#country').change(getStates);
	function getStates()
	{
		var country = $('#country').find(":selected").text();
		var country_id = $('#country').find(":selected").val();
		__DataRequest.post("<?= route('user.write.location_data') ?>", {
	        'get_state': country,
	        '_state': '',
	        'country_id':country_id,
	        'latitude':'',
	        'longitude':'',
	        '_city':''
	    }, function(responseData) {
	    	var items = responseData.data.states;
	    	if(items === undefined)
			{
				_.defer(function() {
	        		checkProfileStatus();
	        	});
			} else {
		    	$('#state').empty();
		    	$('#citySave').empty();
		    	$.each(items, function (i, item) {
				    $('#state').append($('<option>', { 
				        value: item.code,
				        text : item.name 
				    }));
				});
	    	}
		});
	} 

	$('#state').change(getCities);
	function getCities() {
		var state = $('#state').find(":selected").val();
		var country = $('#country').find(":selected").text();
		var country_id = $('#country').find(":selected").val();
		__DataRequest.post("<?= route('user.write.location_data') ?>", {
	        'get_cities': state,
	        '_state': state,
	        'get_country': country,
	        '_country': country,
	        'country_id' : country_id,
	        'latitude':'',
	        'longitude':'',
	        '_city':''
	    }, function(responseData) {
	    	var items = responseData.data.cities;
	    	console.log(items);
	    	if(items === undefined)
			{
				_.defer(function() {
	        		checkProfileStatus();
	        	});
			} else {
				 __DataRequest.updateModels('userProfileData', {
		            country: $('#country').find(":selected").text(),
		            state: $('#state').find(":selected").text(),
		            city: ''   
		        });
		    	$('#citySave').empty();
		    	$.each(items, function (i, item) {
				    $('#citySave').append($('<option>', { 
				        value: item.code,
				        text : item.name 
				    }));
				});
		    }
				
			});
	}
	

// $(".lw-animated-heart").on("click", function() {
//     $(this).toggleClass("lw-is-active");
// });
</script>
@endpush

