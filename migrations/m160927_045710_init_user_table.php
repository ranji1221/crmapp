<?php

use yii\db\Migration;

class m160927_045710_init_user_table extends Migration
{
    public function up()
    {
    	$tableOptions = null;
    	if($this->db->driverName === 'mysql')
    		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    		 
    		$this->createTable('user', [
    				'id' => $this->primaryKey(),
    				'username' => $this->string()->notNull()->unique(),
    				'password' => $this->string(),
    		],$tableOptions);
    }

    public function down()
    {
       // echo "m160927_045710_init_user_table cannot be reverted.\n";

        //return false;
        $this->dropTable('user');
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
