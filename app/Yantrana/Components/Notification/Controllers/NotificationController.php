<?php
/*
* NotificationController.php - Controller file
*
* This file is part of the Notification component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Notification\Controllers;

use App\Yantrana\Support\CommonPostRequest;
use App\Yantrana\Base\BaseController;
use App\Yantrana\Components\Notification\NotificationEngine;
use App\Yantrana\Support\CommonTrait;
use App\Yantrana\Components\UserSetting\Repositories\UserSettingRepository;

class NotificationController extends BaseController
{
	 /**
     * @var NotificationEngine - Notification Engine
     */
	protected $notificationEngine;

    use CommonTrait;

    /**
     * @var  UserSettingRepository $userSettingRepository - UserSetting Repository
     */
    protected $userSettingRepository;


    /**
     * Constructor.
     *
     * @param NotificationEngine $notificationEngine - Notification Engine
     *-----------------------------------------------------------------------*/
    public function __construct(NotificationEngine $notificationEngine,UserSettingRepository $userSettingRepository)
    {
        $this->notificationEngine = $notificationEngine;
        $this->userSettingRepository    = $userSettingRepository;
	}
	
	/**
     * Get notification view.
     *
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getNotificationView()
    {
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
        return $this->loadPublicView('notification.notification-list',compact('userSettingData'));
	}

	/**
     * Get Notification DataTable data.
     *
     *-----------------------------------------------------------------------*/
    public function getNotificationList()
    {
        return $this->notificationEngine->prepareNotificationList();
	}

	/**
     * Handle read all notification request.
     *
     * @param object read notification $request
     * @param string $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function readAllNotification()
    {
        $processReaction = $this->notificationEngine->processReadAllNotification();

        return $this->responseAction(
			$this->processResponse($processReaction, [], [], true)
		);
	}
}