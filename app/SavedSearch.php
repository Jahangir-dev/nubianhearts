<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class SavedSearch extends Model
{
    /**
     * @var string - The database table used by the model.
     */
    protected $table = 'saved_searches';

    /**
     * @var array - The attributes that should be casted to native types..
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * @var array - The attributes that are mass assignable.
     */
    protected $fillable = [ 'name', 'looking_for', 'min_age', 'max_age', 'distance', 'countries__id', 'city', 'state', 'username', 'martial_status', 'nationality', 'ethnicity', 'features', 'religion', 'children', 'i_live_with', 'your_occupation', 'annual_income', 'your_education', 'body_type', 'smoke', 'drink', 'min_height', 'max_height', 'from_weight', 'to_weight', 'photo', 'online', 'new_member','user_id'];


    public function user()
    {
        return $this->hasOne(User::class, '_id', 'user_id');
    }
}


