<?php

namespace App\Yantrana\Components\User\Models;

use App\Yantrana\Base\BaseModel;

class UserQuery extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'user_quries';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $fillable = ['inq_message','user_email','user_name','device','inq_type'];
}
