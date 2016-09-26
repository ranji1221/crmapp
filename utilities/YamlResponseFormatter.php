<?php
	namespace app\utilities;
	
	use yii\web\ResponseFormatterInterface;
	use Symfony\Component\Yaml\Yaml;
	
	/**
	 * 自定义yaml返回格式
	 * @author Administrator
	 *
	 */
	class YamlResponseFormatter implements ResponseFormatterInterface{
		const FORMAT_YAML = 'yaml';  //在web.php配置文件中要用到
		
		public function format($response){
			$response->headers->set('Content-Type: application/yaml');
			$response->headers->set('Content-Disposition: inline');
			$response->content = Yaml::dump($response->data);
		}
	}