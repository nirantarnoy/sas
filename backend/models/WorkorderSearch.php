<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Workorder;

/**
 * WorkorderSearch represents the model behind the search form of `backend\models\Workorder`.
 */
class WorkorderSearch extends Workorder
{
    /**
     * {@inheritdoc}
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'asset_id', 'assign_emp_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['workorder_no', 'workorder_date', 'work_recieve_date', 'work_assign_date'], 'safe'],
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
        $query = Workorder::find();

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
            'workorder_date' => $this->workorder_date,
            'asset_id' => $this->asset_id,
            'assign_emp_id' => $this->assign_emp_id,
            'work_recieve_date' => $this->work_recieve_date,
            'work_assign_date' => $this->work_assign_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'workorder_no', $this->globalSearch]);

        return $dataProvider;
    }
}
