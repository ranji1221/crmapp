<?php
	namespace app\models\customer;
	use yii\base\Model;
	
	class CustomerForm extends Model{
		
		public $name;
		public $birth_date;
		public $notes = '';
		public $phones = [];
		
		public function __construct($name, $birth_date){
			$this->name = $name;
			$this->birth_date = $birth_date;
		}
		
		public function  rules(){
			return [
					 [['name', 'birth_date','notes'], 'default', 'value' => null],
			];
		}
	}