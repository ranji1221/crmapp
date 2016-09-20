<?php
	namespace app\controllers;
	use yii\web\Controller;
	use app\models\customer\CustomerRecord;
	use app\models\customer\PhoneRecord;
	use app\models\customer\Customer;
	use app\models\customer\Phone;
						
	class CustomersController extends Controller{
		
		public function actionIndex(){
			$this->printCustomer(2);
		}
		
		private function store(Customer $customer){
			$customer_record = new CustomerRecord();
			$customer_record->name = $customer->name;
			$customer_record->birth_date = $customer->birth_date->format('Y-m-d');
			$customer_record->notes = $customer->notes;
			
			if($customer_record->save())
				foreach ($customer->phones as $phone){
						$phone_record = new PhoneRecord();
						$phone_record->number = $phone->number;
						$phone_record->customer_id =$customer_record->id;
						$phone_record->save();
				}
		}
		
		/**
		 * 根据CustomerRecord对象，构造Customer对象的方法
		 * @param CustomerRecord $customer_record
		 * @return \app\models\customer\Customer
		 */
		private function  makeCustomer(CustomerRecord $customer_record){
			//-- 1. 根据customerRecord的name、birth_date、notes属性值，构造customer对象的属性值
			$name = $customer_record->name;
			$birth_date = new \DateTime($customer_record->birth_date);
		
			$customer = new Customer($name,$birth_date);
			$customer->notes = $customer_record->notes;
			
			//-- 2. 根据customerRecord对象的id属性值查询出其相关联的phoneRecord对象集合（一对多）
			//-- 遍历其相关联的phoneRecrod，并把其赋予customer对象的phones属性
			$phone_records = PhoneRecord::findAll(['customer_id'=>$customer_record->id]);
			
			//-- 3. 目前研究的两种遍历的方式
			/*
			for ($i=0; $i<count($phone_records); $i++){
				$phone = new Phone;
				$phone->number =  $phone_records[$i]->number;
				$customer->phones[$i] =$phone;
			}*/
			
			foreach ($phone_records as $pr){
				$phone = new Phone;
				$phone->number = $pr->number;
				$customer->phones[] = $phone;
			}
			
			return $customer;
		}
		/**
		 * 打印一个customer对象，根据id
		 * @param unknown $id
		 */
		private function printCustomer($id){
			//-- 1. 根据id查询出CustomerRecord对象
			$customer_record = CustomerRecord::findOne(['id'=>$id]);
			//-- 2.把CustomerRecord对象转化为Customer对象 
			$customer = $this->makeCustomer($customer_record);
			//-- 3. 输出Customer对象属性
			echo 'customer = [<br/>' ;
			echo '&nbsp;&nbsp;name: ' . $customer->name . '<br/>';
			echo '&nbsp;&nbsp;birth: ' . $customer->birth_date->format('Y-m-d') . '<br/>';
			echo '&nbsp;&nbsp;phones: [<br/>';				
			foreach ($customer->phones as $phone)
				echo '&nbsp;&nbsp;&nbsp;&nbsp;number: ' . $phone->number . '<br/>';
			echo '&nbsp;&nbsp;]<br/>';
			echo ']<br/>';
		}
	}