<?php
	namespace app\utilities;
	
	use yii\helpers\Markdown;
	use yii\base\ViewRenderer;
	/**
	 * 自己定义的处理md文件的渲染器
	 * 还得到自己的web.php中的view组件中配置md的处理器
	 * @author Administrator
	 *
	 */
	class MarkdownRenderer extends ViewRenderer{
		
		public function render($view, $file, $params){
			return Markdown::process(file_get_contents($file));
		}
	}
	