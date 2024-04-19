<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Asset;

/**
 * AssetSearch represents the model behind the search form of `backend\models\Asset`.
 */
class AssetSearch extends Asset
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'asset_cat_id', 'department_id', 'location_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['asset_no', 'name', 'description', 'asset_brand_name', 'model_no', 'serail_no', 'supplier_name', 'supplier_contact', 'recieve_date', 'waranty_exp_date', 'electric_type', 'breaker_no', 'photo'], 'safe'],
            [['cost', 'watt'], 'number'],
            [['globalSearch'],'string'],
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
        $query = Asset::find();

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
            'asset_cat_id' => $this->asset_cat_id,
            'department_id' => $this->department_id,
            'location_id' => $this->location_id,
            'cost' => $this->cost,
            'recieve_date' => $this->recieve_date,
            'waranty_exp_date' => $this->waranty_exp_date,
            'watt' => $this->watt,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'asset_no', $this->globalSearch])
            ->andFilterWhere(['like', 'name', $this->globalSearch])
            ->andFilterWhere(['like', 'description', $this->globalSearch])
            ->andFilterWhere(['like', 'asset_brand_name', $this->globalSearch])
            ->andFilterWhere(['like', 'model_no', $this->globalSearch])
            ->andFilterWhere(['like', 'serail_no', $this->globalSearch])
            ->andFilterWhere(['like', 'supplier_name', $this->globalSearch])
            ->andFilterWhere(['like', 'supplier_contact', $this->globalSearch])
            ->andFilterWhere(['like', 'electric_type', $this->globalSearch])
            ->andFilterWhere(['like', 'breaker_no', $this->globalSearch])
            ->andFilterWhere(['like', 'photo', $this->globalSearch]);

        return $dataProvider;
    }
}
