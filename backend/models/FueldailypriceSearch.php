<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Fueldailyprice;

/**
 * FueldailypriceSearch represents the model behind the search form of `backend\models\Fueldailyprice`.
 */
class FueldailypriceSearch extends Fueldailyprice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'fuel_id', 'province_id', 'city_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['price_date'], 'safe'],
            [['price'], 'number'],
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
        $query = Fueldailyprice::find();

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
            'fuel_id' => $this->fuel_id,
            'province_id' => $this->province_id,
            'city_id' => $this->city_id,
            'price_date' => $this->price_date,
            'price' => $this->price,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
