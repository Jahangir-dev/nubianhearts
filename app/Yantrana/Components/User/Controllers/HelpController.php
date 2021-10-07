<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\User\Controllers;

use App\Yantrana\Base\BaseController;
use Illuminate\Http\Request;
use App\Yantrana\Components\User\UserEngine;
use App\Yantrana\Support\CommonUnsecuredPostRequest;
use Auth;
use App\Yantrana\Components\User\ManageUserEngine;
class HelpController extends BaseController
{
    protected $userEngine;
    
    public function __construct(UserEngine $userEngine)
    {
        $this->userEngine = $userEngine;
    }
    
	public function faq()
    {
        return $this->loadPublicView('user.help.faq');
    }

    public function bug()
    {
        return $this->loadPublicView('user.help.bug');
    }

    public function feedback()
    {
        return $this->loadPublicView('user.help.feedback');
    }

    public function contact()
    {
        return $this->loadPublicView('user.help.contact');
    }

    public function contact_add(Request $request)
    {
        $request['user_name'] = getUserAuthInfo('profile.username');
        $request['user_email'] = getUserAuthInfo('profile.email');
        $request['device'] = null;
        $request['inq_type'] = 'contact';
        $processReaction = $this->userEngine->processQuery($request->all());

         return $this->responseAction(
                $this->processResponse($processReaction, [], [], true)
            );
    }

    public function feedback_add(Request $request)
    {
        $request['user_name'] = getUserAuthInfo('profile.username');
        $request['user_email'] = getUserAuthInfo('profile.email');
        $request['device'] = null;
        $request['inq_type'] = 'feedback';
        $processReaction = $this->userEngine->processQuery($request->all());

         return $this->responseAction(
                $this->processResponse($processReaction, [], [], true)
            );
    }

     public function bug_add(Request $request)
    {
        $request['user_name'] = getUserAuthInfo('profile.username');
        $request['user_email'] = getUserAuthInfo('profile.email');
        $request['inq_type'] = 'bug';
        $processReaction = $this->userEngine->processQuery($request->all());

         return $this->responseAction(
                $this->processResponse($processReaction, [], [], true)
            );
    }
}