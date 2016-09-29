<?php
	return [
			'id' => 'crmapp-console',
			'basePath' => dirname(__DIR__),
			'components' => [
					'db' => require(__DIR__ . '/db.php'),
					//-- web.php若配置了该权限控制功能组件，那么console.php中也应该配置该组件（影响建立表）
					'authManager' => require (__DIR__ . '/rbac.php'),
			],
	];