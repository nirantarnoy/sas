<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_assign_line".
 *
 * @property int $id
 * @property int|null $workorder_assign_id
 * @property int|null $emp_id
 * @property string|null $emp_message
 */
class WorkorderAssignLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_assign_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_assign_id', 'emp_id'], 'integer'],
            [['emp_message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workorder_assign_id' => 'Workorder Assign ID',
            'emp_id' => 'Emp ID',
            'emp_message' => 'Emp Message',
        ];
    }
}
