<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work_queue".
 *
 * @property int $id
 * @property string|null $work_queue_no
 * @property string|null $work_queue_date
 * @property int|null $customer_id
 * @property int|null $emp_assign
 * @property int|null $status
 * @property int|null $create_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class WorkQueue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_queue_date'], 'safe'],
            [['customer_id', 'emp_assign', 'status', 'create_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['work_queue_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_queue_no' => 'Work Queue No',
            'work_queue_date' => 'วันที่',
            'customer_id' => 'ลูกค้า',
            'emp_assign' => 'พนักงาน',
            'status' => 'สถานะ',
            'create_at' => 'Create At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
