<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');	   //-- 这个路径的基础是要看acceptance.suite.yml文件里的基础路径配置
$I->see('Our CRM');
