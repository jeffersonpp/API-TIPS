<?php

namespace Tests\Unit;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Tip extends Eloquent
{
	use HybridRelations;
	use SoftDeletes;
	
    protected $connection = 'mongodb';
    protected $collection = 'test_tips';
	protected $dates = ['deleted_at'];
    protected $fillable = ['guid', 'title', 'description', 'created_at', 'updated_at'];
}
