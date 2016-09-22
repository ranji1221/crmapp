<?php
	namespace app\models\customer;
	
	use yii\base\Model;
	
	class PhoneForm extends Model{
		public $number;
		
		public function rules(){
			return [
					['number','required'],
			];
		}
	}