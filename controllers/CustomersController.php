<?php
	namespace app\controllers;
	use app\models\customer\CustomerForm;
	use app\models\customer\Customer;
	use app\models\customer\PhoneForm;
	use app\models\customer\Phone;
	use yii\web\Controller;
	/**
	 * 
	 * @author Administrator
	 *
	 */
	class CustomersController extends Controller{
		
		
		public function actionIndex(){
			//-- 重定向带参数的测试
			//echo \Yii::$app->request->get('customer')['name'];
			
			
			
		}
		
		
		//-- real user interface  (真正的用户接口，供用户访问用的)
		public function actionAdd(){
			//-- 1. 请求对象
			$request = \Yii::$app->request;
			
			//-- 2. 创建CustomerForm、PhoneForm表单模型对象
			$customerForm = new CustomerForm(null,null);
			$phoneForm = new PhoneForm();
			
			if($customerForm->load($request->post()) && $phoneForm->load($request->post())){
//echo $request->post('CustomerForm')['name'];
//echo $request->post('CustomerForm')['birth_date'];
//echo $request->post('CustomerForm')['notes'];
//echo $request->post('PhoneForm')['number'];
//-- 终于测试成功，就是customerFomr、phoneForm类必须有rules()方法，否则调用load()方法不会赋值，不知道哪里能设置吗？这不太合理			
//echo $customerForm->name . '<br/>';			
//echo $customerForm->birth_date .' <br/>';
//echo $customerForm->notes . '<br/>';
			
//echo $phoneForm->number . '<br/>';

				//-- 3. 顾客和电话信息存储
				if($customerForm->validate() && $phoneForm->validate()){
					$customerForm->phones = [$phoneForm] ;	
					$this->store($customerForm);
					//-- 重定向带参数
					//return $this->redirect(['/customers','customer'=>$customerForm]);
					//-- 重定向不带参数
					return $this->redirect('/customers');
				}
				
			}
			
			return $this->render('add',['customer'=>$customerForm, 'phone'=>$phoneForm]);
		}
		
		
		
		//-- yii2默认访问驼峰的action是加的中划线，而且每个单词都要小写，真尼玛别扭
		//-- 不过后面可以通过设置route改变 
		public function actionAddMyCustomer(){
			//-- 中划线、中划线、中划线，重要的事情说三遍
			return '测试action的id为驼峰标识时的访问路径问题: hostname/crmapp/index.php?r=customers/add-my-customer';
		}
		
		public function actionTest(){
			//-- 1. 顾客数据
			$customerForm = new CustomerForm('故否', '2016-09-10');  
			$customerForm->notes = '这是个完人，没毛病';
			
			//-- 2. 顾客电话数据(两种写法)
		
			 //第一种写法：那么 store()方法里的循环部分的代码就是：$phone->number = $phoneForm->number; (属性)
			$p1 = new PhoneForm();
			$p1->number = '170';
			$p2 = new PhoneForm();
			$p2->number = '171';
			$p3 = new PhoneForm();
			$p3->number = '172';
			$customerForm->phones = [$p1, $p2, $p3];
			
			//第二种写法：那么store()方法里的循环部分的代码就是：$phone->number = $phoneForm['number'];  (数组下标的形式)
			/*
			$customer->phones = [
					['number'=>'188'],
					['number'=>'189'],
					['number'=>'190']
			];
			*/
			
			//-- 3. 存储顾客信息
			$this->store($customerForm);
			//-- 4. 打印信息
			$this->printCustomer(3);
		}
		/**
		 * 根据顾客信息存储顾客记录
		 * @param $customerForm
		 */
		private function store($customerForm){
			//-- 1. 创建Customer对象
			$customer = new Customer();
			//-- 2. 给Customer对象赋值，这里唯一要注意的是日期类型的赋值
			//-- 切记我们拿到的customer的值是个整型，必须要转为日期
			$customer->name = $customerForm->name;
			//-- 因为底层数据库是date型，所以这里必须是date，先把字符串转为时间的int，再构造date 
			$customer->birth_date = date('Y-m-d', strtotime($customerForm->birth_date));
			$customer->notes = $customerForm->notes;
			
			//-- 3. 存储Customer，并且存储相关的电话信息
			if($customer->save())
				foreach ($customerForm->phones as $phoneForm){
						$phone = new Phone();
						//-- 注意这里的写法，如果你在构造customer->phones对象数组的时候，里面是new的phone对象，那么就
						//-- 写成$phone->number; 如果里面都是用的数组，那么就用下标的访问方式$phone['number']
						$phone->number = $phoneForm->number;		
						$phone->customer_id =$customer->id;
						$phone->save();
				}
		}
		
		/**
		 * 根据Customer对象，构造Customer对象的方法
		 * @param $customer
		 * @return \app\models\customer\CustomerForm
		 */
		private function  makeCustomerFormObject($customer){
			//-- 1. 根据Customer的name、birth_date、notes属性值，构造customer对象的属性值
			$name = $customer->name;
			$birth_date = new \DateTime($customer->birth_date);
		
			$customerForm = new CustomerForm($name,$birth_date);
			$customerForm->notes = $customer->notes;
			
			//-- 2. 根据Customer对象的id属性值查询出其相关联的Phone对象集合（一对多）
			//-- 遍历其相关联的phoneRecrod，并把其赋予customer对象的phones属性
			$phones = Phone::findAll(['customer_id'=>$customer->id]);
			
			//-- 3. 目前研究的两种遍历的方式
			/*
			for ($i=0; $i<count($phone_records); $i++){
				$phone = new Phone;
				$phone->number =  $phone_records[$i]->number;
				$customer->phones[$i] =$phone;
			}*/
			
			foreach ($phones as $phone){
				$phoneForm = new PhoneForm;
				$phoneForm->number = $phone->number;
				$customerForm->phones[] = $phoneForm;
			}
			
			return $customerForm;
		}
		/**
		 * 打印一个customer对象，根据id
		 * @param unknown $id
		 */
		private function printCustomer($id){
			//-- 1. 根据id查询出Customer对象
			$customer = Customer::findOne(['id'=>$id]);
			//-- 2.把Customer对象转化为customerForm对象
			if($customer!=null){
				$customerForm = $this->makeCustomerFormObject($customer);
				//-- 3. 输出Customer对象属性
				echo 'customer = [<br/>' ;
				echo '&nbsp;&nbsp;name: ' . $customerForm->name . '<br/>';
				echo '&nbsp;&nbsp;birth: ' . $customerForm->birth_date->format('Y-m-d') . '<br/>';
				echo '&nbsp;&nbsp;phones: [<br/>';				
				foreach ($customerForm->phones as $phone)
					echo '&nbsp;&nbsp;&nbsp;&nbsp;number: ' . $phone->number . '<br/>';
				echo '&nbsp;&nbsp;]<br/>';
				echo ']<br/>';
			}
		}
	}