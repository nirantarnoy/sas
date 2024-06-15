<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Todolist;

/**
 * TodolistSearch represents the model behind the search form of `backend\models\Todolist`.
 */
class TodolistSearch extends Todolist
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'assign_emp_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['todolist_no', 'trans_date', 'machine_name', 'machine_type_name', 'brand_name', 'todolist_name', 'target_date'], 'safe'],
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
        $query = Todolist::find();

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
            'trans_date' => $this->trans_date,
            'assign_emp_id' => $this->assign_emp_id,
            'target_date' => $this->target_date,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        if(!empty($this->globalSearch)){
            $query->orFilterWhere(['like', 'todolist_no', $this->globalSearch])
                ->orFilterWhere(['like', 'machine_name', $this->globalSearch])
                ->orFilterWhere(['like', 'machine_type_name', $this->globalSearch])
                ->orFilterWhere(['like', 'brand_name', $this->globalSearch])
                ->orFilterWhere(['like', 'todolist_name', $this->globalSearch]);
        }


        return $dataProvider;
    }
}
