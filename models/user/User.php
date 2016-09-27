<?php

namespace app\models\user;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['username', 'password'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }
    
    public function beforeSave($insert){
    	//-- 1. 对密码属性进行Hash加密 (加if是因为只有当密码属性被更改的时候才更新密码或者加密，而仅仅是更新别的属性就不更新密码了。)
    	if($this->isAttributeChanged('password'))
    		$this->password = \Yii::$app->security->generatePasswordHash($this->password);
    	
    	//-- 2. 必须接着调用父类的方法
    	return parent::beforeSave($insert);
    }
}
