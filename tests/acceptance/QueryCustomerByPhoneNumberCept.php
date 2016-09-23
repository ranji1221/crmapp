<?php

//-- 1. test add two customers
$I = new Step\Acceptance\CRMOperatorSteps($scenario);
$I->wantTo('add two different customers to database');
//-- add first customer
$I->amInAddCustomerUi();
$first_customer = $I->imagineCustomer();
$I->fillCustomerDataForm($first_customer);
$I->submitCustomerDataForm();

$I->seeIAmInListCustomersUi();

//-- add second customer
$I->amInAddCustomerUi();
$second_customer = $I->imagineCustomer();
$I->fillCustomerDataForm($second_customer);
$I->submitCustomerDataForm();

$I->seeIAmInListCustomersUi();

//-- 2. test query customer info by phonenumber
$I = new Step\Acceptance\CRMUserSteps($scenario);
$I->wantTo('query the customer info using his phone number');

$I->amInQueryCustomerUi();
$I->fillInPhoneFieldWithDataFrom($first_customer);
/*$I->clickSearchButton();

$I->seeIAmInListCustomerUi();
$I->seeCustomerInList($first_customer);
$I->dontSeeCustomerInList($second_customer);*/
