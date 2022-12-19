<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "route_plan".
 *
 * @property int $id
 * @property string|null $des_name
 * @property int|null $des_province_id
 * @property float|null $total_distanct
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class RoutePlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_province_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['total_distanct'], 'number'],
            [['des_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'des_name' => 'Des Name',
            'des_province_id' => 'Des Province ID',
            'total_distanct' => 'Total Distanct',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
