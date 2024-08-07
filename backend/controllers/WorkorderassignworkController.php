<?php

namespace backend\controllers;

use backend\models\UsergroupSearch;
use backend\models\Workorderassignwork;
use backend\models\WorkorderassignworkSearch;
use common\models\WorkorderEvaluate;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
                        'delete' => ['POST', 'GET'],
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
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//        $work_photo = '';
//        $work_vdo = '';
//        $model_work_photo = \common\models\WorkorderPhoto::find()->select(['photo'])->where(['workorder_id'=>$id])->one();
//        $model_work_vdo = \common\models\WorkorderVdo::find()->select(['file_name'])->where(['workorder_id'=>$id])->one();
//
//        if($model_work_photo){
//            $work_photo = $model_work_photo->photo;
//        }
//        if($model_work_vdo){
//            $work_vdo = $model_work_vdo->file_name;
//        }
//
//        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//            'work_photo' => $work_photo,
//            'work_vdo' => $work_vdo,
//        ]);
//    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $work_photo = '';
        $work_vdo = '';
        $model_work_photo = \common\models\WorkorderPhoto::find()->select(['photo'])->where(['workorder_id' => $id])->one();
        $model_work_vdo = \common\models\WorkorderVdo::find()->select(['file_name'])->where(['workorder_id' => $id])->one();

        if ($model_work_photo) {
            $work_photo = $model_work_photo->photo;
        }
        if ($model_work_vdo) {
            $work_vdo = $model_work_vdo->file_name;
        }

        $old_date = '';
        $model_date = \common\models\Workorder::find()->select(['workorder_date'])->where(['id' => $id])->one();
        if ($model_date) {
            $old_date = $model_date->workorder_date;
        }
//        print_r($old_date);return ;


        if ($model->load(\Yii::$app->request->post())) {
            $work_created_by = \Yii::$app->request->post('work_created_by');
            $work_status = \Yii::$app->request->post('work_status');
            $work_old_photo = \Yii::$app->request->post('work_old_photo');
            $work_old_vdo = \Yii::$app->request->post('work_old_vdo');

            $fac1 = \Yii::$app->request->post('factor_risk_1');
            $fac2 = \Yii::$app->request->post('factor_risk_2');
            $fac3 = \Yii::$app->request->post('factor_risk_3');
            $fac_total = \Yii::$app->request->post('factor_total');
            $fac_final = \Yii::$app->request->post('factor_final');


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


            $model->workorder_date = date('Y-m-d H:i:s', strtotime($old_date));
//            print_r($model->workorder_date);return;

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
                    if (\common\models\WorkorderPhoto::deleteAll(['workorder_id' => $model->id])) {
                        unlink('uploads/workorder_photo/' . $work_old_photo);
                    }
                    $upfiles = "photo_" . time() . "." . $uploaded->getExtension();
                    if ($uploaded->saveAs('uploads/workorder_photo/' . $upfiles)) {
                        $model_photo = new \common\models\WorkorderPhoto();
                        $model_photo->workorder_id = $model->id;
                        $model_photo->photo = $upfiles;
                        $model_photo->save(false);
                    }

                }

                if (!empty($uploaded2)) {
                    if (\common\models\WorkorderVdo::deleteAll(['workorder_id' => $model->id])) {
                        unlink('uploads/workorder_vdo/' . $work_old_vdo);
                    }
                    $upfiles2 = "vdo_" . time() . "." . $uploaded2->getExtension();
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

//    public function actionFindemployee()
//    {
//        $work_assign_id = \Yii::$app->request->post('work_assign_id');
//        $html = '';
//        if ($work_assign_id) {
//
//            $model_emp_data = \backend\models\Employee::find()->where(['status' => '1'])->all();
//            if ($model_emp_data) {
//                foreach ($model_emp_data as $value) {
//                    $selected = '';
//                    $model_assing_emp = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $work_assign_id, 'emp_id' => $value->id])->one();
//                    if ($model_assing_emp) {
//                        $selected = 'selected';
//                        $html .= '<tr>';
//                        $html .= '<td><select class="form-control line-emp-id" name="line_emp_id[]"><option value="-1">--เลือกพนักงาน--</option>><option value="' . $value->id . '" ' . $selected . '>' . $value->fname . ' ' . $value->lname . '</option></select></td>';
//                        $html .= '<td style="text-align: center;"><input type="hidden" class="line-work-assign-id" value="' . $work_assign_id . '" name="line_work_assign_id[]"><div class="btn btn-danger" onclick="deleteline($(this))"><i class="fa fa-trash"></i></div></td>';
//                        $html .= '</tr>';
//                    } else {
//                        $html .= '<tr>';
//                        $html .= '<td><select class="form-control line-emp-id" name="line_emp_id[]"><option value="-1">--เลือกพนักงาน--</option>><option value="' . $value->id . '">' . $value->fname . ' ' . $value->lname . '</option></select></td>';
//                        $html .= '<td style="text-align: center;"><input type="hidden" class="line-work-assign-id" value="' . $work_assign_id . '" name="line_work_assign_id[]"><div class="btn btn-danger" onclick="deleteline($(this))"><i class="fa fa-trash"></i></div></td>';
//                        $html .= '</tr>';
//                    }
//
//
//                }
//            }
//        } else {
//            $html .= '<tr>';
//            $html .= '<td colspan="3" style="text-align: center;color: red;">';
//            $html .= 'ไม่พบข้อมูล';
//            $html .= '</td>';
//            $html .= '</tr>';
//        }
//
//        echo $html;
//    }

    public function actionFindemployee()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $html = '';
        if ($workorder_id) {
            $work_assign_id = 0;
            $model_assign_data = \common\models\WorkorderAssign::find()->where(['workorder_id' => $workorder_id])->one();
            if ($model_assign_data) {
                $work_assign_id = $model_assign_data->id;
            }
//            $model_emp_data = \backend\models\Employee::find()->where(['status' => '1'])->all();
            $model_emp_data = \common\models\ViewEmployeeData::find()->where(['status' => 1, 'is_technician' => 1])->all();
            $model_assign_emp = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $work_assign_id])->all();
            if ($model_assign_emp) {
                foreach ($model_assign_emp as $valuex) {
                    $html .= '<tr data-var="' . $valuex->id . '">';
                    $html .= '<td><select class="form-control line-emp-id" name="line_emp_id[]">
                      <option value="-1">--เลือกพนักงาน--</option>';
                    foreach ($model_emp_data as $value) {

                        $selected = '';
                        if ($valuex->emp_id == $value->id) {
                            $selected = 'selected';
                        }
                        $html .= '<option value="' . $value->id . '" ' . $selected . '>' . $value->fname . ' ' . $value->lname . '</option>';
                    }

                    $html .= '</select>
                     </td>';
                    $html .= '<td style="text-align: center;"><input type="hidden" class="line-work-assign-id" value="' . $work_assign_id . '" name="line_work_assign_id[]"><div class="btn btn-danger" onclick="removeline($(this))"><i class="fa fa-trash"></i></div></td>';
                    $html .= '</tr>';
                }
            } else {
                $html .= '<tr data-var="">';
                $html .= '<td><select class="form-control line-emp-id" name="line_emp_id[]">
                      <option value="-1">--เลือกพนักงาน--</option>';
                foreach ($model_emp_data as $value) {
                    $model_assign_emp = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $work_assign_id, 'emp_id' => $value->id])->one();
                    $selected = '';
                    if ($model_assign_emp) {
                        $selected = 'selected';
                    }
                    $html .= '<option value="' . $value->id . '" ' . $selected . '>' . $value->fname . ' ' . $value->lname . '</option>';
                }

                $html .= '</select>
                     </td>';
                $html .= '<td style="text-align: center;"><input type="hidden" class="line-work-assign-id" value="' . $work_assign_id . '" name="line_work_assign_id[]"><div class="btn btn-danger" onclick="removeline($(this))"><i class="fa fa-trash"></i></div></td>';
                $html .= '</tr>';
            }


            echo $html;
        }
    }

    function findTechnician($emp_id)
    {
        if ($emp_id) {
            $model = \common\models\ViewEmployeeData::find()->where(['id' => $emp_id])->one();
            if ($model) {
                if ($model->is_technician == 1) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

    public
    function actionSaveassignemployee()
    {
        $emp_id = \Yii::$app->request->post('line_emp_id');
        $work_order_id = \Yii::$app->request->post('work_order_id');
        $work_assign_id_list = \Yii::$app->request->post('line_work_assign_id');
        $removelist = \Yii::$app->request->post('removelist');
        $res = 0;

        if ($emp_id != null && $work_assign_id_list != null) {
            $work_assign_id = $work_assign_id_list[0];
            $check_assign_no = \backend\models\Workorderassign::find()->where(['id' => $work_assign_id])->one();
            if ($check_assign_no) {
                \common\models\WorkorderAssignLine::deleteAll(['workorder_assign_id' => $work_assign_id]);
//                return ;
                if ($emp_id != null) {
                    for ($i = 0; $i <= count($emp_id) - 1; $i++) {
                        if ($emp_id[$i] == -1) {
                            continue;
                        }
                        $check_has = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $check_assign_no->id, 'emp_id' => $emp_id[$i]])->one();
//                            print_r($emp_id[$i]); return ;
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
                //  print_r($emp_id);return;
                if ($emp_id[0] > 0) {
                    $model_new = new \backend\models\Workorderassign();
                    $model_new->workorder_id = $work_order_id;
                    $model_new->assign_date = date('Y-m-d H:i:s');
                    $model_new->assign_no = '';
                    $model_new->status = 0;
                    if ($model_new->save(false)) {
                        if ($emp_id != null) {
                            for ($i = 0; $i <= count($emp_id) - 1; $i++) {
                                if ($emp_id[$i] == -1) {
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

            if ($removelist != null) {
                $assign_id = 0;
                $xp = explode(',', $removelist);
                if ($xp != null) {
//                        print_r($xp); return ;
                    for ($i = 0; $i <= count($xp) - 1; $i++) {
                        if ($i == 0) {
                            $assign_id = $this->getWorkassignid($xp[$i]);
                        }
                        \common\models\WorkorderAssignLine::deleteAll(['id' => $xp[$i]]);
                        $res = 1;
                    }
//                        echo $assign_id; return;
                    $check_has_line = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $assign_id])->count();
                    if ($check_has_line == 0) {
                        \common\models\Workorderassign::deleteAll(['id' => $assign_id]);
                        $res = 1;
                    }
                }
            }

        }
        if ($res == 1) {

            if ($res == 1) {
                \backend\models\Workorder::updateAll(['work_assign_date' => date('Y-m-d H:i:s'),'status' => 2], ['id' => $work_order_id]);
            }

            $sesion = \Yii::$app->session;
            $sesion->setFlash('msg-success', 'บันทึกข้อมูลสําเร็จ');
        } else {
            $sesion = \Yii::$app->session;
            $sesion->setFlash('msg-error', 'บันทึกข้อมูลไม่สําเร็จ');
        }
        return $this->redirect(['workorderassignwork/index']);

    }

    public function getWorkassignid($assign_line_id)
    {
        $id = 0;
        $model = \common\models\WorkorderAssignLine::find()->where(['id' => $assign_line_id])->one();
        if ($model) {
            $id = $model->workorder_assign_id;
        }
        return $id;
    }

    public
    function actionEvaluatework($id)
    {
        return $this->render('_evaluate', [
            'id' => $id
        ]);
    }

    public
    function actionAddevaluate()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $result = \Yii::$app->request->post('result');
        $evaluate_result = \Yii::$app->request->post('evaluate_result');
        $risk_code = \Yii::$app->request->post('risk_code');
        $line_risk_id = \Yii::$app->request->post('line_risk_id');
        $line_risk_after = \Yii::$app->request->post('line_risk_factor');

        if ($result != null || $result != '') {
//                 echo "OK";return;
            $evaluate_photo = '';
            $uploaded = \yii\web\UploadedFile::getInstanceByName('evaluate_photo');
            if (!empty($uploaded)) {
                $new_file = 'photo_evaluate_' . Time() . "." . $uploaded->getExtension();
                if ($uploaded->saveAs('uploads/work_evaluate_photo/' . $new_file)) {
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
            if ($model_ev->save(false)) {
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


