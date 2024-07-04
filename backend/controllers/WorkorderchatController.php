<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
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
                    'delete' => ['POST','GET'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
                },
                'rules'=>[
                    [
                        'allow'=>true,
                        'roles'=>['@'],
                        'matchCallback'=>function($rule,$action){
                            $currentRoute = \Yii::$app->controller->getRoute();
                            if(\Yii::$app->user->can($currentRoute)){
                                return true;
                            }
                        }
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionChat($id)
    {
        $user_id = \Yii::$app->user->identity->id;
        $model = null;
        $model_chat = null;
        if($id!=null || $id != ''){
            $model = \common\models\Workorder::find()->where(['id'=>$id])->one();
        }else{
            $model = \common\models\Workorder::find()->where(['id'=>$id])->one();
        }

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
       // $model = new \common\models\WorkorderChat();

        if($workorder_id != null && $user_id != null && $message != null){
            $photo = '';

//            $uploaded = \yii\web\UploadedFile::getInstanceByName('message-file');
//            if (!empty($uploaded)) {
//                $upfiles = "photo_".time() . "." . $uploaded->getExtension();
//                if ($uploaded->saveAs('uploads/chat_photo/' . $upfiles)) {
//                    $photo = $upfiles;
//                }
//
//            }
            if(isset($_FILES['message_file']) && $_FILES['message_file']['error'] ==0){
                $temp = explode(".", $_FILES["message_file"]["name"]);
                $new_filename = 'photo_'.time().'.'.$temp[1];
                $uploadDir = 'uploads/chat_photo/';

                if (move_uploaded_file($_FILES['message_file']['tmp_name'], $uploadDir . $new_filename)) {
                    $photo = $new_filename;
                }
            }

            $model_new = new \common\models\WorkorderChat();
            $model_new->workorder_id = $workorder_id;
            $model_new->created_by = $user_id;
            $model_new->message = $message;
            $model_new->message_date = date('Y-m-d H:i:s');
            $model_new->read_status = 0;
            $model_new->photo = $photo;
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
                    if($value->photo != null || $value->photo != ''){
                        $html .= '<div style="text-align: right;padding: 5px;"><div style="padding: 5px;font-size: 10px;">'.date('d-m-Y H:i:s',strtotime($value->message_date)).'</div><div style="margin-top:5px;"><span style="background-color: lightblue;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">'.$value->message.'</span></div><a href="'.\Yii::$app->getUrlManager()->baseUrl . '/uploads/chat_photo/'.$value->photo.'" target="_blank"><img src="'.\Yii::$app->getUrlManager()->baseUrl . '/uploads/chat_photo/'.$value->photo.'" alt="" style="width: 10%"></a></div></div>';
                    }else{
                        $html .= '<div style="text-align: right;padding: 5px;"><div style="padding: 5px;font-size: 10px;">'.date('d-m-Y H:i:s',strtotime($value->message_date)).'</div><div style="margin-top:5px;"><span style="background-color: lightblue;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">'.$value->message.'</span></div></div>';
                    }

                }else{
                    if($value->photo != null || $value->photo != ''){
                        $html .= '<div style="text-align: left;padding: 5px;"><div style="padding: 5px;font-size: 10px;">'.date('d-m-Y H:i:s',strtotime($value->message_date)).'</div><div style="margin-top:5px;"><span style="background-color: lightgrey;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">'.$value->message.'</span></div><a href="'.\Yii::$app->getUrlManager()->baseUrl . '/uploads/chat_photo/'.$value->photo.'" target="_blank"><img src="'.\Yii::$app->getUrlManager()->baseUrl . '/uploads/chat_photo/'.$value->photo.'" alt="" style="width: 10%"></a></div>';
                    }else{
                        $html .= '<div style="text-align: left;padding: 5px;"><div style="padding: 5px;font-size: 10px;">'.date('d-m-Y H:i:s',strtotime($value->message_date)).'</div><div style="margin-top:5px;"><span style="background-color: lightgrey;padding: 10px;border-top-left-radius: 10px;border-bottom-right-radius: 10px;">'.$value->message.'</span></div></div>';
                    }

                }

            }
        }
        return $html;
    }


}
