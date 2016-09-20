<?php
	namespace app\controllers;
	use yii\web\Controller;
	use app\models\customer\CustomerRecord;
	use app\models\customer\PhoneRecord;
	use app\models\customer\Customer;
	use app\models\customer\Phone;
						
	class CustomersController extends Controller{
		
		public function actionIndex(){
			//-- 1. 顾客数据
			$customer = new Customer('必然', strtotime('2016-09-10'));      //-- strtotime()返回的应该是个int
			$customer->notes = '这是个完人，没毛病';
			//-- 2. 顾客电话数据(两种写法)
			/* 
			 *第一种写法：那么 store()方法里的循环部分的代码就是：$phone_record->number = $phone->number; (属性)
			$p1 = new Phone();
			$p1->number = '170';
			$p2 = new Phone();
			$p2->number = '171';
			$p3 = new Phone();
			$p3->number = '172';
			$customer->phones = [$p1, $p2, $p3];
			*/
			//第二种写法：那么store()方法里的循环部分的代码就是：$phone_record->number = $phone['number'];  (数组下标的形式)
			$customer->phones = [
					['number'=>'188'],
					['number'=>'189'],
					['number'=>'190']
			];
			
			
			//-- 3. 存储顾客信息
			$this->store($customer);
			//-- 4. 打印信息
			$this->printCustomer(6);
		}
		/**
		 * 根据顾客信息存储顾客记录
		 * @param Customer $customer
		 */
		private function store(Customer $customer){
			//-- 1. 创建CustomerRecord对象
			$customer_record = new CustomerRecord();
			//-- 2. 给CustomerRecord对象赋值，这里唯一要注意的是日期类型的赋值
			//-- 切记我们拿到的customer的值是个整型，必须要转为日期
			$customer_record->name = $customer->name;
			$customer_record->birth_date =date('Y-m-d',$customer->birth_date);
			$customer_record->notes = $customer->notes;
			
			//-- 3. 存储CustomerRecord，并且存储相关的电话信息
			if($customer_record->save())
				foreach ($customer->phones as $phone){
						$phone_record = new PhoneRecord();
						//-- 注意这里的写法，如果你在构造customer->phones对象数组的时候，里面是new的phone对象，那么就
						//-- 写成$phone->number; 如果里面都是用的数组，那么就用现在的下标的访问方式$phone['number']
						$phone_record->number = $phone['number'];		
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