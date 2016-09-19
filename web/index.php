<?php
	//-- 1. 引入 Yii2 框架
	require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

	//-- 2. 获取配置信息
	$config = require(__DIR__ . '/../config/web.php');

	//-- 2. 创建并运行应用实例
	(new yii\web\Application($config))->run();