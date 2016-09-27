<?php
	namespace app\assets;
	
	use yii\web\AssetBundle;
	/**
	 * 不使用$basePath 和 $baseUrl定义 Asset的方法
	 * 这是yii2框架为我们提供的另外一种定义资源绑定的方法 
	 * 直接通过文件系统访问  
	 * yii2默认会把$sourcePaht路径下的资源拷贝到web/assets目录下生成临时的唯一访问目录来访问
	 * @author Administrator
	 *
	 */
	class MyAsset extends AssetBundle{
		public $sourcePath = '@app/web/test';  //定义了该属性就不定义$basePath 和 $baseUrl属性了，因为方式不同。
		public $css = [
			'css/test.css'
		];
		public $js = [
			'js/test.js'	
		];
	}