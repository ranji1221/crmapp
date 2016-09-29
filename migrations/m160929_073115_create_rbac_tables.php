<?php

use yii\db\Migration;

class m160929_073115_create_rbac_tables extends Migration
{
    public function up()
    {
		//-- 两种方式创建yii2框架中自带的rbac中的建表语句
		//-- 1. 第一种是：在项目根路径下执行 ./yii migrate --migrationPath='@yii/rbac/migrations' 命令
		//-- 2. 第二种是：在这里执行sql文件
		$this->execute(file_get_contents(\Yii::getAlias('@yii/rbac/migrations/schema-mysql.sql')));
    }

    public function down()
    {
        echo "m160929_073115_create_rbac_tables cannot be reverted.\n";

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
