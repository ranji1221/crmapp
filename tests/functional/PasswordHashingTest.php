<?php


use app\models\user\User;

class PasswordHashingTest extends \Codeception\Test\Unit
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    protected function _before()
    {
    	
    }

    protected function _after()
    {
    }
    
    //-- 注意两种测试方法定义：1. 加/**@test*/注释； 2.方法的前缀为test

    /** @test */
    public function PasswordIsHashedWhenSaveingUser(){	
    
    	$user = $this->imagineUser();
    	$plaintextPwd = $user->password;		//-- 没加密的密码
    	
    	$user->save();
    	
    	$savedUser = User::findOne($user->id);
    	$security = new yii\base\Security();
    	
    	$this->assertInstanceOf(get_class($user), $savedUser, 'en,is true.');
    	$this->assertTrue($security->validatePassword($plaintextPwd, $savedUser->password));
    }
    
    private function imagineUser(){
    	$faker = \Faker\Factory::create();
    	
    	$user = new User();
    	$user->username = $faker->word;
    	$user->password = md5(time());   //-- 这里就是产生了密码，把它看成明文即可。
    	
    	return $user;
    }
    
    /** @test */
   	public function PasswordIsNotRehashedAfterUpdatingWithoutChangingPassword(){
    	$user = $this->imagineUser();
    	$user->save();
    	
    	$savedUser = User::findOne($user->id);
    	$expectedHash = $savedUser->password;
    	
    	$savedUser->username = md5(time());
    	$savedUser->save();
    	
    	$updatedUser = User::findOne($savedUser->id);
    	
    	$this->assertEquals($savedUser->username, $updatedUser->username);
    	$this->assertEquals($expectedHash, $savedUser->password);
    	$this->assertEquals($expectedHash, $updatedUser->password);
    }
    
    
    
}