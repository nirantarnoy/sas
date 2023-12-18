<?php

namespace backend\controllers;

use backend\models\PositionSearch;
use backend\models\Preinvoice;
use backend\models\PreinvoiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PreinvoiceController implements the CRUD actions for Preinvoice model.
 */
class PreinvoiceController extends Controller
{
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
     * Lists all Preinvoice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $viewstatus = 1;

        if(\Yii::$app->request->get('viewstatus')!=null){
            $viewstatus = \Yii::$app->request->get('viewstatus');
        }

        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new PreinvoiceSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        if($viewstatus ==1){
            $dataProvider->query->andFilterWhere(['status'=>$viewstatus]);
        }
        if($viewstatus == 2){
            $dataProvider->query->andFilterWhere(['status'=>0]);
        }

        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
            'viewstatus'=>$viewstatus,
        ]);
    }

    /**
     * Displays a single Preinvoice model.
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
     * Creates a new Preinvoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Preinvoice();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $line_work_id = \Yii::$app->request->post('line_work_queue_id');
                $line_work_amount = \Yii::$app->request->post('line_work_queue_amount');
                $all_total = \Yii::$app->request->post('all_total');

                $invoice_from_date = date('Y-m-d');
                $invoice_to_date = date('Y-m-d');
                $x = explode('-', $model->from_date);
                if (count($x) > 1) {
                    $invoice_from_date = $x[2] . '/' . $x[1] . '/' . $x[0];
                }
                $y = explode('-', $model->to_date);
                if (count($y) > 1) {
                    $invoice_to_date = $y[2] . '/' . $y[1] . '/' . $y[0];
                }
                $model->journal_date = date('Y-m-d');
                $model->from_date = date('Y-m-d', strtotime($invoice_from_date));
                $model->to_date = date('Y-m-d', strtotime($invoice_to_date));
                $model->journal_no = Preinvoice::getLastNo();
                $model->status = 1;
                $model->total_amount= $all_total;
                if($model->save()){
                    if($line_work_id !=null){
                        for($i=0;$i<=count($line_work_id)-1;$i++){
                            $model_line = new \common\models\PreinvoiceLine();
                            $model_line->preinvoice_id = $model->id;
                            $model_line->work_queue_id = $line_work_id[$i];
                            $model_line->total_amount = $line_work_amount[$i];
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
     * Updates an existing Preinvoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\PreinvoiceLine::find()->where(['preinvoice_id'=>$id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $line_rec_id = \Yii::$app->request->post('line_rec_id');
            $line_work_id = \Yii::$app->request->post('line_work_queue_id');
            $line_work_amount = \Yii::$app->request->post('line_work_queue_amount');
            $removelist = \Yii::$app->request->post('removelist');
            $all_total = \Yii::$app->request->post('all_total');

            $invoice_from_date = date('Y-m-d');
            $invoice_to_date = date('Y-m-d');
            $x = explode('-', $model->from_date);
            if (count($x) > 1) {
                $invoice_from_date = $x[2] . '/' . $x[1] . '/' . $x[0];
            }
            $y = explode('-', $model->to_date);
            if (count($y) > 1) {
                $invoice_to_date = $y[2] . '/' . $y[1] . '/' . $y[0];
            }
           // $model->journal_date = date('Y-m-d');
            $model->from_date = date('Y-m-d', strtotime($invoice_from_date));
            $model->to_date = date('Y-m-d', strtotime($invoice_to_date));
            $model->total_amount = $all_total;
            if($model->save()){
                if($line_work_id !=null){
                    for($i=0;$i<=count($line_work_id)-1;$i++){
                        $model_chk = \common\models\PreinvoiceLine::find()->where(['work_queue_id'=>$line_work_id[$i]])->one();
                        if($model_chk){
                            $model_chk->preinvoice_id = $line_work_id[$i];
                            $model_chk->total_amount = $line_work_amount[$i];
                            $model_chk->save(false);
                        }else{
                            $model_line = new \common\models\PreinvoiceLine();
                            $model_line->preinvoice_id = $model->id;
                            $model_line->work_queue_id = $line_work_id[$i];
                            $model_line->total_amount = $line_work_amount[$i];
                            $model_line->status = 1;
                            $model_line->save(false);
                        }
                    }
                }
                if($removelist !=null){
                    $x=explode(',',$removelist);
                    if($x!=null){
                        for($m=0;$m<=count($x)-1;$m++){
                            \common\models\PreinvoiceLine::deleteAll(['id'=>$x[$m]]);
                        }
                    }
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
     * Deletes an existing Preinvoice model.
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
     * Finds the Preinvoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Preinvoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Preinvoice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFindworkqueue()
    {
        $customer_id = \Yii::$app->request->post('customer_id');
        $html = '';
        if ($customer_id > 0) {
            //$model = \backend\models\Workqueue::find()->where(['is_invoice' => 0])->all();
            $model = \backend\models\Workqueue::find()->where(['is_invoice' => 0,'customer_id'=>$customer_id])->all();
            if ($model) {
                foreach ($model as $value) {
                    $work_type_name = \backend\models\WorkOptionType::findName($value->work_option_type_id);
                    $html .= '<tr>';
                    $html .= '<td style="text-align: center">
                            <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $value->id . '">เลือก</div>
                            <input type="hidden" class="line-find-order-id" value="' . $value->id . '">
                            <input type="hidden" class="line-find-qty" value="' . 1 . '">
                            <input type="hidden" class="line-find-price" value="' . 0 . '">
                            <input type="hidden" class="line-find-work-type-name" value="' . $work_type_name . '">
                           <input type="hidden" class="line-find-order-no" value="' . $value->work_queue_no . '">
                           </td>';
                    $html .= '<td style="text-align: left">' . $value->work_queue_no . '</td>';
                    $html .= '<td style="text-align: left">' . date('d-m-Y', strtotime($value->work_queue_date)) . '</td>';
                    $html .= '<td style="text-align: left">' . $work_type_name . '</td>';
                    $html .= '</tr>';
                }
            }
        }
        echo $html;
    }
}
