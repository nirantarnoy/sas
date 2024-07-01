<?php

namespace backend\controllers;

use backend\models\CashrecordSearch;
use Yii;
use backend\models\Position;
use backend\models\PositionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PositionController implements the CRUD actions for Position model.
 */
class WorkorderreportController extends Controller

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
     * Lists all Position models.
     * @return mixed
     */
    public function actionIndex()
    {
        $from_date = \Yii::$app->request->post('from_date');
        $to_date = \Yii::$app->request->post('to_date');
        $c_user = \Yii::$app->user->id;
        $model = null;
        if ($c_user) {
            $model = \common\models\ViewEmpWorkAssign::find()->where(['emp_id' => $c_user])->all();
        }

        return $this->render('index', [
            'model' => $model,
            'from_date' => $from_date,
            'to_date' => $to_date,
        ]);
    }


}
