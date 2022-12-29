<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work_queue".
 *
 * @property int $id
 * @property string|null $work_queue_no
 * @property string|null $work_queue_date
 * @property int|null $customer_id
 * @property int|null $emp_assign
 * @property int|null $status
 * @property int|null $create_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class WorkQueue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_queue_date'], 'safe'],
            [['customer_id', 'emp_assign', 'status', 'create_at', 'created_by', 'updated_at', 'updated_by','route_plan_id','tail_id','car_id','tail_back_id','approve_status','approve_by'], 'integer'],
            [['work_queue_no','go_deduct_reason','back_reason'], 'string', 'max' => 255],
            [['weight_on_go','weight_on_back','weight_go_deduct','back_deduct'], 'double'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_queue_no' => 'คิวงานเลขที่',
            'work_queue_date' => 'วันที่',
            'customer_id' => 'ลูกค้า',
            'emp_assign' => 'พนักงาน',
            'status' => 'สถานะ',
            'route_plan_id' => 'ปลายทาง',
            'car_id' => 'รถ',
            'tail_id' => 'พ่วง',
            'weight_on_go' => 'น้ำหนักเที่ยวไป',
            'weight_on_back' => 'น้ำหนักเที่ยวกลับ',
            'weight_go_deduct' => 'หักขาไป',
            'back_deduct' => 'หักขากลับ',
            'go_deduct_reason' => 'เหตุผลขาไป',
            'back_reason' => 'เหตุผลขากลับ',
            'tail_back_id' => 'ส่วนพ่วงขากลับ',
            'approve_status' => 'อนุมัติ',
            'approve_by'=>'ผู้อนุมัติ',
            'create_at' => 'Create At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
