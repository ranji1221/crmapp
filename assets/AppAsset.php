<?php
	namespace app\assets;
	
	use yii\web\AssetBundle;
	
	class AppAsset extends AssetBundle{
		public $basePath = '@webroot';		//-- 资源存放的根路径  D:xampp/htdocs/crmpapp/web
		public $baseUrl = '@web';			//-- 资源访问的根url路径，即在register资源后，追加的路径，这里为"/"。例如：<script src="/css/site.css">
		public $css = [
				'css/site.css',
		];
		public $js = [
		];
		public $depends = [
				'yii\web\YiiAsset',
				'yii\bootstrap\BootstrapAsset',
		];
	}