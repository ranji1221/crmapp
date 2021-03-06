<?php

return [
    'id' => 'crmapp',
	//-- bashPath的两种写法
    //'basePath' => dirname(__DIR__),
    'basePath' => realPath(__DIR__ . '/../'),
	'timeZone' => 'Asia/Shanghai',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'jiran1221',
        ],
    	'db' => require(__DIR__ . '/db.php'),
    	
    	'log' => [
    		'traceLevel' => YII_DEBUG ? 3 : 0,
    		'targets' => [
    			'file' => [
    				'class' => 'yii\log\FileTarget',
    				//'levels' => ['error','warning','trace','info']
    			],
    		]
    	],
    	
    	'view' => [
    		'renderers'=> [
    			'md' => [
    				'class' => 'app\utilities\MarkdownRenderer'	
    			]	
    		],	
    		/* //--  暂时注释掉主题的配置，详见上一个版本
    		'theme' => [
    			'class' => yii\base\Theme::className(),
    			'basePath' => '@app/themes/snow',
    		],*/
    	],
    		
    	'response' => [
    		'formatters' =>[
    			'yaml' => [
    				'class' => 'app\utilities\YamlResponseFormatter'	
    			]	
    		],	
    	],	
    	//-- 配置用户登录身份认证	
    	'user' => [
    		'identityClass' => 'app\models\user\User',	
    		'enableAutoLogin' => true		//-- 配置cookie其作用，能够自动登录
    	],
    	//--配置rbac的权限控制
    	'authManager' => require (__DIR__ . '/rbac.php'),	
    	//-- 配置自定义的异常	
    	'errorHandler' => [
    		'errorAction' => 'site/error',	//-- 自定义异常处理	
    	],
    		
    	'urlManager' => [
    		'enablePrettyUrl' => true,
    		'showScriptName' => false
    	],
    ],
		
	'modules' => [
		'gii' => [
			'class' => 'yii\gii\Module',
			'allowedIPs' => ['*'],
		],
	],
];

