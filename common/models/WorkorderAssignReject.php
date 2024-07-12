<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_assign_reject".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property string|null $trans_date
 * @property int|null $emp_id
 * @property string|null $reason
 */
class WorkorderAssignReject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_assign_reject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'emp_id'], 'integer'],
            [['trans_date'], 'safe'],
            [['reason'], 'string', 'max' => 255],
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
            'emp_id' => 'Emp ID',
            'reason' => 'Reason',
        ];
    }
}
