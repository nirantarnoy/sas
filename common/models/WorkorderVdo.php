<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_vdo".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property string|null $file_name
 * @property int|null $status
 */
class WorkorderVdo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_vdo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'status'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
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
            'file_name' => 'File Name',
            'status' => 'Status',
        ];
    }
}
