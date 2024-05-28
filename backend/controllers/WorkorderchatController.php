<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class WorkorderchatController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionChat($id)
    {
        $model = \common\models\Workorder::find()->where(['id'=>$id])->one();
        $model_chat = \common\models\WorkorderChat::find()->where(['workorder_id'=>$id])->all();
        return $this->render('_message', [
            'model'=> $model,
            'model_chat' => $model_chat,
        ]);
    }

    public function actionPostMessage()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $user_id = \Yii::$app->request->post('user_id');
        $message = \Yii::$app->request->post('message');
        $model = new \common\models\WorkorderChat();

        if($workorder_id != null && $user_id != null && $message != null){
            $model_new = new \common\models\WorkorderChat();
            $model_new->workorder_id = $workorder_id;
            $model_new->created_by = $user_id;
            $model_new->message = $message;
            $model_new->message_date = date('Y-m-d H:i:s');
            $model_new->read_status = 0;
            $model_new->save(false);
           // echo 'success';
        }else{
           // echo 'error';
        }
    }

    public function actionUpdateMessage()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $user_id = \Yii::$app->request->post('user_id');
        if($workorder_id != null && $user_id != null ){
           $model = \common\models\WorkorderChat::find()->where(['workorder_id' => $workorder_id,'read_status' => 0])->all();
           foreach($model as $value){
               if($user_id != $value->created_by){
                   $value->read_status = 1;
                   $value->save(false);
               }
           }
            echo 'success';
        }else{
            echo 'error';
        }
    }

    public function actionGetMessages(){
        $html = '';
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $user_id = \Yii::$app->request->post('user_id');
        $model = \common\models\WorkorderChat::find()->where(['workorder_id' => $workorder_id])->all();
        if($model){
            foreach ($model as $value) {
                if($user_id == $value->created_by){
                    $html .= '<div style="text-align: right;padding: 5px;"><div style="padding: 5px;font-size: 10px;">'.date('d-m-Y H:i:s',strtotime($value->message_date)).'</div><div style="margin-top:5px;"><span style="background-color: lightblue;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">'.$value->message.'</span></div></div>';
                }else{
                    $html .= '<div style="text-align: left;padding: 5px;"><div style="padding: 5px;font-size: 10px;">'.date('d-m-Y H:i:s',strtotime($value->message_date)).'</div><div style="margin-top:5px;"><span style="background-color: lightgrey;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">'.$value->message.'</span></div></div>';
                }

            }
        }
        echo $html;
    }


}
