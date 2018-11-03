<?php

 namespace Tests\Unit;

use Tests\TestCase;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Sujip\Guid\Guid;
use App\Tip;

class TipTest extends TestCase
{
	
    public function testNewModel()
    {
        $tip = new Tip;
        $this->assertInstanceOf(Model::class, $tip);
        $this->assertInstanceOf('Jenssegers\Mongodb\Connection', $tip->getConnection());
        $this->assertFalse($tip->exists);
        $this->assertEquals('tips', $tip->getTable());
        $this->assertEquals('_id', $tip->getKeyName());
    }
    public function testInsert()
    {
		$number = tip::count();
        $tip = new Tip;
		$_guid = new GUID;
        $tip->guid = $_guid->create();
        $tip->title = 'FIRST TEST';
        $tip->description = 'FIRST TEST DESCRIPTION';
        $tip->save();
        $this->assertTrue($tip->exists);
        $this->assertEquals(($number+1), tip::count());
        $this->assertTrue(isset($tip->id));
        $this->assertInternalType('string', $tip->id);
        $this->assertNotEquals('', (string) $tip->id);
        $this->assertNotEquals(0, strlen((string) $tip->id));
        $this->assertEquals('FIRST TEST', $tip->title);
        $this->assertEquals('FIRST TEST DESCRIPTION', $tip->description);
    }
    public function testUpdate()
    {
		$number = tip::count();
        $tip = new Tip;
		$tip->title = 'SECOND TEST';
        $tip->description = 'SECOND TEST DESCRIPTION';
        $tip->save();
        $raw = $tip->getAttributes();
        $check = tip::find($tip->_id);
        $check->title = 'SECOND TEST';
        $check->save();
        $this->assertTrue($check->exists);
        $this->assertEquals(($number+1), tip::count());
        $this->assertEquals('SECOND TEST', $check->title);
        $this->assertEquals('SECOND TEST DESCRIPTION', $check->description);
    }
	public function testGet()
    {
		$number = tip::count();
        tip::insert([
            ['title' => 'THIRD TEST'],
            ['title' => 'FORTH TEST'],
        ]);
        $tips = tip::get();
        $this->assertEquals(($number+2), tip::count());
        $this->assertInstanceOf(Model::class, $tips[0]);
    }
    public function testCreate()
    {
        $tip = tip::create(['title' => 'FIFTH TEST']);
        $this->assertInstanceOf(Model::class, $tip);
        $this->assertTrue($tip->exists);
        $this->assertEquals('FIFTH TEST', $tip->title);
        $check = tip::where('title', 'FIFTH TEST')->orderBy('_id','desc')->first();
        $this->assertEquals($tip->_id, $check->_id);
    }
    public function testDelete()
    {
		$number = tip::count();
        $tip = new Tip;
        $tip->title = 'SIXTH TEST';
        $tip->description = 'SIXTH TEST DESCRIPTION';
        $tip->save();
        $this->assertTrue($tip->exists);
        $this->assertEquals(($number+1), tip::count());
        $tip->delete();
        $this->assertEquals($number, tip::count());
    }
    public function testDestroy()
    {
		$number = tip::count();
        $tip = new Tip;
        $tip->title = 'SSSSIXTH TEST';
        $tip->description = 'SSSSIXTH TEST DESCRIPTION';
        $tip->save();
        tip::destroy($tip->_id);
        $this->assertEquals($number, tip::count());
    }
    public function testSoftDelete()
    {
		$number = tip::count();
		$trashed=tip::withTrashed()->count();
        tip::create(['title' => 'SEVENTH TEST']);
        $this->assertEquals(($number+1), tip::count());
        $tip = tip::where('title', 'SEVENTH TEST')->first();
        $this->assertTrue($tip->exists);
        $this->assertFalse($tip->trashed());
        $this->assertNull($tip->deleted_at);
        $tip->delete();
        $this->assertTrue($tip->trashed());
        $this->assertNotNull($tip->deleted_at);
        $this->assertEquals($number, tip::count());
        $this->assertEquals(($trashed+1), tip::withTrashed()->count());		
		$tip->delete();
    }

}