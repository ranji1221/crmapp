<?php
	namespace app\controllers;
	
	use \yii\web\Controller;
	use app\models\service\Service;
	use app\models\user\LoginForm;
	use app\utilities\YamlResponseFormatter;
	use yii\web\Response;
use yii\filters\AccessControl;
				
	class SiteController extends Controller{
		
		//-- yii2提供了两种访问控制的方式，
		//-- 第一种是利用beforeAction($action)和afterAction($action)方式做控制
		//-- 第二种是利用过滤器（也叫behavior行为）
		//-- 这里先看第一种
		/*
		public function beforeAction($action){
			$parentAllowed = parent::beforeAction($action);
			$meAllowed = !\Yii::$app->user->isGuest;
			echo '<center><h2>您是游客，没权限访问</h2></center><hr color="red"/>';
			return $parentAllowed and $meAllowed;
		}*/
		//-- 第二种过滤器处理方式
		public function behaviors(){
			return [
				'access' => [
					'class' => AccessControl::className(),
					'only' => ['login','logout'],
					'rules' => [
						[
							'actions' => ['login'],
							'roles' => ['?'],
							'allow' => true,
						],
						[
							'actions' => ['logout'],
							'roles' => ['@'],
							'allow' => true
						]
					]
				],	
			];
		}
		
		
		public function actionIndex(){
			//var_dump(\Yii::$app->log->traceLevel);
			//return 'Our CRM';
			//$this->layout = false;		//-- 不使用模板
			
			//\Yii::$app->request->
			//if(\Yii::$app->user->){
			//\Yii::$app->user->enableAutoLogin = true;
			return $this->render('index');
		}
		
		public function actionAsset(){
			$this->layout = 'test';
			return $this->render('testasset');
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
		
		public function actionAbout(){
			return $this->render('about');
		}
		
		public function actionContact(){
			return $this->render('contact');
		}
		
		public function actionLogin(){
			if(!\Yii::$app->user->isGuest)
				return $this->goHome();
			$model = new LoginForm();
			if($model->load(\Yii::$app->request->post()) && $model->login()){
				return $this->goBack();
			}
			return $this->render('login',['model'=>$model]);
				
		}
		
		public function actionLogout(){
			\Yii::$app->user->logout();
			return $this->goHome();
		}
		
		public function actionError(){
			$exception = \Yii::$app->errorHandler->exception;
			return $this->renderPartial('error',['exception'=>$exception]);
		}
		
	}