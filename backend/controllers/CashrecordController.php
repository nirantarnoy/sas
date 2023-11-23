<?php

namespace backend\controllers;

use backend\models\Cashrecord;
use backend\models\CashrecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CashrecordController implements the CRUD actions for Cashrecord model.
 */
class CashrecordController extends Controller
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
                        'delete' => ['POST', 'GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cashrecord models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new CashrecordSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Cashrecord model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cashrecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cashrecord();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $new_date = $model->trans_date . ' ' . date('H:i:s');

                $model->trans_date = date('Y-m-d H:i:s', strtotime($new_date));
                $model->journal_no = $model->getLastNo();


                $cost_title_id = \Yii::$app->request->post('cost_title_id');
                $amount = \Yii::$app->request->post('price_line');
                $remark = \Yii::$app->request->post('remark_line');
                $status = \Yii::$app->request->post('status');

                $model->status = $status;
                if ($model->save(false)) {
                    if ($cost_title_id != null) {
                        for ($i = 0; $i <= count($cost_title_id) - 1; $i++) {
                            $model_line = new \common\models\CashRecordLine();
                            $model_line->car_record_id = $model->id;
                            $model_line->cost_title_id = $cost_title_id[$i];
                            $model_line->amount = $amount[$i];
                            $model_line->remark = $remark[$i];
                            $model_line->status = 1;
                            $model_line->save(false);
                        }
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cashrecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_line = \common\models\CashRecordLine::find()->where(['car_record_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {

            $cost_title_id = \Yii::$app->request->post('cost_title_id');
            $amount = \Yii::$app->request->post('price_line');
            $remark = \Yii::$app->request->post('remark_line');
            $line_id = \Yii::$app->request->post('rec_id');

            $removelist = \Yii::$app->request->post('remove_list2');

            if ($model->save(false)) {
                if ($line_id != null) {
                    for ($i = 0; $i <= count($line_id) - 1; $i++) {
                        $model_chk = \common\models\CashRecordLine::find()->where(['id' => $line_id[$i]])->one();
                        if ($model_chk){
                            $model_chk->cost_title_id = $cost_title_id[$i];
                            $model_chk->amount = $amount[$i];
                            $model_chk->remark = $remark[$i];
                            $model_chk->save(false);
                        } else {
                            $model_rec = new \common\models\CashRecordLine();
                            $model_rec->car_record_id = $model->id;
                            $model_rec->cost_title_id = $cost_title_id[$i];
                            $model_rec->amount = $amount[$i];
                            $model_rec->remark = $remark[$i];
                            $model_rec->status = 1;
                            $model_rec->save(false);
                        }
                    }
                }
                $delete_rec = explode(",", $removelist);
                if (count($delete_rec)) {
                    \common\models\CashRecordLine::deleteAll(['id' => $delete_rec]);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Cashrecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cashrecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Cashrecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cashrecord::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionApprove($id)
    {
        if($id !=null){
            \backend\models\Cashrecord::updateAll(['status'=>2],['id'=>$id]);

        }
        return $this->redirect(['index']);
    }
}
