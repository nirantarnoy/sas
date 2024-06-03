<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asset_task_list".
 *
 * @property int $id
 * @property int|null $asset_id
 * @property int|null $seq_no
 * @property string|null $todo_name
 * @property string|null $todo_description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 */
class AssetTaskList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_task_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asset_id', 'seq_no', 'status', 'created_at', 'created_by'], 'integer'],
            [['todo_name', 'todo_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asset_id' => 'Asset ID',
            'seq_no' => 'Seq No',
            'todo_name' => 'Todo Name',
            'todo_description' => 'Todo Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
