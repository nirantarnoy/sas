<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "todolist".
 *
 * @property int $id
 * @property string|null $todolist_no
 * @property string|null $trans_date
 * @property string|null $machine_name
 * @property string|null $machine_type_name
 * @property string|null $brand_name
 * @property string|null $todolist_name
 * @property int|null $assign_emp_id
 * @property string|null $target_date
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Todolist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todolist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date', 'target_date','act_date','end_date'], 'safe'],
            [['assign_emp_id', 'created_at', 'created_by', 'updated_at', 'updated_by','status'], 'integer'],
            [['todolist_no', 'machine_name', 'machine_type_name', 'brand_name', 'todolist_name'], 'string', 'max' => 255],
            [['remark'],'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'todolist_no' => 'เลขที่',
            'trans_date' => 'วันที่',
            'machine_name' => 'ชื่อเครื่อง',
            'machine_type_name' => 'ประเภท',
            'brand_name' => 'ยี่ห้อ',
            'todolist_name' => 'ชื่องาน',
            'assign_emp_id' => 'ผู้รับผิดชอบ',
            'target_date' => 'วันที่ต้องทำ',
            'act_date'=>'วันที่ดําเนินงาน',
            'end_date'=>'วันที่สิ้นสุดงาน',
            'remark'=>'หมายเหตุสำหรับปิดงาน Todo List',
            'status'=>'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
