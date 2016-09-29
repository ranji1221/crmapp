<?php

use yii\db\Migration;
use app\models\user\User;

class m160929_064528_add_predefined_users extends Migration
{
    public function up()
    {
		foreach ([
			'RanUser' => '123456',
			'RanManager' => '123456',
			'RanAdmin' => '123456'
		] as $username => $password){
			$user = new User();
			$user->attributes = ['username'=>$username,'password'=>$password];
			$user->save();
		}
    }

    public function down()
    {
       $this->delete('user');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
