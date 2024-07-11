<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Workorderassignwork;

/**
 * WorkorderassignworkSearch represents the model behind the search form of `backend\models\Workorderassignwork`.
 */
class WorkorderassignworkSearch extends Workorderassignwork
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'asset_id', 'assign_emp_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'abnormal', 'view_point', 'work_cause_id', 'weak_point_analysis', 'cause_risk_id'], 'integer'],
            [['workorder_no', 'workorder_date', 'work_recieve_date', 'work_assign_date', 'problem_text', 'stop6', 'factor_risk_final'], 'safe'],
            [['factor_risk_1', 'factor_risk_2', 'factor_risk_3', 'factor_total'], 'number'],
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
        $query = Workorderassignwork::find();

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
//            'workorder_date' => $this->workorder_date,
            'asset_id' => $this->asset_id,
            'assign_emp_id' => $this->assign_emp_id,
            'work_recieve_date' => $this->work_recieve_date,
            'work_assign_date' => $this->work_assign_date,
//            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'abnormal' => $this->abnormal,
            'view_point' => $this->view_point,
            'work_cause_id' => $this->work_cause_id,
            'weak_point_analysis' => $this->weak_point_analysis,
            'cause_risk_id' => $this->cause_risk_id,
            'factor_risk_1' => $this->factor_risk_1,
            'factor_risk_2' => $this->factor_risk_2,
            'factor_risk_3' => $this->factor_risk_3,
            'factor_total' => $this->factor_total,
        ]);

        if ($this->workorder_date != null ){
            $x_date = explode('-', $this->workorder_date);
            if ($x_date != null ){
                if (count($x_date) > 1 ){
                    $f_date = $x_date[2] . '-' . $x_date[1] . '-' . $x_date[0];
                    $query->andFilterWhere(['like', 'workorder_date', date('Y-m-d',strtotime($f_date))]);
                }
            }
        }

        if($this->status != 6){
            $query->andFilterWhere(['status' => $this->status]);
        }

        $query->andFilterWhere(['like', 'workorder_no', $this->workorder_no])
            ->andFilterWhere(['like', 'problem_text', $this->problem_text])
            ->andFilterWhere(['like', 'stop6', $this->stop6])
            ->andFilterWhere(['like', 'factor_risk_final', $this->factor_risk_final]);

        return $dataProvider;
    }
}
