<?php
namespace backend\models;
use common\models\USRNVALCANIZEASSIGNLINE;
use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');

class Workorder extends \common\models\Workorder
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
    public function findOrderNo($id){
        $model = Workorder::find()->where(['id'=>$id])->one();
        return $model!=null?$model->workorder_no:"";
    }

    public static function getLastNo()
    {
        //   $model = Orders::find()->MAX('order_no');
        $model = Workorder::find()->MAX('workorder_no');

        $pre = "WO";

        if ($model != null) {
//            $prefix = $pre.substr(date("Y"),2,2);
//            $cnum = substr((string)$model,4,strlen($model));
//            $len = strlen($cnum);
//            $clen = strlen($cnum + 1);
//            $loop = $len - $clen;
            $prefix = $pre . '-' . substr(date("Y"), 2, 2);
            $cnum = substr((string)$model, 5, strlen($model));
            $len = strlen($cnum);
            $clen = strlen($cnum + 1);
            $loop = $len - $clen;
            for ($i = 1; $i <= $loop; $i++) {
                $prefix .= "0";
            }
            $prefix .= $cnum + 1;
            return $prefix;
        } else {
            $prefix = $pre . '-' . substr(date("Y"), 2, 2);
            return $prefix . '00001';
        }
    }


}
