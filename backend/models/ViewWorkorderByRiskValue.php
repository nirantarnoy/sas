<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "view_workorder_by_risk_value".
 *
 * @property int $id
 * @property string|null $workorder_no
 * @property string|null $workorder_date
 * @property int|null $asset_id
 * @property int|null $status
 * @property int|null $risk_id
 * @property float|null $risk_value
 */
class ViewWorkorderByRiskValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_workorder_by_risk_value';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'asset_id', 'status', 'risk_id'], 'integer'],
            [['workorder_date'], 'safe'],
            [['risk_value'], 'number'],
            [['workorder_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workorder_no' => 'Workorder No',
            'workorder_date' => 'Workorder Date',
            'asset_id' => 'Asset ID',
            'status' => 'Status',
            'risk_id' => 'Risk ID',
            'risk_value' => 'Risk Value',
        ];
    }
}
