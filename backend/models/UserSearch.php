<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form of `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'usergroup_id', 'emp_ref_id'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'safe'],
            [['globalSearch'],'string']
        ];
    }

    /**
     * {@inheritdoc}
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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'usergroup_id' => $this->usergroup_id,
            'emp_ref_id' => $this->emp_ref_id,
        ]);

        $query->andFilterWhere(['like', 'username', $this->globalSearch])
            ->andFilterWhere(['like', 'auth_key', $this->globalSearch])
            ->andFilterWhere(['like', 'password_hash', $this->globalSearch])
            ->andFilterWhere(['like', 'password_reset_token', $this->globalSearch])
            ->andFilterWhere(['like', 'email', $this->globalSearch])
            ->andFilterWhere(['like', 'verification_token', $this->globalSearch]);

        return $dataProvider;
    }
}
