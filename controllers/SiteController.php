<?php
	namespace app\controllers;
	use \yii\web\Controller;

	class SiteController extends Controller{
		public function actionIndex(){
			var_dump(\Yii::$app->log->traceLevel);
			//aaaa;
			return 'Our CRM';
		}
		
		public function actionDocs(){
			//return '<h1>Documentation</h1>';
			return $this->render('docindex.md');
		}
	}