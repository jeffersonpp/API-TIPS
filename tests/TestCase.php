<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Jenssegers\Mongodb\Eloquent\Model;
use Tests\Unit\Tip;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
	
}

