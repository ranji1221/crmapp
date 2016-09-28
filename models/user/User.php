<?php

namespace app\models\user;

use Yii;

use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

/**
 * This is the model class for table "user".
 *
 * 为了实现用户登录的校验login/logout，则必须实现yii\web\IdentityInterface
 * 并重写接口的方法
 * @property integer $id
 * @property string $username
 * @property string $password
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface {
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
            [['username', 'password','authKey'], 'string', 'max' => 255],		//-- 加入authKey属性
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
    	
    	//-- 2. 给authKey属性赋值（为了“Remember Me”功能的实现） 	
    	if($this->isNewRecord){
    		//-- 该方法产生的是调用php自带的random_bytes()的二进制数据，必须用bin2hex()方法进行转换为字符串
    		//-- 但有个问题，假如generateRandomKey(255) 转换后的长度就不定是多少了，我测试的结果是510
    		//-- 所以不建议用这个方法，用generateRandowStirng()方法感觉更好
    		$this->authKey = \Yii::$app->security->generateRandomString(255);
    	}
    		
    	//-- 3. 必须接着调用父类的方法
    	return parent::beforeSave($insert);
    }
    
    //-- 第一：重写接口中的方法
    //-- getId()和findIdentity($id)是为了login()和logout()方法服务的
    public function getId(){
		return $this->id;
    }
    public static function findIdentity($id){
    	return static::findOne($id);
	}
	
	//-- 第二：我们熟知的“Remember Me”的功能是依靠重写接口中的以下两个方法来实现的
	public function getAuthKey(){
		return $this->authKey;
	}
	public function validateAuthKey($authKey){
		return $this->authKey === $authKey;
	}
	
	//-- 第三： Token认证
	public static function findIdentityByAccessToken($token, $type = null){
		//--暂时不考虑令牌的问题，只考虑用户名和密码的认证，所以该方法暂时不实现
		throw new NotSupportedException('You can only login by username/password pair for now.');
	}
	
}
