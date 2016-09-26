<?php 
$I = new Step\Acceptance\CRMUserSteps($scenario);
$I->wantTo('perform actions and see result');

$I->amOnPage('/site/docs');
$I->see('Documentation','h1');
$I->seeLargeBodyOfText();
