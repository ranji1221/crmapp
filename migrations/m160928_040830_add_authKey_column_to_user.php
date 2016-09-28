<?php

use yii\db\Migration;

class m160928_040830_add_authKey_column_to_user extends Migration
{
    public function up()
    {
    	$this->addColumn('user', 'authKey', 'string UNIQUE');
    }

    public function down()
    {
    	$this->dropColumn('user', 'authKey');
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
