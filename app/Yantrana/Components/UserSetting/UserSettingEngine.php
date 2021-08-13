<?php
/*
* UserSettingEngine.php - Main component file
*
* This file is part of the UserSetting component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\UserSetting;

use App\Yantrana\Base\BaseEngine;
 
use App\Yantrana\Components\Media\MediaEngine;
use App\Yantrana\Components\UserSetting\Repositories\UserSettingRepository;
use App\Yantrana\Support\Country\Repositories\CountryRepository;
use App\Yantrana\Components\UserSetting\Interfaces\UserSettingEngineInterface;
use App\Yantrana\Support\CommonTrait;
use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\Country;
use MenaraSolutions\Geographer\State;
use MenaraSolutions\Geographer\City;

class UserSettingEngine extends BaseEngine implements UserSettingEngineInterface 
{   
     /**
     * @var CommonTrait - Common Trait
     */
    use CommonTrait;

    /**
     * @var  UserSettingRepository $userSettingRepository - UserSetting Repository
     */
    protected $userSettingRepository;

    /**
     * @var  CountryRepository $countryRepository - Country Repository
     */
    protected $countryRepository;
    
    /**
     * @var  MediaEngine $mediaEngine - Media Engine
     */
    protected $mediaEngine;

    /**
      * Constructor
      *
      * @param  UserSettingRepository $userSettingRepository - UserSetting Repository
      * @param  CountryRepository $countryRepository - Country Repository
      * @param  MediaEngine $mediaEngine - Media Engine
      *
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(
        UserSettingRepository $userSettingRepository,
        CountryRepository $countryRepository,
        MediaEngine $mediaEngine
        )
    {
        $this->userSettingRepository    = $userSettingRepository;
        $this->countryRepository        = $countryRepository;
        $this->mediaEngine              = $mediaEngine;
	}
	
	/**
     * Prepare User Settings.
     *
     * @param string $pageType
     * 
     * @return array
     *---------------------------------------------------------------- */
    public function prepareUserSettings($pageType)
    {
		// Get settings from config
		$defaultSettings = $this->getDefaultSettings($this->getUserSettingConfig()['items'][$pageType]);

		// check if default settings exists
        if (__isEmpty($defaultSettings)) {
            return $this->engineReaction(18, ['show_message'=> true], __tr('Invalid page type.'));
		}

		$userSettings = $dbUserSettings = [];
		// Check if default settings exists
        if (!__isEmpty($defaultSettings)) {
			// Get selected default settings
			$userSettingCollection = $this->userSettingRepository->fetchUserSettingByName(array_keys($defaultSettings));
			
            // check if configuration collection exists
            if (!__isEmpty($userSettingCollection)) {
                foreach($userSettingCollection as $configuration) {
					$dbUserSettings[$configuration->key_name] = $this->castValue($configuration->data_type, $configuration->value);
                }
            }
          
            // Loop over the default settings
            foreach($defaultSettings as $defaultSetting) {
                $userSettings[$defaultSetting['key']] = $this->prepareDataForConfiguration($dbUserSettings, $defaultSetting);
            }
		}
		
		return $this->engineReaction(1, [
            'userSettingData' => $userSettings
        ]);
	}

	/**
     * Process User Setting Store.
     *
     * @param string $pageType
     * @param array $inputData
     * 
     * @return array
     *---------------------------------------------------------------- */
	public function processUserSettingStore($pageType, $inputData) 
    {
		$dataForStoreOrUpdate = $userSettingKeysForDelete = [];
        $isDataAddedOrUpdated = false;

        // Get settings from config
        $defaultSettings = $this->getDefaultSettings($this->getUserSettingConfig()['items'][$pageType]);

        // check if default settings exists
        if (__isEmpty($defaultSettings)) {
            return $this->engineReaction(18, ['show_message'=> true], __tr('Invalid page type.'));
		}

		//check page type is notifications
		if ($pageType == 'notification') {
			if (!__isEmpty($inputData)) {
				foreach ($inputData as $key => $value) {
					$inputData[$key] = (isset($value) and $value == 'true') ? true : false;
				}
			}
		}

		 // Check if input data exists
        if (!__isEmpty($inputData)) {
			foreach($inputData as $inputKey => $inputValue) {
				// Get selected default settings
				$userSettingCollection = $this->userSettingRepository->fetchUserSettingByName(array_keys($defaultSettings));
				//pluck user setting value and key name
				$userSettingKeyName = $userSettingCollection->pluck('value', 'key_name')->toArray();
				
				// Check if default text and form text not same                
				if (array_key_exists($inputKey, $defaultSettings) and $inputValue != $defaultSettings[$inputKey]['default']) {
					$castValues = $this->castValue(
						($defaultSettings[$inputKey]['data_type'] == 4)
						? 5 : $defaultSettings[$inputKey]['data_type'], // for Encode purpose only
						$inputValue);
					//if data exists in configuration then use existing data
					if (array_key_exists($inputKey, $userSettingKeyName)) {
						foreach ($userSettingCollection as $key => $settings) {
							if ($inputKey == $settings['key_name']) {
								$dataForStoreOrUpdate[] = [
									'_id'			=> $settings['_id'],
									'key_name'      => $inputKey,
									'value'     	=> $castValues,
									'data_type' 	=> $defaultSettings[$inputKey]['data_type'],
									'users__id' 	=> getUserID()
								];
							}
						}
					} else {
						$dataForStoreOrUpdate[] = [
							'key_name'      => $inputKey,
							'value'     	=> $castValues,
							'data_type' 	=> $defaultSettings[$inputKey]['data_type'],
							'users__id' 	=> getUserID()
						];
					}
				}
				
				// Check if default value and input value same and it is exists
				if ((array_key_exists($inputKey, $defaultSettings)) 
					and ($inputValue == $defaultSettings[$inputKey]['default'])
					and (!isset($defaultSettings[$inputKey]['hide_value']))) {
					if (array_key_exists($inputKey, $userSettingKeyName)) {
						foreach ($userSettingCollection as $key => $settings) {
							if ($inputKey == $settings['key_name']) {
								$userSettingKeysForDelete[] = $settings['_id'];
							}
						}
					}
				}
			}	
			
			// Send data for store or update
			if (!__isEmpty($dataForStoreOrUpdate) 
				and $this->userSettingRepository->storeOrUpdate($dataForStoreOrUpdate)) {
				activityLog('User settings stored / updated.');
				$isDataAddedOrUpdated = true;
			}

			// Check if deleted keys deleted successfully
			if (!__isEmpty($userSettingKeysForDelete) 
			and $this->userSettingRepository->deleteUserSetting($userSettingKeysForDelete)) {
				$isDataAddedOrUpdated = true;
			}

			// Check if data added / updated or deleted
			if ($isDataAddedOrUpdated) {
				return $this->engineReaction(1, ['show_message'=> true], __tr('User setting updated successfully.'));
			}
			return $this->engineReaction(14, ['show_message'=> true], __tr('Nothing updated.'));
		}
		return $this->engineReaction(2, ['show_message'=> true], __tr('Something went wrong on server.'));
	}

    /*
      * Process Store User General Settings
      *
      * @param array $inputData
      *
      * @return boolean.
      *-------------------------------------------------------- */
    public function processStoreUserBasicSettings($inputData)
    {
        $transactionResponse = $this->userSettingRepository->processTransaction(function() use($inputData) {
            $isBasicSettingsUpdated = false;
            // Prepare User Details
            $userDetails = [
                'first_name' => $inputData['first_name'],
                'last_name'  => $inputData['last_name'],
                /*'mobile_number'   => $inputData['mobile_number']*/
            ];
            
            $userId = getUserID();
            $user = $this->userSettingRepository->fetchUserDetails($userId);
            // Check if user details exists
            if (\__isEmpty($userDetails)) {
                return $this->engineReaction(18, null, __tr('User does not exists.'));
            }

            // check if user details updated
            /*if ($this->userSettingRepository->updateUser($user, $userDetails)) {
                activityLog($user->first_name.' '.$user->last_name. ' update own user info.');
                $isBasicSettingsUpdated = true;
            }*/
            //dd(array_get($inputData,'looking_for_nationality'));
            if(array_key_exists('form_looking',$inputData) == true)
            {
                $userProfileDetails = [
                    'looking_for_description'   => array_get($inputData, 'looking_for_description'),
                    'looking_for_from_age'   => array_get($inputData, 'looking_for_from_age'),
                    'looking_for_to_age'   => array_get($inputData, 'looking_for_to_age'),
                    'looking_for_nationality'   => array_get($inputData, 'looking_for_nationality'),
                    'looking_for_ethnicity'   => array_get($inputData, 'looking_for_ethnicity'),
                    'looking_for_religion'   => array_get($inputData, 'looking_for_religion'),
                    'looking_for_lives_in'   => array_get($inputData, 'looking_for_lives_in'),
                    'looking_for_living_situation'   => array_get($inputData, 'looking_for_living_situation'),
                    'looking_for_kids'   => array_get($inputData, 'looking_for_kids'),
                    'looking_for_best_feature'   => array_get($inputData, 'looking_for_best_feature'),
                    'looking_for_born_in'   => array_get($inputData, 'looking_for_born_in'),
                    'looking_for_occupation'   => array_get($inputData, 'looking_for_occupation'),
                    'looking_for_salary'   => array_get($inputData, 'looking_for_salary'),
                    'looking_for_education'   => array_get($inputData, 'looking_for_education'),
                    'looking_for_smoking'   => array_get($inputData, 'looking_for_smoking'),
                    'looking_for_alcohol'   => array_get($inputData, 'looking_for_alcohol')
                ];
                
            } else if(array_key_exists('intrest',$inputData) == true)
            { 
                $userProfileDetails = [
                    'entertainment' =>  array_get($inputData, 'entertainment'),
                    'food' =>  array_get($inputData, 'food'),
                    'sports' =>  array_get($inputData, 'sports'),
                    'music' =>  array_get($inputData, 'music'),
                ];
            } else {
            // Prepare User profile details
                $userProfileDetails = [
                    'gender'                => array_get($inputData, 'gender'),
                    'dob'                   => array_get($inputData, 'birthday'),
                    'work_status'           => array_get($inputData, 'work_status'),
                    'looking_for'           => array_get($inputData, 'looking_for'),
                    'star_sign'             => array_get($inputData, 'star_sign'),
                    'seeking'               => array_get($inputData, 'seeking'),
                    'born_country'          => array_get($inputData, 'born_country'),
                    'education'             => array_get($inputData, 'education'),
                    'about_me'              => array_get($inputData, 'about_me'),
                    'preferred_language'    => array_get($inputData, 'preferred_language'),
                    'relationship_status'   => array_get($inputData, 'relationship_status')
                ];
            }
            
            // get user profile
            $userProfile = $this->userSettingRepository->fetchUserProfile($userId);

            // check if user profile exists
            if (\__isEmpty($userProfile)) {
                $userProfileDetails['user_id'] = $userId;
                if ($this->userSettingRepository->storeUserProfile($userProfileDetails)) {
                    activityLog($user->first_name.' '.$user->last_name. ' store own user profile.');
                    $isBasicSettingsUpdated = true;
                }
            } else {
                if ($this->userSettingRepository->updateUserProfile($userProfile, $userProfileDetails)) {
                    activityLog($user->first_name.' '.$user->last_name. ' update own user profile.');
                    $isBasicSettingsUpdated = true;
                }
            }
            
            if ($isBasicSettingsUpdated) {
                if(array_key_exists('form_looking',$inputData) == true)
                {
                    return $this->userSettingRepository->transactionResponse(1, [], __tr('Your looking for updated successfully.'));
                } else if(array_key_exists('intrest',$inputData) == true)
                {
                    return $this->userSettingRepository->transactionResponse(1, [], __tr('Hobbies & Interests for updated successfully.'));
                }else {
                    return $this->userSettingRepository->transactionResponse(1, [], __tr('Your basic information updated successfully.'));
                }
                
            }

            // // Send failed server error message
            return $this->userSettingRepository->transactionResponse(2, [], __tr('No Change'));
        });
        
        return $this->engineReaction($transactionResponse);
    }

    /*
      * process Store Profile Wizard
      *
      * @param array $inputData
      *
      * @return boolean.
      *-------------------------------------------------------- */
    public function processStoreProfileWizard($inputData)
    {
        $transactionResponse = $this->userSettingRepository->processTransaction(function() use($inputData) {
            $isBasicSettingsUpdated = false;
         
            $userId = getUserID();
            $user = $this->userSettingRepository->fetchUserDetails($userId);
            // Check if user details exists
            if (\__isEmpty($user)) {
                return $this->engineReaction(18, null, __tr('User does not exists.'));
            }

            // Prepare User profile details
            $userProfileDetails = [
                'gender'                => array_get($inputData, 'gender'),
                'dob'                   => array_get($inputData, 'birthday'),
            ];
            
            // get user profile
            $userProfile = $this->userSettingRepository->fetchUserProfile($userId);
            // check if user profile exists
            if (\__isEmpty($userProfile)) {
                $userProfileDetails['user_id'] = $userId;
                if ($this->userSettingRepository->storeUserProfile($userProfileDetails)) {
                    activityLog($user->first_name.' '.$user->last_name. ' store own user profile.');
                    $isBasicSettingsUpdated = true;
                }
            } else {
                if ($this->userSettingRepository->updateUserProfile($userProfile, $userProfileDetails)) {
                    activityLog($user->first_name.' '.$user->last_name. ' update own user profile.');
                    $isBasicSettingsUpdated = true;
                }
            }

            if ($isBasicSettingsUpdated) {
                return $this->userSettingRepository->transactionResponse(1, [], __tr('Your basic information updated successfully.'));
            }
            // // Send failed server error message
            return $this->userSettingRepository->transactionResponse(2, [], __tr('Something went wrong on server.'));
        });
        
        return $this->engineReaction($transactionResponse);
    }

    /**
     * Process Store Location Data
     *
     * @param array $inputData
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function processStoreLocationData($inputData)
    {
        $earth = new Earth();
        
        if(array_key_exists('get_state',$inputData))
        {
            $country = $earth->getCountries()->findOne(['name' => $inputData['get_state']]);
            $state = $country->getStates()->toArray();
            
            if($state)
            {
            
                return $this->engineReaction(1, [
                'country' => $inputData['get_state'],
                'states' => $state 
                ]);
            } else {
                return $this->engineReaction(2, null, __tr('No States Available'));
            }
        }

        if(array_key_exists('get_cities',$inputData))
        { 
            $code = (int)$inputData['get_cities'];
            $state = State::build($code);
            $cities = $state->getCities()->toArray();
            
            if($cities)
            {
                 return $this->engineReaction(1, [
                'cities' => $cities 
                ]);
                
            } else {
                return $this->engineReaction(2, null, __tr('No States Available'));
            }
        }
        
       
        if(array_key_exists('location_store',$inputData) )
        {  
            if(isset($inputData['country']) == false)
            {
                return $this->engineReaction(2, null, __tr('country required'));
            }
            if(isset($inputData['state']) == false)
            {
                return $this->engineReaction(2, null, __tr('state required'));
            }
            if(isset($inputData['city']) == false)
            {
                $code = '';
            } else {
             $code = (int)$inputData['city'];
            }
            
            if(!__isEmpty($code))
            {
                $city = City::build($code);
            } else {
                $city = '';
            }
    
            $isUserLocationUpdated = false;
            $userId = getUserID();
            $user = $this->userSettingRepository->fetchUserDetails($userId);
            // Check if user details exists
            if (\__isEmpty($user)) {
                return $this->engineReaction(18, null, __tr('User does not exists.'));
            }
             
            // get user profile
            $userProfile = $this->userSettingRepository->fetchUserProfile($userId);
            $userProfileDetails = [
                    'countries__id' => (int)$inputData['country'],
                    'city' => (int)$inputData['city'],
                    'location_latitude' => $city->getLatitude(),
                    'location_longitude'=> $city->getLongitude(),
                    'state'             => (int)$inputData['state'],
                    'user_id'           =>  $userId
                ];
            
            // check if user profile exists
            if (\__isEmpty($userProfile)) {
                $userProfileDetails['user_id'] = $userId;
                if ($this->userSettingRepository->storeUserProfile($userProfileDetails)) {
                    activityLog($user->first_name.' '.$user->last_name. ' store own location.');
                    $isUserLocationUpdated = true;
                }
            } else {
                if ($this->userSettingRepository->updateUserProfile($userProfile, $userProfileDetails)) {
                    activityLog($user->first_name.' '.$user->last_name. ' update own location.');
                    $isUserLocationUpdated = true;
                }
            }
            
        // check if user profile stored or update
        if ($isUserLocationUpdated) {
            return $this->engineReaction(1,[], __tr('Location stored successfully.'));
        }
    }
        return $this->engineReaction(2, null, __tr('No Change'));
    }

    /**
     * Process upload profile image.
     *
     * @param array $inputData
     * @param string $requestType
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function processUploadProfileImage($inputData, $requestType)
    {
        $uploadedFile = $this->mediaEngine->processUploadProfile($inputData, $requestType);
        $isProfilePictureUpdated = false;
        // check if file uploaded successfully
        if ($uploadedFile['reaction_code'] == 1) {
            $uploadedFileData = $uploadedFile['data'];
            $fileName = $uploadedFileData['fileName'];
            $userId = getUserID();
            $userInfo = getUserAuthInfo();
            $fullName = array_get($userInfo, 'profile.full_name');
            // get user profile data
            $userProfile = $this->userSettingRepository->fetchUserProfile($userId);
            $userProfileData = [
                'profile_picture' => $fileName
            ];
            
            // check if user profile exists
            if (__isEmpty($userProfile)) {
                $userProfileData['user_id'] = $userId;
                // Check if user profile stored
                if ($this->userSettingRepository->storeUserProfile($userProfileData)) {
                    activityLog($fullName. ' store profile picture.');
                    $isProfilePictureUpdated = true;
                }
            } else {
                // check if existing profile picture exists
                if (!__isEmpty($userProfile->profile_picture)) {
                    $profileFolderPath = getPathByKey('profile_photo', ['{_uid}' => authUID()]);
                    $this->mediaEngine->delete($profileFolderPath, $userProfile->profile_picture);
                }
                // Check if user profile updated
                if ($this->userSettingRepository->updateUserProfile($userProfile, $userProfileData)) {
                    activityLog($fullName. ' update profile picture.');
                    $isProfilePictureUpdated = true;
                }                
            }
        }
        // check if profile picture updated successfully.
        if ($isProfilePictureUpdated) {
            return $this->engineReaction(1, [
                'image_url' => $uploadedFileData['path']
            ], __tr('Profile picture updated successfully.'));
        }

        return $uploadedFile;
    }

    /**
     * Process upload cover image.
     *
     * @param array $inputData
     * @param string $requestType
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function processUploadCoverImage($inputData, $requestType)
    {
        $uploadedFile = $this->mediaEngine->processUploadCoverPhoto($inputData, $requestType);
        $isCoverPictureUpdated = false;
        // check if file uploaded successfully
        if ($uploadedFile['reaction_code'] == 1) {
            $uploadedFileData = $uploadedFile['data'];
            $fileName = $uploadedFileData['fileName'];
            $userId = getUserID();
            $userInfo = getUserAuthInfo();
            $fullName = array_get($userInfo, 'profile.full_name');
            // get user profile data
            $userProfile = $this->userSettingRepository->fetchUserProfile($userId);
            $userProfileData = [
                'cover_picture' => $fileName
            ];
            // check if user profile exists
            if (__isEmpty($userProfile)) {
                $userProfileData['user_id'] = $userId;
                // Check if user profile stored
                if ($this->userSettingRepository->storeUserProfile($userProfileData)) {
                    activityLog($fullName. ' store cover picture.');
                    $isCoverPictureUpdated = true;
                }
            } else {
                // check if existing profile picture exists
                if (!__isEmpty($userProfile->profile_picture)) {
                    $profileFolderPath = getPathByKey('cover_photo', ['{_uid}' => authUID()]);
                    $this->mediaEngine->delete($profileFolderPath, $userProfile->profile_picture);
                }
                // Check if user profile updated
                if ($this->userSettingRepository->updateUserProfile($userProfile, $userProfileData)) {
                    activityLog($fullName. ' update cover picture.');
                    $isCoverPictureUpdated = true;
                }                
            }
        }
        // check if cover picture updated successfully.
        if ($isCoverPictureUpdated) {
            return $this->engineReaction(1, [
                'image_url' => $uploadedFileData['path']
            ], __tr('Profile cover picture updated successfully.'));
        }

        return $uploadedFile;
    }

     /*
      * Process Store User Profile Data
      *
      * @param array $inputData
      *
      * @return boolean.
      *-------------------------------------------------------- */
    public function processStoreUserProfileSetting($inputData)
    {
        $userId = getUserID();
        $userSpecifications = $storeOrUpdateData = [];
        // Get collection of user specifications
        $userSpecificationCollection = $this->userSettingRepository->fetchUserSpecificationById($userId);
        // check if user specification exists
        if (!__isEmpty($userSpecificationCollection)) {
            $userSpecifications = $userSpecificationCollection->pluck('_id', 'specification_key')->toArray();
        }
        
        $index = 0;
        foreach ($inputData as $inputKey => $inputValue) {
            if (!__isEmpty($inputValue)) {
                $storeOrUpdateData[$index] = [
                    'type'                  => 1,
                    'status'                => 1,
                    'specification_key'     => $inputKey,
                    'specification_value'   => $inputValue,
                    'users__id'             => $userId
                ];
                if (array_key_exists($inputKey, $userSpecifications)) {
                    $storeOrUpdateData[$index]['_id'] = $userSpecifications[$inputKey];
                }
                $index++;
            }
        }
        if (!empty($storeOrUpdateData)) {
           
            // Check if user profile updated or store
            if ($this->userSettingRepository->storeOrUpdateUserSpecification($storeOrUpdateData)) {
                $userInfo = getUserAuthInfo();
                $fullName = array_get($userInfo, 'profile.full_name');
                activityLog($fullName. ' update own user settings.');
                return $this->engineReaction(1, null, __tr('Profile updated successfully.'));
            }
        }

        return $this->engineReaction(2, null, __tr('No Change.'));
    }

    /**
     * Prepare user photo settings.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function prepareUserPhotosSettings()
    {
        $userPhotoCollection = $this->userSettingRepository->fetchUserPhotos(getUserID());
        $userPhotos = [];
        $userPhotosFolderPath = getPathByKey('user_photos', ['{_uid}' => authUID()]);
        // check if user photos exists
        if (!__isEmpty($userPhotoCollection)) {
            foreach ($userPhotoCollection as $photo) {
                $userPhotos[] = [
                    '_id' => $photo->_id,
                    'image_url' => getMediaUrl($userPhotosFolderPath, $photo->file)
                ];
            }
        }
        return $this->engineReaction(1, [
            'userPhotos' => $userPhotos,
            'photosCount' => $userPhotoCollection->count()
        ]);
    }

    /**
     * Process Upload Multiple Photots.
     *
     * @param array $inputData
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function processUploadPhotos($inputData)
    {
        $userPhotoCollection = $this->userSettingRepository->fetchUserPhotos(getUserID());

        // Check if user photos count is greater than or equal to 10
        if ($userPhotoCollection->count() >= 10) {
            return $this->engineReaction(2, null, __tr("You cannot upload more than 10 photos."));
        }

        $uploadedFile = $this->mediaEngine->uploadUserPhotos($inputData, 'photos');

        // check if file uploaded successfully
        if ($uploadedFile['reaction_code'] == 1) {
            $userPhotoData = [
                'users__id' => getUserID(),
                'file' => $uploadedFile['data']['fileName']
            ];
            
            if ($newUserPhoto = $this->userSettingRepository->storeUserPhoto($userPhotoData)) {
                $userInfo = getUserAuthInfo();
                $fullName = array_get($userInfo, 'profile.full_name');
                activityLog($fullName. ' upload new photos.');
                return $this->engineReaction(1, [
                    'stored_photo' => [
                        '_id' => $newUserPhoto->_id,
                        'image_url' => $uploadedFile['data']['path']
                    ]
                ], __tr('Photos uploaded successfully.'));
            }            
        }

        return $uploadedFile;
    }
}