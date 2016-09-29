<?php


class RoleHierarchyTest extends \Codeception\Test\Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;
	private $user;
    
    
    protected function _before()
    {
    	$this->user = \Yii::$app->user;
    }

    protected function _after()
    {
    }

    /** @test */
    public function DefaultRolIsGuest(){
		$this->assertFalse($this->user->can('admin'));
		$this->assertTrue($this->user->can('guest'));
    }
}