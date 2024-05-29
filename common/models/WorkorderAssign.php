<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_assign".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property string|null $assign_date
 * @property string|null $assign_accept_date
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $status
 */
class WorkorderAssign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_assign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'status'], 'integer'],
            [['assign_date', 'assign_accept_date'], 'safe'],
            [['assign_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workorder_id' => 'ใบแจ้งซ๋อม',
            'assign_date' => 'วันที่จ่ายงาน',
            'assign_accept_date' => 'วันที่รับงาน',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status' => 'Status',
        ];
    }
}
