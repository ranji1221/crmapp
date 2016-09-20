<?php

return [
    'id' => 'crmapp',
	//-- bashPath的两种写法
    //'basePath' => dirname(__DIR__),
    'basePath' => realPath(__DIR__ . '/../'),
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'jiran1221',
        ],
    	'db' => require(__DIR__ . '/db.php'),
    ],
];

