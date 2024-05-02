<?php

namespace backend\controllers;

use Yii;
use backend\models\Workorder;
use backend\models\WorkorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkorderController implements the CRUD actions for Workorder model.
 */
class WorkorderController extends Controller
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
     * Lists all Workorder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new WorkorderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Workorder model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Workorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Workorder();

        if ($model->load(Yii::$app->request->post())) {
            $w_date = date('Y-m-d');
            $xdate = explode('/',$model->workorder_date);
            if($xdate!=null){
                if(count($xdate)>1){
                    $w_date = $xdate[2].'/'.$xdate[1].'/'.$xdate[0].' '.date('H:i:s');
                }
            }


            $model->workorder_no = $model::getLastNo();
            $model->workorder_date = date('Y-m-d H:i:s',strtotime($w_date));
            $model->status = 1; // open init
            if($model->save(false)){
                $session = \Yii::$app->session;
                $session->setFlash('msg-success','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }
          //  return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Workorder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $work_created_by = \Yii::$app->request->post('work_created_by');
            $work_status = \Yii::$app->request->post('work_status');
            $w_date = date('Y-m-d');
            $xdate = explode('/',$model->workorder_date);
            if($xdate!=null){
                if(count($xdate)>1){
                    $w_date = $xdate[2].'/'.$xdate[1].'/'.$xdate[0];
                }
            }

            $model->workorder_date = date('Y-m-d',strtotime($w_date));
            $model->created_by = $work_created_by;
            $model->status = $work_status;
            if($model->save(false)){
                $session = \Yii::$app->session;
                $session->setFlash('msg-success','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Workorder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Workorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workorder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
