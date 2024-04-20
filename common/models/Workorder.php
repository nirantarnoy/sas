<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder".
 *
 * @property int $id
 * @property string|null $workorder_no
 * @property string|null $workorder_date
 * @property int|null $asset_id
 * @property int|null $assign_emp_id
 * @property string|null $work_recieve_date
 * @property string|null $work_assign_date
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Workorder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asset_id'],'required'],
            [['workorder_date', 'work_recieve_date', 'work_assign_date'], 'safe'],
            [['asset_id', 'assign_emp_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
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
            'workorder_no' => 'เลขที่ใบแจ้งซ่อม',
            'workorder_date' => 'วันที่',
            'asset_id' => 'เครื่องจักร',
            'assign_emp_id' => 'พนักงาน',
            'work_recieve_date' => 'Work Recieve Date',
            'work_assign_date' => 'Work Assign Date',
            'status' => 'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
