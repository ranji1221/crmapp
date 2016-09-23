<?php

use yii\db\Migration;

class m160923_095455_init_service_table extends Migration
{
    public function up()
    {
		$tableOptions = '';
		if($this->db->driverName === 'mysql')
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('service', [
				'id' => $this->primaryKey(),
				'name' => 'string unique',				//-- 服务项目的名称
				'hourly_rate' => 'integer',				//-- 服务项目的费率（按小时计费）
		]);
    }

    public function down()
    {
       $this->dropTable('service');
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
