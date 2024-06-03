<?php

namespace backend\controllers;

use backend\models\CashrecordSearch;
use Yii;
use backend\models\Position;
use backend\models\PositionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PositionController implements the CRUD actions for Position model.
 */
class MyworkassignController extends Controller

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
     * Lists all Position models.
     * @return mixed
     */
    public function actionIndex()
    {
        $c_user = \Yii::$app->user->identity->id;
        $model = null;
        if($c_user){
            $model = \common\models\ViewEmpWorkAssign::find()->where(['emp_id' => $c_user])->all();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionAcceptworkorder(){
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $workorder_accept_type = \Yii::$app->request->post('workorder_accept_type');
        $workorder_reason = \Yii::$app->request->post('accept_workorder_reason');

        if($workorder_id && $workorder_accept_type){
            $model = \common\models\Workorder::find()->where(['id' => $workorder_id])->one();
            if($model){
                if($workorder_accept_type == 1){
                    $model->status = 2; // accept order
                }else if($workorder_accept_type == 0){
                    $model->status = 5; // accept order
                }
                $model->reason = $workorder_reason;
                $model->save(false);
            }

        }
        return $this->redirect(['myworkassign/index']);
    }

}
