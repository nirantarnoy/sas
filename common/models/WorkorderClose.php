<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder_close".
 *
 * @property int $id
 * @property int|null $workorder_id
 * @property string|null $trans_date
 * @property int|null $cause_id
 * @property int|null $solve_id
 * @property float|null $labour_cost
 * @property float|null $spare_cost
 * @property string|null $time_use
 * @property string|null $preventive_text
 * @property string|null $photo
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class WorkorderClose extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder_close';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['workorder_id', 'cause_id', 'solve_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['trans_date'], 'safe'],
            [['labour_cost', 'spare_cost'], 'number'],
            [['time_use', 'preventive_text', 'photo'], 'string', 'max' => 255],
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
            'trans_date' => 'Trans Date',
            'cause_id' => 'Cause ID',
            'solve_id' => 'Solve ID',
            'labour_cost' => 'Labour Cost',
            'spare_cost' => 'Spare Cost',
            'time_use' => 'Time Use',
            'preventive_text' => 'Preventive Text',
            'photo' => 'Photo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
