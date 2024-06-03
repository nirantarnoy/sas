<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_employee_data".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $fname
 * @property string|null $lname
 * @property int|null $department_id
 * @property string|null $department_name
 * @property int|null $gender
 * @property int|null $position_id
 * @property string|null $position_name
 * @property int|null $status
 * @property int|null $is_technician
 */
class ViewEmployeeData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_employee_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'gender', 'position_id', 'status', 'is_technician'], 'integer'],
            [['code', 'fname', 'lname', 'department_name', 'position_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'gender' => 'Gender',
            'position_id' => 'Position ID',
            'position_name' => 'Position Name',
            'status' => 'Status',
            'is_technician' => 'Is Technician',
        ];
    }
}
