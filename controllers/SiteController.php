<?php
	namespace app\controllers;
	use \yii\web\Controller;

	class SiteController extends Controller{
		public function actionIndex(){
			var_dump(\Yii::$app->log->traceLevel);
			aaaa;
			return 'Our CRM';
		}
	}