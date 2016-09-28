<?php
	namespace Step\Acceptance;
	
	class CRMUsersManagementSteps extends \AcceptanceTester{
		function amInListUserUi(){
			$I = $this;
			$I->amOnPage('/users');
		}
		
		function clickOnRegisterNewUserButton(){
			$I = $this;
			$I->click('Create');
		}
		
		function seeIAmInAddUserUi(){
			$I = $this;
			$I->seeCurrentUrlEquals('/crmapp/web/users/create');
		}
		
		function imagineUser(){
			$faker = \Faker\Factory::create();
			
			return [
				'User[username]' => $faker->userName,
				'User[password]' => md5(time())
			];
		}
		
		function fillUserDataForm($fieldsData){
			$I = $this;
			foreach ($fieldsData as $key => $value)
				$I->fillField($key, $value);
		}
		
		function submitUserDataForm(){
			$I = $this;
			$I->click('button[type=submit]');
			
		}
	}