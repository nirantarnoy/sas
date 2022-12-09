<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "address_info".
 *
 * @property int $id
 * @property int|null $party_type
 * @property int|null $party_id
 * @property string|null $address
 * @property string|null $street
 * @property int|null $district_id
 * @property int|null $city_id
 * @property int|null $province_id
 * @property string|null $zipcode
 * @property int|null $status
 */
class AddressInfo extends \common\models\AddressInfo
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['party_type', 'party_id', 'district_id', 'city_id', 'province_id', 'status'], 'integer'],
            [['address', 'street', 'zipcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'party_type' => 'Party Type',
            'party_id' => 'Party ID',
            'address' => 'Address',
            'street' => 'Street',
            'district_id' => 'District ID',
            'city_id' => 'City ID',
            'province_id' => 'Province ID',
            'zipcode' => 'Zipcode',
            'status' => 'Status',
        ];
    }

    public static function findDistrict($id)
    {
        $c_district = AddressInfo::find()->where(['party_id'=>$id])->one();
        $model = District::find()->where(['DISTRICT_ID' => $c_district->district_id])->one();
        return $model != null ? $model->DISTRICT_NAME : '';
    }

    public static function findAmphur($id)
    {
        $c_amphur = AddressInfo::find()->where(['party_id'=>$id])->one();
        $model = Amphur::find()->where(['AMPHUR_ID' => $c_amphur->city_id])->one();
        return $model != null ? $model->AMPHUR_NAME : '';
    }

    public static function findProvince($id)
    {
        $c_province = AddressInfo::find()->where(['party_id'=>$id])->one();
        $model = Province::find()->where(['PROVINCE_ID' => $c_province->province_id])->one();
        return $model != null ? $model->PROVINCE_NAME : '';
    }

    public static function findZipcode($id)
    {
        $model = AddressInfo::find()->where(['party_id'=>$id])->one();
        return $model != null ? $model->zipcode : '';
    }

    public static function findStreet($id)
    {
        $model = AddressInfo::find()->where(['party_id'=>$id])->one();
        return $model != null ? $model->street : '';
    }

    public static function findCustomerAddress($id)
    {
        $c_address = AddressInfo::find()->where(['party_id'=>$id])->one();
        $model = District::find()->where(['DISTRICT_ID' => $c_address->district_id])->one();
        $model_2 = Amphur::find()->where(['AMPHUR_ID' => $c_address->city_id])->one();
        $model_3 = Province::find()->where(['PROVINCE_ID' => $c_address->province_id])->one();
        return $model != null ? $model->DISTRICT_NAME .' '.$model_2->AMPHUR_NAME.' '.$model_3->PROVINCE_NAME : '';
    }
}
