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


}
