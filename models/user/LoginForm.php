<?php
	namespace app\models\user;
	
	use yii\base\Model;
	
	class LoginForm extends Model{
		
		public $username;
		public $password;
		public $rememberMe;
		
		/** @var app\models\user\User */
		public $user;
		
		public function rules(){
			return [
				[['username','password'],'required'],
				['rememberMe','boolean'],
				['password','validatePassword']
			];
		}
		
		public function validatePassword($attributeName){
			if($this->hasErrors()) return;
			
			$user = $this->getUser($this->username);
			if(!($user && $this->isCorrectHash($this->$attributeName,$user->password)))
				$this->addError($attributeName,'Incorrect username or password');				
		}
		
		private function getUser($username){
			if(!$this->user)
				$this->user = $this->fetchUser($username);
			return $this->user;
		}
		
		private function fetchUser($username){
			return User::findOne(['username'=>$username]);
		}
		
		private function isCorrectHash($plaintext,$hash){
			return \Yii::$app->security->validatePassword($plaintext, $hash);
		}
		
		public function login(){
			if(!$this->validate())return false;
			
			$user = $this->getUser($this->username);
			if(!$user) return false;
			
			//\Yii::$app->user->enableAutoLogin = true;
			return \Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
		}
	}