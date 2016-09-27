<?php
	namespace app\assets;
	
	use yii\web\AssetBundle;
	
	class SnowAsset extends AssetBundle{
		public $sourcePath = '@app/web/snow';
		
		public $css = ['css/snow.css'];
		public $js = ['js/snow.js'];
	}