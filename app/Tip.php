<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Tip extends Eloquent
{
	use HybridRelations;
	use SoftDeletes;
	

    /**
     * The connection name
     *
     */
	protected $connection = 'mongodb';

    /**
     * The collection where users are stored
     *
     */
	protected $collection = 'tips';

    /**
     * The attributes that enables softDelete.
     *
     */	
	protected $dates = ['deleted_at'];
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['guid', 'title', 'description', 'created_at', 'updated_at'];
}
