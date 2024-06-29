<?php

namespace backend\controllers;

use Yii;
use backend\models\Workorder;
use backend\models\WorkorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
            $xdate = explode('/', $model->workorder_date);
            if ($xdate != null) {
                if (count($xdate) > 1) {
                    $w_date = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0] . ' ' . date('H:i:s');
                }
            }

            $r_date = date('Y-m-d');
            $fr_date = explode('/', $model->work_recieve_date);
            if ($fr_date != null) {
                if (count($fr_date) > 1) {
                    $r_date = $fr_date[2] . '/' . $fr_date[1] . '/' . $fr_date[0] . ' ' . date('H:i:s');
                }
            }

            $as_date = date('Y-m-d');
            $fas_date = explode('/', $model->work_assign_date);
            if ($fas_date != null) {
                if (count($fas_date) > 1) {
                    $as_date = $fas_date[2] . '/' . $fas_date[1] . '/' . $fas_date[0] . ' ' . date('H:i:s');
                }
            }

//            print_r($as_date); return;


//            $work_created_by = \Yii::$app->request->post('work_created_by');
//            $work_status = \Yii::$app->request->post('work_status');

            $fac1 = \Yii::$app->request->post('factor_risk_1');
            $fac2 = \Yii::$app->request->post('factor_risk_2');
            $fac3 = \Yii::$app->request->post('factor_risk_3');
            $fac_total = \Yii::$app->request->post('factor_total');
            $fac_final = \Yii::$app->request->post('factor_final');


            $model->workorder_no = $model::getLastNo();
            $model->workorder_date = date('Y-m-d H:i:s', strtotime($w_date));
            $model->work_recieve_date = date('Y-m-d H:i:s', strtotime($r_date));
            $model->work_assign_date = date('Y-m-d H:i:s', strtotime($as_date));
            $model->status = 1; // open init
            $model->factor_risk_1 = $fac1;
            $model->factor_risk_2 = $fac2;
            $model->factor_risk_3 = $fac3;
            $model->factor_total = $fac_total;
            $model->factor_risk_final = $fac_final;
            if ($model->save(false)) {

                $uploaded = UploadedFile::getInstanceByName('work_photo');
                $uploaded2 = UploadedFile::getInstanceByName('work_video');

//                print_r($uploaded); return ;

                if (!empty($uploaded)) {
                    $upfiles = "photo_".time() . "." . $uploaded->getExtension();
                    if ($uploaded->saveAs('uploads/workorder_photo/' . $upfiles)) {
                        $model_photo = new \common\models\WorkorderPhoto();
                        $model_photo->workorder_id = $model->id;
                        $model_photo->photo = $upfiles;
                        $model_photo->save(false);
                    }

                }

                if (!empty($uploaded2)) {
                    $upfiles2 = "vdo_".time() . "." . $uploaded2->getExtension();
                    if ($uploaded2->saveAs('uploads/workorder_vdo/' . $upfiles2)) {
                        $model_vdo = new \common\models\WorkorderVdo();
                        $model_vdo->workorder_id = $model->id;
                        $model_vdo->file_name = $upfiles2;
                        $model_vdo->save(false);
                    }

                }
                $session = \Yii::$app->session;
                $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
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
        $work_photo = '';
        $work_vdo = '';
        $model_work_photo = \common\models\WorkorderPhoto::find()->select(['photo'])->where(['workorder_id'=>$id])->one();
        $model_work_vdo = \common\models\WorkorderVdo::find()->select(['file_name'])->where(['workorder_id'=>$id])->one();

        if($model_work_photo){
            $work_photo = $model_work_photo->photo;
        }
        if($model_work_vdo){
            $work_vdo = $model_work_vdo->file_name;
        }


        if ($model->load(Yii::$app->request->post())) {
            $work_created_by = \Yii::$app->request->post('work_created_by');
            $work_status = \Yii::$app->request->post('work_status');
            $work_old_photo = \Yii::$app->request->post('work_old_photo');
            $work_old_vdo = \Yii::$app->request->post('work_old_vdo');

            $fac1 = \Yii::$app->request->post('factor_risk_1');
            $fac2 = \Yii::$app->request->post('factor_risk_2');
            $fac3 = \Yii::$app->request->post('factor_risk_3');
            $fac_total = \Yii::$app->request->post('factor_total');
            $fac_final = \Yii::$app->request->post('factor_final');

            $old_date = \Yii::$app->request->post('old_date');

//            print_r($old_date
//            );return;

            $w_date = date('Y-m-d');
            $xdate = explode('/', $old_date);
            if ($xdate != null) {
                if (count($xdate) > 1) {
                    $w_date = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0] . ' ' . date('H:i:s');
                }
            }


            $r_date = date('Y-m-d');
            $fr_date = explode('/', $model->work_recieve_date);
            if ($fr_date != null) {
                if (count($fr_date) > 1) {
                    $r_date = $fr_date[2] . '/' . $fr_date[1] . '/' . $fr_date[0] . ' ' . date('H:i:s');
                }
            }
//            print_r($r_date
//            );return;

            $as_date = date('Y-m-d');
            $fas_date = explode('/', $model->work_assign_date);
            if ($fas_date != null) {
                if (count($fas_date) > 1) {
                    $as_date = $fas_date[2] . '/' . $fas_date[1] . '/' . $fas_date[0] . ' ' . date('H:i:s');
                }
            }




             $model->workorder_date = date('Y-m-d H:i:s',strtotime($w_date));

            $model->work_recieve_date = date('Y-m-d H:i:s', strtotime($r_date));
            $model->work_assign_date = date('Y-m-d H:i:s', strtotime($as_date));

            $model->created_by = $work_created_by;
            $model->status = $work_status;
            $model->factor_risk_1 = $fac1;
            $model->factor_risk_2 = $fac2;
            $model->factor_risk_3 = $fac3;
            $model->factor_total = $fac_total;
            $model->factor_risk_final = $fac_final;
            if ($model->save(false)) {
                $uploaded = UploadedFile::getInstanceByName('work_photo');
                $uploaded2 = UploadedFile::getInstanceByName('work_video');

                if (!empty($uploaded)) {
                    if(\common\models\WorkorderPhoto::deleteAll(['workorder_id'=>$model->id])){
                      unlink('uploads/workorder_photo/' .$work_old_photo);
                    }
                    $upfiles = "photo_".time() . "." . $uploaded->getExtension();
                    if ($uploaded->saveAs('uploads/workorder_photo/' . $upfiles)) {
                        $model_photo = new \common\models\WorkorderPhoto();
                        $model_photo->workorder_id = $model->id;
                        $model_photo->photo = $upfiles;
                        $model_photo->save(false);
                    }

                }

                if (!empty($uploaded2)) {
                    if(\common\models\WorkorderVdo::deleteAll(['workorder_id'=>$model->id])){
                        unlink('uploads/workorder_vdo/' .$work_old_vdo);
                    }
                    $upfiles2 = "vdo_".time() . "." . $uploaded2->getExtension();
                    if ($uploaded2->saveAs('uploads/workorder_vdo/' . $upfiles2)) {
                        $model_vdo = new \common\models\WorkorderVdo();
                        $model_vdo->workorder_id = $model->id;
                        $model_vdo->file_name = $upfiles2;
                        $model_vdo->save(false);
                    }

                }


                $session = \Yii::$app->session;
                $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'work_photo' => $work_photo,
            'work_vdo' => $work_vdo,
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
