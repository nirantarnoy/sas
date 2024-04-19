<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_photo".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property string|null $photo
 * @property int|null $status
 */
class WorkorderPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'status'], 'integer'],
            [['photo'], 'string', 'max' => 255],
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
            'photo' => 'Photo',
            'status' => 'Status',
        ];
    }
}
