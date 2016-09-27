<?php

namespace app\models\user;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\user\User;

/**
 * UserSearch represents the model behind the search form about `app\models\user\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            ['username', 'safe'],   //-- 移除密码验证规则，因为我们要做身份认证
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username]);
            //->andFilterWhere(['like', 'password', $this->password]);   移除通过密码的过滤模糊查询

        return $dataProvider;
    }
}
