<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company".
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
class Company extends \common\models\Company
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'description','doc'], 'string', 'max' => 255],
            [['social_deduct_per'],'safe']
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
            'social_deduct_per'=>'อัตราหักประกันสังคม (%)',
            'status' => 'สถานะ',
            'doc' => 'เอกสารแนบ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    public static function findCompanyName($id)
    {
        $model = Company::find()->where(['id' => $id])->one();
        return $model != null ? $model->name : '';
    }
    public static function findAddress($id)
    {
        $model = Company::find()->where(['id' => $id])->one();
        return $model != null ? $model->address : '';
    }

    public static function findCompanySocialPer($id)
    {
        $per = 0;
        $model = \common\models\SocialPerTrans::find()->where(['company_id' => $id,'month(trans_date)'=>date('m'),'year(trans_date)'=>date('Y')])->one();
        if($model != null){
            if($model->social_per != null){
                $per = $model->social_per;
            }
        }
        return $per;
//        $per = 0;
//        $model = Company::find()->where(['id' => $id])->one();
//        if($model != null){
//            if($model->social_deduct_per != null){
//             $per = $model->social_deduct_per;
//            }
//        }
//        return $per;
    }
}
