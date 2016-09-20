<?php

use yii\db\Migration;

class m160920_031404_init_phone_table extends Migration
{
    public function up()
    {
		$tableOptions = null;
		if($this->db->driverName === 'mysql')
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		
		$this->createTable('phone', [
				'id' => $this->primaryKey(),
				'customer_id' => $this->integer(),
				'number' => $this->string(),
		],$tableOptions);
		
		$this->addForeignKey('customer_phone_numbers', 'phone', 'customer_id', 'customer', 'id');
    }

    public function down()
    {
       $this->dropForeignKey('customer_phone_numbers', 'phone');
       $this->dropTable('phone');
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
