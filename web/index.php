<?php


// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');


//-- 1. Including the autoload and  yii2 framework
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
//-- 2. Getting the configuration
$config = require(__DIR__ . '/../config/web.php');
//-- 3. launching the application
(new yii\web\Application($config))->run();
