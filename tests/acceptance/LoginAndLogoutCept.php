<?php 
$I = new Step\Acceptance\CRMUsersManagementSteps($scenario);
$I->wantTo('chek that login and logout work');

$I->amGoingTo('Register new User');

$I->amInListUserUi();
$I->clickOnRegisterNewUserButton();
$I->seeIAmInAddUserUi();
$user = $I->imagineUser();
$I->fillUserDataForm($user);
$I->submitUserDataForm();