<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dropoff_place".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class DropoffPlace extends \common\models\DropoffPlace
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dropoff_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by','hp'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['oil_rate_qty'],'safe']
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
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public static function getHp($id)
    {
        $model = DropoffPlace::find()->where(['id' => $id])->one();
        return $model != null ? $model->hp : '';
    }
    public static function getOilrate($id)
    {
        $model = DropoffPlace::find()->where(['id' => $id])->one();
        return $model != null ? $model->oil_rate_qty : '';
    }
}
