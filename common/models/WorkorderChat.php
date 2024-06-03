<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_chat".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property string|null $message
 * @property int|null $created_by
 * @property string|null $message_date
 * @property int|null $read_status
 */
class WorkorderChat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'created_by', 'read_status'], 'integer'],
            [['message_date'], 'safe'],
            [['message','photo'], 'string', 'max' => 255],
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
            'message' => 'Message',
            'created_by' => 'Created By',
            'message_date' => 'Message Date',
            'read_status' => 'Read Status',
        ];
    }
}
