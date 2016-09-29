<?php

use yii\db\Migration;
use app\models\user\User;

class m160929_080843_create_roles_for_predefined_users extends Migration
{
    public function up(){
		$rbac = \Yii::$app->authManager;
		
		$guest = $rbac->createRole('guest');
		$guest->description = 'Nobody';
		$rbac->add($guest);
		
		$user = $rbac->createRole('user');
		$user->description = 'Can user the query UI and nothing else';
		$rbac->add($user);
		
		$manager = $rbac->createRole('manager');
		$manager->description = 'Can manage entities in database,but not users';
		$rbac->add($manager);
		
		$admin = $rbac->createRole('admin');
		$admin->description = 'Can do anythin including managing users';
		$rbac->add($admin);
		
		$rbac->addChild($admin, $manager);
		$rbac->addChild($manager, $user);
		$rbac->addChild($user, $guest);
		
		$rbac->assign(
			$user, User::findOne(['username'=>'RanUser'])->id
		);
		$rbac->assign(
			$manager, User::findOne(['username'=>'RanManager'])->id
		);
		$rbac->assign(
			$admin, User::findOne(['username'=>'RanAdmin'])->id
		);
    }

    public function down()
    {
      	$manager = \Yii::$app->authManager;
      	$manager->removeAll();
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
