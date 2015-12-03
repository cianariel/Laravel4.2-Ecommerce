<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    protected $fillable = ['user_name'];

    protected $hidden = ['id','created_at','updated_at'];

    /**
     * Define Relationship
     * /
     *
     * /*
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


/*
users - hasOne('user')
ideas - hasMany('idea')
projects - hasMany('project')
reviews - hasMany('review')
images - morphMany('imageable','image')
activities - hasMany('activity')
*/



}
