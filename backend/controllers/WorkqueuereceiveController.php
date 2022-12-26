<?php

namespace backend\controllers;

use backend\models\Fuel;
use backend\models\FuelSearch;
use backend\models\WorkqueueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FuelController implements the CRUD actions for Fuel model.
 */
class WorkqueuereceiveController extends Controller
{

    public $enableCsrfValidation = false;

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Fuel models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user_id = \Yii::$app->user->id;
        $emp_id = \backend\models\User::findEmpId($user_id);
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new WorkqueueSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if($emp_id){
            $dataProvider->query->andFilterWhere(['emp_assign'=>$emp_id]);
        }


        $dataProvider->pagination->pageSize = $pageSize;

        $this->layout = 'main_login';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    public function actionView($id){
        $this->layout = 'main_login';
        return $this->render('_view',[
            'model' => null,
        ]);
    }



}
