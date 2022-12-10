<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $plate_no
 * @property int|null $car_type_id
 * @property int|null $status
 * @property int|null $company_id
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Car extends \common\models\Car
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_type_id', 'status', 'company_id', 'created_at', 'created_by', 'updated_at', 'updated_by','type_id','fuel_type'], 'integer'],
            [['name', 'description', 'plate_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'description' => 'รายละเอียด',
            'plate_no' => 'ป้ายทะเบียน',
            'car_type_id' => 'ประเภทรถ',
            'type_id' => 'ส่วยเสริม',
            'fuel_type' => 'น้ำมัน',
            'status' => 'สถานะ',
            'company_id' => 'Company',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public static function findName($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        return $model != null ? $model->name : '';
    }
}
