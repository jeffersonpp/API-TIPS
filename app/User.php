<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Jenssegers\Mongodb\Eloquent\HybridRelations;
//use Illuminate\Foundation\Auth\User as Authenticatable

class User extends Authenticatable
{
    use Notifiable;
//    use HybridRelations;

	/**
     * The connection name.
     *
     */	
    protected $connection = 'mongodb';

    /**
     * The collection where users are stored
     *
     */	
    protected $collection = 'api_users';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
