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
    	],
    		
    	'response' => [
    		'formatters' =>[
    			'yaml' => [
    				'class' => 'app\utilities\YamlResponseFormatter'	
    			]	
    		],	
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

