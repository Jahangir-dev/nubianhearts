<?php
/*
* UserSettingController.php - Controller file
*
* This file is part of the UserSetting component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\UserSetting\Controllers;

use App\Yantrana\Base\BaseController; 
use App\Yantrana\Components\UserSetting\Requests\{
    UserBasicSettingAddRequest, 
	UserProfileSettingAddRequest,
	UserSettingRequest,
	UserProfileWizardRequest
};
use App\Yantrana\Support\CommonTrait;
use Auth;
use App\Yantrana\Support\CommonUnsecuredPostRequest;
use App\Yantrana\Components\UserSetting\UserSettingEngine;
use App\Yantrana\Components\UserSetting\Repositories\UserSettingRepository;

class UserSettingController extends BaseController
{    
    /**
     * @var  UserSettingEngine $userSettingEngine - UserSetting Engine
     */
    protected $userSettingEngine;

    use CommonTrait;

     protected $userSettingRepository;

    /**
      * Constructor
      *
      * @param  UserSettingEngine $userSettingEngine - UserSetting Engine
      *
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(UserSettingEngine $userSettingEngine,UserSettingRepository $userSettingRepository)
    {
        $this->userSettingEngine = $userSettingEngine;
        $this->userSettingRepository    = $userSettingRepository;
	}
	
	/**
     * Show user setting view.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getUserSettingView($pageType)
    {    
		$processReaction = $this->userSettingEngine->prepareUserSettings($pageType);

        return $this->loadPublicView('user.settings.settings', $processReaction['data']);
	}
	
	 /**
     * Get UserSetting Data.
     *
     * @param string $pageType
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function processStoreUserSetting(UserSettingRequest $request, $pageType) 
    {   
        $processReaction = $this->userSettingEngine
                                ->processUserSettingStore($pageType, $request->all());
      
        return $this->responseAction(
			$this->processResponse($processReaction, [], [], true)
		);
	}

    /**
     * Process store user basic settings.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processUserBasicSetting(UserBasicSettingAddRequest $request)
    {
        $processReaction = $this->userSettingEngine->processStoreUserBasicSettings($request->all());

        return $this->responseAction(
				$this->processResponse($processReaction, [], [], true)
			);
    }

    /**
     * Process profile Update Wizard.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function profileUpdateWizard(UserProfileWizardRequest $request)
    {
        $processReaction = $this->userSettingEngine->processStoreProfileWizard($request->all());

        return $this->responseAction(
				$this->processResponse($processReaction, [], [], true)
			);
    }

    /**
     * Process store user basic settings.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processLocationData(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processStoreLocationData($request->all());

        return $this->responseAction(
				$this->processResponse($processReaction, [], [], true)
			);
    }

    /**
     * Process upload profile image.
     *
     * @param object CommonUnsecuredPostRequest $request
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function uploadProfileImage(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processUploadProfileImage($request->all(), 'profile');

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Process upload cover image.
     *
     * @param object CommonUnsecuredPostRequest $request
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function uploadCoverImage(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processUploadCoverImage($request->all(), 'cover_image');

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Process user profile settings
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processUserProfileSetting(UserProfileSettingAddRequest $request)
    {
        $processReaction = $this->userSettingEngine->processStoreUserProfileSetting($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Show user photos view.
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function getUserPhotosSetting()
    {
        $processReaction = $this->userSettingEngine->prepareUserPhotosSettings();
        
        return $this->loadPublicView('user.settings.photos', $processReaction['data']);
    }

    public function getUserSetting()
    {
        
        $user = Auth::user();
        $data = [];
        if ($user->password == 'NO_PASSWORD') {
            $data = [
                'userPassword' => $user->password
            ];
        }
        $data = [
            'userEmail' => $user->email
        ];

        $pageType = 'notification';
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
        $userSettingData = $userSettings;

        return $this->loadPublicView('user.account.index', compact('data','userSettingData'));
    }

    /**
     * Upload multiple photos
     *
     * @param object CommonUnsecuredPostRequest $request
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function uploadPhotos(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userSettingEngine->processUploadPhotos($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }
}