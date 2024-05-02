<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asset".
 *
 * @property int $id
 * @property string|null $asset_no
 * @property string|null $name
 * @property string|null $description
 * @property int|null $asset_cat_id
 * @property string|null $asset_brand_name
 * @property string|null $model_no
 * @property string|null $serail_no
 * @property int|null $department_id
 * @property int|null $location_id
 * @property string|null $supplier_name
 * @property string|null $supplier_contact
 * @property float|null $cost
 * @property string|null $recieve_date
 * @property string|null $waranty_exp_date
 * @property float|null $watt
 * @property string|null $electric_type
 * @property string|null $breaker_no
 * @property string|null $photo
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Asset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asset_no','name'],'required'],
            [['asset_cat_id', 'department_id', 'location_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['cost', 'watt'], 'number'],
            [['recieve_date', 'waranty_exp_date'], 'safe'],
            [['asset_no', 'name', 'description', 'asset_brand_name', 'model_no', 'serail_no', 'supplier_name', 'supplier_contact', 'electric_type', 'breaker_no'], 'string', 'max' => 255],
            [['photo'],'file',
                'skipOnEmpty' => true,
                'maxFiles' => 4,
                'extensions' => 'png,jpg',
                'message' => 'เลือกไฟล์ได้สูงสุด 4 ไฟล์',],

           // [['asset_no'],'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asset_no' => 'รหัสเครื่องจักร',
            'name' => 'ชื่อเครื่องจักร',
            'description' => 'รายละเอียด',
            'asset_cat_id' => 'ประเภทเครื่องจักร',
            'asset_brand_name' => 'Asset Brand Name',
            'model_no' => 'Model No',
            'serail_no' => 'Serial No',
            'department_id' => 'แผนก',
            'location_id' => 'ที่ตั้งเครื่องจักร',
            'supplier_name' => 'Supplier Name',
            'supplier_contact' => 'Supplier Contact',
            'cost' => 'Cost',
            'recieve_date' => 'วันที่รับ',
            'waranty_exp_date' => 'วันที่หมดรับประกัน',
            'watt' => 'Watt',
            'electric_type' => 'Electric Type',
            'breaker_no' => 'Breaker No',
            'photo' => 'รูปภาพ',
            'status' => 'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
