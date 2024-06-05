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
