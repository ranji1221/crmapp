<?php
	namespace app\models\customer;
	use yii\db\ActiveRecord;
	/**
	 * 
	 * @author RanJi
	 *
	 */
	class Customer extends ActiveRecord{
		public static function tableName(){
			return 'customer';
		}
		
		public function rules(){
			return [
					['id','number'],
					['name','required'],
					['name','string', 'max' => 256],
					/**
					 * 这个时期类型，差点把人弄死。原来这个格式是有问题的，返回来看这个问题其实就是
					 * 先访问项目的crmapp/web/requirements.php文件夹，把里面的错误和Warning基本都要修复了。
					 * 否则，我这里的这个问题不是兰大神，就太难处理了。
					 * 其实，就是格式的问题, 如果写成“format=>Y-m-d”，其实用的是php的格式，那么yii2框架要求必须
					 * 加入扩展extension=php_intl.dll的国际化扩展，否则验证是通不过的。
					 * 如果不加入这个扩展，非要使用这种格式的话就写成：“format=>php:Y-m-d”即可。
					 * 如果上面两种都不想使用的话，那就用国际标准的格式，网上和书里给的例子都是不靠谱的。
					 * 国际标准的格式在yii\helpers\BaseFormatConverter.php里的有提示信息
					 * 例如：'format'=>'yyyy-MM-dd'
					 */
					['birth_date','date','format' => 'php:Y-m-d'],
					['notes','safe']
			];
		}
	}