<?php 
	
	//-- $model相当于一个CutomerForm对象,再根据CustomerForm对象，拿到其所对应的PhoneForms对象数组
	$phoneForms = $model->phones;
	$phoneNumbers = '';		//-- 用于拼接phoneForms里面所包含的所有phoneFrom的number属性，形成字符串
	foreach ($phoneForms as $phoneForm){
		$phoneNumbers = $phoneNumbers . $phoneForm->number . ',';		
	}
	//echo substr($phonesNo, 0, strlen($phonesNo)-1);
	
	echo \yii\widgets\DetailView::widget([
			'model' => $model,
			'attributes' => [
					['attribute' => 'name','label'=>'姓名'],
					['attribute' => 'birth_date', 'label'=>'生日', 'value' => $model->birth_date->format('Y-m-d')],
					//'notes:text',
					['attribute' => 'notes','label' => '备注'],
					['attribute' => 'phones', 'label' => '电话', 'value' => /*$model->phones[0]->number*/substr($phoneNumbers, 0, strlen($phoneNumbers)-1) ],
			]
	]);