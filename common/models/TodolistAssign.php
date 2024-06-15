<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "todolist_assign".
 *
 * @property int $id
 * @property int|null $todolist_id
 * @property int|null $emp_id
 * @property int|null $status
 * @property string|null $remark
 */
class TodolistAssign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todolist_assign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['todolist_id', 'emp_id', 'status'], 'integer'],
            [['remark'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'todolist_id' => 'Todolist ID',
            'emp_id' => 'Emp ID',
            'status' => 'Status',
            'remark' => 'Remark',
        ];
    }
}
