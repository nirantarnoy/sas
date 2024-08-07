<?php
namespace backend\models;
use common\models\USRNVALCANIZEASSIGNLINE;
use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');

class Workordercause extends \common\models\WorkorderCause
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

    public function findPersonNum($id){
        $model = \backend\models\User::find()->where(['id'=>$id])->one();
        return $model != null?$model->username:'';
        // return 'niran';
    }
//    public function findId($code){
//        $model = Costitem::find()->where(['name'=>$code])->one();
//        return count($model)>0?$model->id:0;
//    }
//    public function findCode($code){
//        $model = Vendor::find()->where(['name'=>$code])->one();
//        return count($model)>0?$model->name:"";
//    }

    public function findCauseName($id){
        $model = \common\models\WorkorderCauseTitle::find()->where(['id'=>$id])->one();
        return $model != null?$model->name:'';
        // return 'niran';
    }


}
