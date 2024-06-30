<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_todolist_emp".
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
 * @property int|null $status
 * @property string|null $act_date
 * @property string|null $end_date
 * @property int|null $emp_id
 * @property int|null $line_status
 */
class ViewTodolistEmp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_todolist_emp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'assign_emp_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status', 'emp_id', 'line_status'], 'integer'],
            [['trans_date', 'target_date', 'act_date', 'end_date'], 'safe'],
            [['todolist_no', 'machine_name', 'machine_type_name', 'brand_name', 'todolist_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'todolist_no' => 'Todolist No',
            'trans_date' => 'Trans Date',
            'machine_name' => 'Machine Name',
            'machine_type_name' => 'Machine Type Name',
            'brand_name' => 'Brand Name',
            'todolist_name' => 'Todolist Name',
            'assign_emp_id' => 'Assign Emp ID',
            'target_date' => 'Target Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status' => 'Status',
            'act_date' => 'Act Date',
            'end_date' => 'End Date',
            'emp_id' => 'Emp ID',
            'line_status' => 'Line Status',
        ];
    }
}
