<?php

namespace backend\controllers;

use backend\models\UsergroupSearch;
use backend\models\Workorderassignwork;
use backend\models\WorkorderassignworkSearch;
use common\models\WorkorderEvaluate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkorderassignworkController implements the CRUD actions for Workorderassignwork model.
 */
class WorkorderassignworkController extends Controller
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
     * Lists all Workorderassignwork models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new WorkorderassignworkSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Workorderassignwork model.
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
     * Creates a new Workorderassignwork model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Workorderassignwork();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
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
     * Updates an existing Workorderassignwork model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Workorderassignwork model.
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
     * Finds the Workorderassignwork model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Workorderassignwork the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workorderassignwork::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFindemployee()
    {
        $work_assign_id = \Yii::$app->request->post('work_assign_id');
        $html = '';
        if ($work_assign_id) {

            $model_emp_data = \backend\models\Employee::find()->where(['status' => '1'])->all();
            if ($model_emp_data) {
                foreach ($model_emp_data as $value) {
                    $selected = '';
                    $model_assing_emp = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $work_assign_id, 'emp_id' => $value->id])->one();
                    if ($model_assing_emp) {
                        $selected = 'selected';
                    }

                    $html .= '<tr>';
                    $html .= '<td><select class="form-control line-emp-id" name="line_emp_id[]"><<option value="-1">--เลือกพนักงาน--</option>><option value="' . $value->id . '" ' . $selected . '>' . $value->fname . ' ' . $value->lname . '</option></select></td>';
                    $html .= '<td style="text-align: center;"><input type="hidden" class="line-work-assign-id" value="' . $work_assign_id . '" name="line_work_assign_id[]"><div class="btn btn-danger" onclick="removeline($(this))"><i class="fa fa-trash"></i></div></td>';
                    $html .= '</tr>';
                }
            }
        } else {
            $html .= '<tr>';
            $html .= '<td colspan="3" style="text-align: center;color: red;">';
            $html .= 'ไม่พบข้อมูล';
            $html .= '</td>';
            $html .= '</tr>';
        }

        echo $html;
    }

    public function actionSaveassignemployee()
    {
        $emp_id = \Yii::$app->request->post('line_emp_id');
        $work_assign_id_list = \Yii::$app->request->post('line_work_assign_id');
        $res = 0;

        if ($emp_id != null && $work_assign_id_list != null) {
            $work_assign_id = $work_assign_id_list[0];
            $check_assign_no = \backend\models\Workorderassign::find()->where(['id' => $work_assign_id])->one();
            if ($check_assign_no) {
                if ($emp_id != null) {
                    for ($i = 0; $i <= count($emp_id) - 1; $i++) {
                        if($emp_id[$i] == -1){
                            continue;
                        }
                        $check_has = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $check_assign_no->id, 'emp_id' => $emp_id[$i]])->one();
                        if ($check_has) {
                            $check_has->emp_message = '';
                            if ($check_has->save(false)) {
                                $res = 1;
                            }
                        } else {
                            $model_line = new \common\models\Workorderassignline();
                            $model_line->workorder_assign_id = $check_assign_no->id;
                            $model_line->emp_id = $emp_id[$i];
                            if ($model_line->save(false)) {
                                $res = 1;
                            }
                        }
                    }
                }
            } else {
                $model_new = new \backend\models\Workorderassign();
                $model_new->workorder_id = $work_assign_id;
                $model_new->assign_date = date('Y-m-d H:i:s');
                $model_new->assign_no = '';
                $model_new->status = 0;
                if ($model_new->save(false)) {
                    if ($emp_id != null) {
                        for ($i = 0; $i <= count($emp_id) - 1; $i++) {
                            if($emp_id[$i] == -1){
                                continue;
                            }
                            $check_has = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $model_new->id, 'emp_id' => $emp_id[$i]])->one();
                            if ($check_has) {
                                $check_has->emp_message = '';
                                if ($check_has->save(false)) {
                                    $res = 1;
                                }
                            } else {
                                $model_line = new \common\models\Workorderassignline();
                                $model_line->workorder_assign_id = $model_new->id;
                                $model_line->emp_id = $emp_id[$i];
                                if ($model_line->save(false)) {
                                    $res = 1;
                                }
                            }

                        }
                    }
                }
            }

        }
        if ($res == 1) {
            $sesion = \Yii::$app->session;
            $sesion->setFlash('msg-success', 'บันทึกข้อมูลสําเร็จ');
        } else {
            $sesion = \Yii::$app->session;
            $sesion->setFlash('msg-error', 'บันทึกข้อมูลไม่สําเร็จ');
        }
        return $this->redirect(['workorderassignwork/index']);

    }

    public function actionEvaluatework($id){
        return $this->render('_evaluate',[
            'id' => $id
        ]);
    }
    public function actionAddevaluate(){
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $result = \Yii::$app->request->post('result');
        $evaluate_result = \Yii::$app->request->post('evaluate_result');
        $risk_code = \Yii::$app->request->post('risk_code');
        $line_risk_id = \Yii::$app->request->post('line_risk_id');
        $line_risk_after = \Yii::$app->request->post('line_risk_factor');

        if($line_risk_id != null || $line_risk_after != null){
           // echo "OK";return;
            $evaluate_photo = '';
            $uploaded = \yii\web\UploadedFile::getInstanceByName('evaluate_photo');
            if(!empty($uploaded)){
                $new_file = 'photo_evaluate_'.Time().".".$uploaded->getExtension();
                if($uploaded->saveAs('uploads/work_evaluate_photo/'.$new_file)){
                    $evaluate_photo = $new_file;
                }
            }

            $model_ev = new \common\models\WorkorderEvaluate();
            $model_ev->workorder_id = $workorder_id;
            $model_ev->trans_date = date('Y-m-d H:i:s');
            $model_ev->risk_code = $risk_code;
            $model_ev->evaluate_result = $evaluate_result;
            $model_ev->result = $result;
            $model_ev->photo = $evaluate_photo;
            if($model_ev->save(false)){
                \common\models\WorkorderRiskAfter::deleteAll(['workorder_id' => $workorder_id]);
                if ($line_risk_id != null || $line_risk_after != null) {
                    for ($i = 0; $i <= count($line_risk_id) - 1; $i++) {
                        $model = new \common\models\WorkorderRiskAfter();
                        $model->workorder_id = $workorder_id;
                        $model->workorder_evaluate_id = $model_ev->id;
                        $model->risk_id = $line_risk_id[$i];
                        $model->risk_value = $line_risk_after[$i];
                        $model->save(false);
                    }
                }
            }

        }
        return $this->redirect(['workorderassignwork/index']);
    }
}


