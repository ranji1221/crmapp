<?php
namespace Step\Acceptance;

class CRMOperatorSteps extends \AcceptanceTester
{	
	public function amInAddCustomerUi(){
		$I = $this;
		$I->amOnPage('/customers/add');
	}

	public function imagineCustomer(){
		$faker = \Faker\Factory::create();

		return [
			'CustomerForm[name]' => $faker->name,
			'CustomerForm[birth_date]' => $faker->date('Y-m-d'),
			'CustomerForm[notes]' => $faker->sentence(8),
			'PhoneForm[number]' => $faker->phoneNumber
		];
	}

	public function fillCustomerDataForm($fieldsData){
		$I = $this;
		foreach ($fieldsData as $key => $value)
			$I->fillField($key,$value);
	}

	public function submitCustomerDataForm(){
		$I = $this;
		$I->click('Submit');
	}

	public function seeIAmInListCustomersUi(){
		$I = $this;
		$I->seeCurrentUrlMatches('/customers/');
	}

	public function amInListCustomerUi(){
		$I = $this;
		$I->amOnPage('/customers');
	}
}