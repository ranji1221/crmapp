<?php
namespace Step\Acceptance;

class CRMUserSteps extends \AcceptanceTester
{
	function amInQueryCustomerUi(){
		$I = $this;
		$I->amOnPage('/customers/query');
	}

	function fillInPhoneFieldWithDataFrom($customer_data){
		$I = $this;
		$I->fillField(
			'PhoneForm[number]',
			$customer_data['PhoneForm[number]']
		);
	}

	function clickSearchButton(){
		$I = $this;
		$I->click('Search');
	}

	function seeIAmInListCustomerUi(){
		$I = $this;
		$I->seeCurrentUrlMatches('/customers');
	}

	function seeCustomerInList($customer_data){
		$I = $this;
		$I->see($customer_data['CustomerForm[name]'],'#search results');
	}

	function dontSeeCustomerInList($customer_data){
		$I = $this;
		$I->dontSee($customer_data['CustomerForm[name]'],'#search results');
	}
}