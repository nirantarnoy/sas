<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_emp_work_assign".
 *
 * @property int $assign_id
 * @property int|null $workorder_id
 * @property string|null $assign_date
 * @property string|null $assign_accept_date
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $status
 * @property string|null $assign_no
 * @property string|null $workorder_no
 * @property string|null $workorder_date
 * @property int|null $asset_id
 * @property int|null $workorder_status
 * @property string|null $code
 * @property string|null $fname
 * @property string|null $lname
 * @property int|null $position_name
 * @property string|null $name
 * @property string|null $asset_no
 * @property string|null $asset_name
 * @property int|null $emp_id
 */
class ViewEmpWorkAssign extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_emp_work_assign';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assign_id', 'workorder_id', 'created_at', 'created_by', 'status', 'asset_id', 'workorder_status', 'position_name', 'emp_id'], 'integer'],
            [['assign_date', 'assign_accept_date', 'workorder_date','work_estimate_finish_date'], 'safe'],
            [['assign_no', 'workorder_no', 'code', 'fname', 'lname', 'name', 'asset_no', 'asset_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'assign_id' => 'Assign ID',
            'workorder_id' => 'Workorder ID',
            'assign_date' => 'Assign Date',
            'assign_accept_date' => 'Assign Accept Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'status' => 'Status',
            'assign_no' => 'Assign No',
            'workorder_no' => 'Workorder No',
            'workorder_date' => 'Workorder Date',
            'asset_id' => 'Asset ID',
            'workorder_status' => 'Workorder Status',
            'code' => 'Code',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'position_name' => 'Position Name',
            'name' => 'Name',
            'asset_no' => 'Asset No',
            'asset_name' => 'Asset Name',
            'emp_id' => 'Emp ID',
        ];
    }
}
