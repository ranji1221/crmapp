<?php
	use yii\helpers\Html;
	
	echo Html::beginForm('/customers','get');
	echo Html::label('Phone Number to Search:','phone_number');
	echo Html::textInput('PhoneForm[number]');
	echo Html::submitButton('Search');
	echo Html::endForm();
?>