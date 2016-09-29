<?php

use yii\db\Migration;

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
		
		
		
    }

    public function down()
    {
        echo "m160929_080843_create_roles_for_predefined_users cannot be reverted.\n";

        return false;
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
