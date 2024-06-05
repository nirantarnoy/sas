<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_evaluate".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property string|null $trans_date
 * @property string|null $result
 * @property string|null $risk_code
 * @property int|null $evaluate_result
 * @property string|null $photo
 * @property int|null $created_at
 * @property int|null $created_by
 */
class WorkorderEvaluate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_evaluate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'evaluate_result', 'created_at', 'created_by'], 'integer'],
            [['trans_date'], 'safe'],
            [['result', 'risk_code', 'photo'], 'string', 'max' => 255],
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
            'trans_date' => 'Trans Date',
            'result' => 'Result',
            'risk_code' => 'Risk Code',
            'evaluate_result' => 'Evaluate Result',
            'photo' => 'Photo',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
