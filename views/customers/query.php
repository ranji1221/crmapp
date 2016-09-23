<?php
	use yii\helpers\Html;
	
	echo Html::beginForm('/customers','get');
	echo Html::label('Phone Number to Search:','phone_number');
	echo Html::textInput('phone_number');
	echo Html::submitButton('Search');
	echo Html::endForm();
?>