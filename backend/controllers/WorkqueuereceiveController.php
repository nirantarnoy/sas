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
           // $dataProvider->query->andFilterWhere(['emp_assign'=>$emp_id]);
        }

        $dataProvider->pagination->pageSize = $pageSize;

        $this->layout = 'main_login';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
            'emp_id' => $emp_id,

        ]);
    }

    public function actionView($id){
        $this->layout = 'main_login';
//        return $this->render('_view',[
//            'model' => null,
//        ]);

        if ($id) {
            $model = \backend\models\Workqueue::find()->where(['id' => $id])->one();
            $modelline = \common\models\WorkQueueLine::find()->where(['work_queue_id' => $id])->all();
            return $this->render('_view', [
                'model' => $model,
                'modelline' => $modelline,
            ]);
        }
    }

    public function actionEditprofile($id){
        $emp_id = $id;
        $emp_data = null;
        if($emp_id != ''){
            $emp_data = \backend\models\Employee::find()->where(['id'=>$emp_id])->one();
        }
        $this->layout = 'main_login';
        if($emp_data != null){
            return $this->render('_editprofile',[
                'model'=>$emp_data,
            ]);
        }else{
            return $this->redirect(['workqueuereceive/index']);
        }
    }

    public function actionUpdateprofile(){
        $emp_id = \Yii::$app->request->post('emp_id');
        $emp_phone = \Yii::$app->request->post('emp_phone');
    }



}
