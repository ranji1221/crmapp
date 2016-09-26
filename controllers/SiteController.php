<?php
	namespace app\controllers;
	
	use \yii\web\Controller;
	use app\models\service\Service;
	use yii\web\Response;
use app\utilities\YamlResponseFormatter;
			
	class SiteController extends Controller{
		public function actionIndex(){
			var_dump(\Yii::$app->log->traceLevel);
			//aaaa;
			return 'Our CRM';
		}
		/**
		 * 自定义Renderer，在utilities\MarkdownRenderder.php文件中，
		 * 并在web.php中配置view->renderders->md属性
		 * @return string
		 */
		public function actionDocs(){
			//return '<h1>Documentation</h1>';
			return $this->render('docindex.md');
		}
		/**
		 * 自定义response返回类型
		 */
		public function actionJson(){
			//-- 为毛不能用findAll()呢
			$models = Service::find()->all();
			//-- 对象变数组的方法
			$data = array_map(function($model){
				return $model->attributes;
			},$models);
			
			$response = \Yii::$app->response;
			$response->format = Response::FORMAT_JSON;
			$response->data = $data;
			
			return $response;
		}
		
		/**
		 * 自定义response返回类型
		 */
		public function actionXml(){
			//-- 为毛不能用findAll()呢
			$models = Service::find()->all();
			//-- 对象变数组的方法
			$data = array_map(function($model){
				return $model->attributes;
			},$models);
					
				$response = \Yii::$app->response;
				$response->format = Response::FORMAT_XML;
				$response->data = $data;
					
				return $response;
		}
		
		/**
		 * 自定义response返回类型,自定义的yaml返回类型
		 * 见app\utilities\YamlResponseFormatter.php和web.php中的response->formatters->yaml的配置
		 */
		public function actionYaml(){
			//-- 为毛不能用findAll()呢
			$models = Service::find()->all();
			//-- 对象变数组的方法
			$data = array_map(function($model){
				return $model->attributes;
			},$models);
					
				$response = \Yii::$app->response;
				$response->format = YamlResponseFormatter::FORMAT_YAML;  
				$response->data = $data;
					
				return $response;
		}
	}