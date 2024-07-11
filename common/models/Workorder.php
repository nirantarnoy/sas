<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder".
 *
 * @property int $id
 * @property string|null $workorder_no
 * @property string|null $workorder_date
 * @property int|null $asset_id
 * @property int|null $assign_emp_id
 * @property string|null $work_recieve_date
 * @property string|null $work_assign_date
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Workorder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asset_id'],'required'],
            [['workorder_date', 'work_recieve_date', 'work_assign_date','work_estimate_finish_date','work_asset_location_id'], 'safe'],
            [['asset_id', 'assign_emp_id', 'status', 'created_at', 'updated_at', 'updated_by','abnormal','view_point','work_cause_id','weak_point_analysis','cause_risk_id'], 'integer'],
            [['workorder_no','reason'], 'string', 'max' => 255],
            [['factor_risk_1','factor_risk_2','factor_risk_3','factor_total'],'number'],
            [['created_by','problem_text','stop6','factor_final_risk'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'workorder_no' => 'เลขที่ใบแจ้งซ่อม',
            'workorder_date' => 'วันที่',
            'asset_id' => 'เครื่องจักร',
            'assign_emp_id' => 'พนักงาน',
            'work_recieve_date' => 'วันที่รับงาน',
            'work_assign_date' => 'วันที่มอบหมายงาน',
            'problem_text' => 'ปัญหา',
            'status' => 'สถานะ',
            'stop6'=> 'STOP6',
            'abnormal'=> 'Abnormal',
            'view_point'=> 'View Point/4s',
            'work_cause_id'=> 'Cause',
            'weak_point_analysis'=> 'Weak point analysis',
            'cause_risk_id'=> 'สาเหตุของอันตราย',
            'work_estimate_finish_date'=> 'วันที่คาดว่าจะซ่อมเสร็จ',
            'reason'=> 'หมายเหตุ',
            'work_asset_location_id'=> 'สถานที่',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
