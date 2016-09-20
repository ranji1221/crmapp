<?php

use yii\db\Migration;

class m160920_030333_init_customer_table extends Migration
{
    public function up(){
    	$tableOptions = null;
    	if($this->db->driverName === 'mysql')
    		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    	
		$this->createTable('customer', [
				'id' => $this->primaryKey(),
				'name' => $this->string()->notNull(),
				'birth_date' => $this->date(),
				'notes' => $this->text()
		],$tableOptions);
    }

    public function down() {
       $this->dropTable('customer');
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
