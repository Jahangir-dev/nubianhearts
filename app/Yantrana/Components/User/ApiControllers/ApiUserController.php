<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\User\ApiControllers;

use App\Yantrana\Base\BaseController;
use Illuminate\Http\Request;
use App\Yantrana\Components\User\Requests\{
    UserLoginRequest,
    UserSignUpRequest,
    VerifyOtpRequest,
    UserResetPasswordRequest,
    UserChangeEmailRequest
};
use App\Yantrana\Components\User\UserEngine;
use App\Yantrana\Support\CommonUnsecuredPostRequest;
use Auth;

class ApiUserController extends BaseController
{
    /**
     * @var UserEngine - User Engine
     */
    protected $userEngine;

    /**
     * Constructor.
     *
     * @param UserEngine $userEngine - User Engine
     *-----------------------------------------------------------------------*/
    public function __construct(UserEngine $userEngine)
    {
        $this->userEngine = $userEngine;
    }

    /**
     * Authenticate user based on post form data.
     *
     * @param object UserLoginRequest $request
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function loginProcess(UserLoginRequest $request)
    {
        $processReaction = $this->userEngine->processLogin($request->all());
        
        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Get User my Disliked view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getWhoLikedMeData()
    {
        //get liked people data by parameter like '1'
        $processReaction = $this->userEngine->prepareUserLikeMeData();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Get mutual like view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getMutualLikeData()
    {
        //get mutual like data
        $processReaction = $this->userEngine->prepareMutualLikeData();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Get User my like view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getMyLikeData()
    {
        //get liked people data by parameter like '1'
        $processReaction = $this->userEngine->prepareUserLikeDislikedData(1);

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Get User my Disliked view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getMyDislikedData()
    {
        //get liked people data by parameter like '1'
        $processReaction = $this->userEngine->prepareUserLikeDislikedData(0);

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Get profile visitors view.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function getProfileVisitorData()
    {
        //get liked people data by parameter like '1'
        $processReaction = $this->userEngine->prepareProfileVisitorsData();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Get block user view and user list.
     *
     * @param string $userName
     * 
     * @return json object
     *---------------------------------------------------------------- */
    public function blockUserList()
    {
        //get profile visitors data
        $processReaction = $this->userEngine->prepareBlockUserData();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Handle report user request.
     *
     * @param object blockUser $userUid
     * @param string $reminderToken
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processUnblockUser($userUid)
    {   
        $processReaction = $this->userEngine->processUnblockUser($userUid);

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Prepare user signup 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function prepareSignUp()
    {   
        $processReaction = $this->userEngine->prepareSignupData();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Prepare user signup 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function processSignUp(UserSignUpRequest $request)
    {
        $processReaction = $this->userEngine->userSignUpProcess($request->all());

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Prepare user signup 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function resendActivationMail(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userEngine->resendActivationMail($request->all());

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Prepare user signup 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function verifyOtp(VerifyOtpRequest $request, $type)
    {
        $processReaction = $this->userEngine->verifyOtpProcess($request->all(), $type);

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Prepare user signup 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function requestNewPassword(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->userEngine->requestNewPassword($request->all());

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Prepare user signup 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function resetPassword(UserResetPasswordRequest $request)
    {
        $processReaction = $this->userEngine->resetPasswordForApp($request->all());

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * prepare user profile 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function readProfile()
    {
        $processReaction = $this->userEngine->prepareProfileDetails();

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * process change email 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function changeEmail(UserChangeEmailRequest $request)
    {
        $processReaction = $this->userEngine->changeEmailProcess($request->all());

        return $this->processResponse($processReaction, [], [], true);
    }

    /**
     * Prepare user profile edit options 
     *
     * @return json object
     *---------------------------------------------------------------- */
    public function prepareProfileUpdate()
    {   
        $processReaction = $this->userEngine->prepareProfileUpdate();

        return $this->processResponse($processReaction, [], [], true);
    }
}