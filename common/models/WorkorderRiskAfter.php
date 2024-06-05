<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_risk_after".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property int|null $risk_id
 * @property float|null $risk_value
 * @property int|null $status
 * @property int|null $workorder_evaluate_id
 */
class WorkorderRiskAfter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_risk_after';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'risk_id', 'status', 'workorder_evaluate_id'], 'integer'],
            [['risk_value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workorder_id' => 'Workorder ID',
            'risk_id' => 'Risk ID',
            'risk_value' => 'Risk Value',
            'status' => 'Status',
            'workorder_evaluate_id' => 'Workorder Evaluate ID',
        ];
    }
}
