<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workassign_todo_list".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property int|null $workorder_assign_id
 * @property int|null $asset_id
 * @property int|null $todo_list_id
 * @property string|null $work_title
 * @property string|null $target_date
 * @property int|null $emp_id
 * @property int|null $status
 * @property string|null $remark
 */
class WorkassignTodoList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workassign_todo_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'workorder_assign_id', 'asset_id', 'todo_list_id', 'emp_id', 'status'], 'integer'],
            [['target_date'], 'safe'],
            [['work_title', 'remark'], 'string', 'max' => 255],
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
            'workorder_assign_id' => 'Workorder Assign ID',
            'asset_id' => 'Asset ID',
            'todo_list_id' => 'Todo List ID',
            'work_title' => 'Work Title',
            'target_date' => 'Target Date',
            'emp_id' => 'Emp ID',
            'status' => 'Status',
            'remark' => 'Remark',
        ];
    }
}
