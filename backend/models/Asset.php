<?php
namespace backend\models;
use common\models\USRNVALCANIZEASSIGNLINE;
use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');

class Asset extends \common\models\Asset
{
    public function behaviors()
    {
        return [
            'timestampcdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_at',
                ],
                'value'=> time(),
            ],
            'timestampudate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'updated_at',
                ],
                'value'=> time(),
            ],
            'timestampcby'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_by',
                ],
                'value'=> Yii::$app->user->identity->id,
            ],
            'timestamuby'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_by',
                ],
                'value'=> Yii::$app->user->identity->id,
            ],
            'timestampupdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_at',
                ],
                'value'=> time(),
            ],
        ];
    }

    public function findName($id){
        $model = \backend\models\Asset::find()->where(['id'=>$id])->one();
        return $model != null?$model->name:'';
        // return 'niran';
    }
    public function findAssetCatName($id){
        $cat_name = '';
        $model = \backend\models\Asset::find()->where(['id'=>$id])->one();
        if($model){
            $cat_model = \backend\models\Assetcategory::find()->select(['name'])->where(['id'=>$model->asset_cat_id])->one();
            if($cat_model){
                $cat_name = $cat_model->name;
            }
        }
        return $cat_name;
    }
    public function findAssetSerialNo($id){
        $model = \backend\models\Asset::find()->where(['id'=>$id])->one();
        return $model != null?$model->serail_no:'';
        // return 'niran';
    }
    public function findAssetBrand($id){
        $model = \backend\models\Asset::find()->where(['id'=>$id])->one();
        return $model != null?$model->asset_brand_name:'';
        // return 'niran';
    }
    public function findAssetmodel($id){
        $model = \backend\models\Asset::find()->where(['id'=>$id])->one();
        return $model != null?$model->model_no:'';
        // return 'niran';
    }
    public function findLocationName($id){
        $loc_name = '';
        $model = \backend\models\Asset::find()->where(['id'=>$id])->one();
        if($model){
            $loc_model = \backend\models\Location::find()->select(['name'])->where(['id'=>$model->location_id])->one();
            if($loc_model){
                $loc_name = $loc_model->name;
            }
        }
        return $loc_name;
    }
    public function findDeptName($id){
        $loc_name = '';
        $model = \backend\models\Asset::find()->where(['id'=>$id])->one();
        if($model){
            $loc_model = \backend\models\Department::find()->select(['name'])->where(['id'=>$model->department_id])->one();
            if($loc_model){
                $loc_name = $loc_model->name;
            }
        }
        return $loc_name;
    }
//    public function findId($code){
//        $model = Costitem::find()->where(['name'=>$code])->one();
//        return count($model)>0?$model->id:0;
//    }
//    public function findCode($code){
//        $model = Vendor::find()->where(['name'=>$code])->one();
//        return count($model)>0?$model->name:"";
//    }


}
