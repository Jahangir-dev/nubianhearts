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
}