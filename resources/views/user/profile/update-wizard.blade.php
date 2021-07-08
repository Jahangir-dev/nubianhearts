@section('page-title', __tr('Update Profile'))
@section('head-title', __tr('Update Profile'))
@section('keywordName', __tr('Update Profile'))
@section('keyword', __tr('Update Profile'))
@section('description', __tr('Update Profile'))
@section('keywordDescription', __tr('Update Profile'))
@section('page-image', getStoreSettings('logo_image_url'))
@section('twitter-card-image', getStoreSettings('logo_image_url'))
@section('page-url', url()->current())

<!-- include header -->
@include('includes.header')
<!-- /include header -->
<style>
    .lw-login-register-page .lw-page-bg {
        background-image: url('<?= __yesset("imgs/home/*.jpg", false, [
            'random' => true
        ]) ?>');
    }
</style>
<body class="bg-gradient-primary lw-login-register-page">
     <div class="lw-page-bg"></div>
    <div class="container">
         <!-- SmartWizard html -->

        <div class="card mt-5">
            <div class="card-body text-center">
                <img class="lw-logo-img" src="<?= getStoreSettings('logo_image_url') ?>" alt="<?= getStoreSettings('name') ?>">
                <a class="float-right" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i><strong><?= __tr('Logout') ?></strong>
                </a>
                <hr>
                <h5>
                	<?= __tr('Please complete your profile') ?>
            	</h5>
            </div>
        </div>
		<div id="smartwizard" class="lw-update-wizard">
		    <ul class="justify-content-center d-none d-md-flex">
		        <li>
		        	<a class="h5" href="#step-1"><i class="fas fa-images"></i><br><?= __tr('Profile Pictures') ?></a>
			    </li>
		        <li>
		        	<a class="h5" href="#step-2"><i class="fas fa-map-marker-alt"></i><br><?= __tr('Choose Location') ?>
			        </a>
			    </li>
			    <li>
                    <a class="h5" href="#step-3"><i class="fas fa-check"></i><br><?= __tr('Finished') ?>
			        </a>
			    </li>
		    </ul>

		    <div>
		        <div id="step-1" class="">
		            <div class="row">
		            	<div class="col-lg-12">
			            	<div class="pb-3">
			            		<!-- User Basic Information Form -->
								<form class="lw-ajax-form lw-form" lwSubmitOnChange method="post" data-show-message="true" action="<?= route('user.write.update_profile_wizard') ?>" data-callback="checkProfileStatus">

									<div class="form-row">
					            		<!-- Birthday -->
										<div class="col-lg-6">
			                                <label for="birthday"><?= __tr('Birthday') ?></label>
			                                <input type="text" name="birthday" value="<?= __ifIsset($profileInfo['birthday'], $profileInfo['birthday']) ?>" placeholder="<?= __tr('YYYY-MM-DD') ?>" class="form-control" required dateISO="true">
										</div>
										<!-- /Birthday -->

										<div class="col-lg-6">
											<label for="select_gender"><?= __tr('Gender') ?></label>
											<select name="gender" class="form-control" id="select_gender">
												<option value="" selected disabled><?= __tr('Choose your gender') ?></option>
												@foreach($genders as $genderKey => $gender)
													<option value="<?= $genderKey ?>" <?= (__ifIsset($profileInfo['gender']) and $genderKey == $profileInfo['gender']) ? 'selected' : '' ?>><?= $gender ?></option>
												@endforeach
											</select>
										</div>
									</div>
								</form>
			            	</div>
			            </div>
			            <div class="col-lg-12">
			            	<hr class="">
			            	<div class="pt-3">
			            		<div class="row" id="lwProfileAndCoverEditBlock">
				                    <div class="col-lg-4 mt-4">
				                        <input type="file" 
				                            name="filepond"
				                            class="filepond lw-file-uploader"
				                            id="lwFileUploader" 
				                            data-remove-media="false"
				                            data-allowed-media='<?= getMediaRestriction('profile') ?>'
				                            data-callback="checkProfileStatus"
				                            data-default-image-url="<?= $profileInfo['profile_picture_url'] ?>"
				                            data-instant-upload="true" 
				                            data-action="<?= route('user.upload_profile_image') ?>"
				                            data-label-idle="Drag & Drop your picture or <span class='filepond--label-action'>Browse</span>"
				                            data-image-preview-height="170"
				                            data-image-crop-aspect-ratio="1:1"
				                            data-style-panel-layout="compact circle"
				                            data-style-load-indicator-position="center bottom"
				                            data-style-progress-indicator-position="right bottom"
				                            data-style-button-remove-item-position="left bottom"
				                            data-style-button-process-item-position="right bottom"s>
				                    </div>
				                    <div class="col-lg-8">
				                        <input type="file" 
				                            name="filepond"
				                            class="filepond lw-file-uploader"
				                            id="lwFileUploader" 
				                            data-allowed-media='<?= getMediaRestriction('profile') ?>'
				                            data-default-image-url="<?= $profileInfo['cover_picture_url'] ?>"
				                            data-remove-media="false"
				                            data-instant-upload="true" 
				                            data-action="<?= route('user.upload_cover_image') ?>"
				                            data-callback="checkProfileStatus"
				                            data-label-idle="Drag & Drop your picture or <span class='filepond--label-action'>Browse</span>">
				                    </div>
				                </div>
			            	</div>
			            </div>
			            
		            </div>
		        </div>
		        <?php //dd($countries); ?>
		        <div id="step-2" class="">
		            <!-- <h3 class="border-bottom border-gray pb-2">Step 2 <i class="fas fa-map-marker-alt"></i> <?= __tr('Location') ?></h3> -->
			        <div class="card-body">
						@if(getStoreSettings('allow_google_map'))
			            <div id="lwUserEditableLocation">
			            	<div class="form-group row">
			            		<div class="col-sm-6 mb-3 mb-sm-0">
									<label for="looking_for"><?= __tr('Select Country') ?></label>
									<select name="country" class="form-control" id="country">
										<option value="" selected disabled><?= __tr('Select Country') ?></option>
										@foreach($countries as $countKey => $country)
												<option value="<?= $country['id'] ?>" <?= (__ifIsset($profileInfo['country_id']) and $country['id']== $profileInfo['country_id']) ? 'selected' : '' ?>><?= $country['name'] ?></option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="looking_for"><?= __tr('Select State') ?></label>
								<select name="state" class="form-control" id="state">
									<option value="" selected disabled><?= __tr('Select State') ?></option>
									
								</select>
							</div>
							<div class="col-sm-6 mb-3 mb-sm-0">
								<label for="looking_for"><?= __tr('Select City') ?></label>
								<select name="city" class="form-control" id="citySave">
									<option value="" selected disabled><?= __tr('Select City') ?></option>
									
								</select>
							</div>
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
		        </div>
		        <div id="step-3" class="">
		            <h2 class="text-center p-5">
		            	<?= __tr('Congratulations') ?>
		            </h2>
		            <div class="text-center ">
		            	<a href class="btn btn-primary p-3 text-white lw-ajax-link-action" data-method="post" data-action="<?= route('user.profile.finish_wizard') ?>" data-callback="finishWizardCallback"> <strong><?= __tr('Finish') ?></strong></a>
		            </div>
		        </div>
		    </div>
		</div>
    </div>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= __tr('Ready to Leave?') ?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= __tr('Select "Logout" below if you are ready to end your current session.') ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><?= __tr('Cancel') ?></button>
                    <a class="btn btn-primary" href="<?= route('user.logout') ?>"><?= __tr('Logout') ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Logout Modal-->

</body>
@push('appScripts')

<script src="https://maps.googleapis.com/maps/api/js?key=<?= getStoreSettings('google_map_key') ?>&libraries=places&callback=initialize" async defer></script>
<script type="text/javascript">

	//set buttons
    function setButtons(stepNumber, stepsStatus) {
    	if (stepNumber == 0) {
			if (stepsStatus.step_one) {
				$(".sw-btn-next").attr('disabled', false);
			} else {
				//$(".sw-btn-prev").attr('disabled', true);
				$(".sw-btn-next").attr('disabled', true);				
			}
		}
		if (stepNumber == 1) {
			if (!stepsStatus.step_two) {
				$(".sw-btn-next").attr('disabled', true);
			} else {
				$(".sw-btn-next").attr('disabled', false);
			}
		}
    }

    var stepNumber = 0;
    //load steps status
    var stepsStatus = <?= json_encode($profileStatus) ?>;
	
	checkProfileStatus = function () {
		__DataRequest.get("<?= route('user.profile.wizard_completed')?>", {}, function(response) {
			stepsStatus = response.data.profileStatus;
			setButtons(stepNumber, stepsStatus);
		},{});
	};

	finishWizardCallback = function (response) {
		if (_.has(response.data, 'redirectURL')) {
			window.location = response.data.redirectURL;
		}
	};

    // Smart Wizard
    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'dots',
        transitionEffect:'fade',
        showStepURLhash: false,
        transitionEffect : "none",
        transitionSpeed: '0',
        toolbarSettings: {
			toolbarPosition: 'bottom',
			showPreviousButton : true,
			showNextButton : true,
        }
    });

    // Step show event
    $("#smartwizard")
    	.on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
			e.preventDefault();
			stepNumber = stepNumber;
			// checkProfileStatus(stepNumber);
			setButtons(stepNumber, stepsStatus);
    });

	setButtons(stepNumber, stepsStatus);
 
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
	$('#citySave').change(saveCities);
	function saveCities()
	{
		var state = $('#state').find(":selected").val();
		var country = $('#country').find(":selected").text();
		var country_id = $('#country').find(":selected").val();
		var city = $('#citySave').find(":selected").val();
		__DataRequest.post("<?= route('user.write.location_data') ?>", {
	        '_state': state,
	        '_country': country,
	        'country_id' : country_id,
	        'save_city' : city,
	        '_city' : city
	    }, function(responseData) {
	    	
			/*if (responseData.reaction == 1) {
				_.defer(function() {
	        		checkProfileStatus();
	        	});
			}*/
		});
	}

	function setLocationCoordinates(key, lat, lng, placeData) {

	    __DataRequest.post("<?= route('user.write.location_data') ?>", {
	        'latitude': lat,
	        'longitude': lng,
	        'placeData': placeData.address_components
	    }, function(responseData) {
	        var requestData = responseData.data;
	        __DataRequest.updateModels('profileData', {
	            city: requestData.city,
	            country_name: requestData.country_name
	        });

	        if (responseData.reaction == 1) {
	        	_.defer(function() {
	        		checkProfileStatus();
	        	});
	        }

	        var mapSrc = "https://maps.google.com/maps/place?q="+lat+","+lng+"&output=embed";
	        $('#gmap_canvas').attr('src', mapSrc);
	    });
	};

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

                __DataRequest.updateModels('profileData', requestData.userProfileData);

            });
        }
    }
</script>
@endpush

<!-- include footer -->
@include('includes.footer')
<!-- /include footer -->