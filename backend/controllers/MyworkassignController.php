<?php

namespace backend\controllers;

use backend\models\CashrecordSearch;
use common\models\WorkorderAssignReject;
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
class MyworkassignController extends Controller

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
                    'delete' => ['POST', 'GET'],
                ],
            ],
//            'access'=>[
//                'class'=>AccessControl::className(),
//                'denyCallback' => function ($rule, $action) {
//                    throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
//                },
//                'rules'=>[
//                    [
//                        'allow'=>true,
//                        'roles'=>['@'],
//                        'matchCallback'=>function($rule,$action){
//                            $currentRoute = \Yii::$app->controller->getRoute();
//                            if(\Yii::$app->user->can($currentRoute)){
//                                return true;
//                            }
//                        }
//                    ]
//                ]
//            ],
        ];
    }

    /**
     * Lists all Position models.
     * @return mixed
     */
    public function actionIndex()
    {
        $type = \Yii::$app->request->get('type');
        $c_user = \Yii::$app->user->id;
        $model = null;
        if ($c_user) {
            $emp_id = \backend\models\User::findEmpId($c_user);
            if ($type == 'all' || $type == null) {
                $model = \common\models\ViewEmpWorkAssign::find()->where(['emp_id' => $emp_id])->all();
            } else {
                $model = \common\models\ViewEmpWorkAssign::find()->where(['emp_id' => $emp_id, 'workorder_status' => $type])->all();
            }

        }

        return $this->render('index', [
            'model' => $model,
            'type' => $type,
        ]);
    }

    public function actionAcceptworkorder()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $workorder_accept_type = \Yii::$app->request->post('workorder_accept_type');
        $workorder_reason = \Yii::$app->request->post('accept_workorder_reason');
        $estimate_finish_date = \Yii::$app->request->post('estimate_finish_date');

//        echo $workorder_id; return ;

        if ($workorder_id && $workorder_accept_type != null) {
//            echo $workorder_accept_type; return ;
            $model = \common\models\Workorder::find()->where(['id' => $workorder_id])->one();
            if ($model) {
                if ($workorder_accept_type == 1) {
                    $model->status = 3; // accept order
                } else if ($workorder_accept_type == 0) {

                    $model->status = 6; // reject order
                }

                $est_date = date('Y-m-d');
                $xdate = explode('-', $estimate_finish_date);
                if (count($xdate) > 1) {
                    $est_date = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
                }

                $model->work_estimate_finish_date = date('Y-m-d', strtotime($est_date));
                $model->reason = $workorder_reason;
                $model->work_recieve_date = date('Y-m-d H:i:s');
                if ($model->save(false)) {
                    if ($model->status == 6) { // reject order must to delete assign work line
                        $assign_model = \common\models\WorkorderAssign::find()->where(['workorder_id' => $workorder_id])->one();
                        if ($assign_model) {
                            $model_reject = new \common\models\WorkorderAssignReject();
                            $model_reject->workorder_id = $workorder_id;
                            $model_reject->trans_date = date('Y-m-d H:i:s');
                            $model_reject->reason = $workorder_reason;
                            $model_reject->emp_id = \Yii::$app->user->id;
                            if ($model_reject->save(false)) {
                                \common\models\WorkorderAssignLine::deleteAll(['workorder_assign_id' => $assign_model->id]);
                                $assign_model->delete();
                            }
                        }
                    }
                }

            }

        }
        return $this->redirect(['myworkassign/index', 'type' => 1]);
    }

    public function actionSaveriskafter()
    {
        $workorder_id = \Yii::$app->request->post("workorder_id");
        $line_risk_id = \Yii::$app->request->post("line_risk_id");
        $line_risk_after = \Yii::$app->request->post("line_risk_factor");

        if ($workorder_id) {
            \common\models\WorkorderRiskAfter::deleteAll(['workorder_id' => $workorder_id]);
            if ($line_risk_id != null || $line_risk_after != null) {
                for ($i = 0; $i <= count($line_risk_id) - 1; $i++) {
                    $model = new \common\models\WorkorderRiskAfter();
                    $model->workorder_id = $workorder_id;
                    $model->risk_id = $line_risk_id[$i];
                    $model->risk_value = $line_risk_after[$i];
                    $model->save(false);
                }
            }
        }
        return $this->redirect(['myworkassign/index']);
    }

    public function actionFindriskafter()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $html = '';
        if ($workorder_id) {
            $model_risk_title = \common\models\WorkorderRiskTitle::find()->where(['status' => 1])->all();
            if ($model_risk_title) {
                foreach ($model_risk_title as $value_titile) {
                    $line_value = 0;
                    $model_work_risk = \common\models\WorkorderRiskAfter::find()->where(['workorder_id' => $workorder_id, 'risk_id' => $value_titile->id])->orderBy(['id' => SORT_DESC])->one();
                    if ($model_work_risk) {
                        $line_value = $model_work_risk->risk_value;
                    }
                    $is_sum = '';
                    $line_sum_disabled = '';
                    if ($value_titile->id == 4) {
                        $is_sum = 'line-sum-risk';
                        $line_sum_disabled = 'readonly';
                    }
                    $html .= '<tr >';
                    $html .= '<td style="width: 20%;text-align: right;vertical-align: middle;">
                                            <input type="hidden" class="line-risk-id" name="line_risk_id[]" value="' . $value_titile->id . '">
                                            ' . $value_titile->name . '
                                        </td>';
                    $html .= '<td><input type="text" style="font-weight: bold;"
                                                   class="form-control line-risk-factor ' . $is_sum . '" ' . $line_sum_disabled . ' name="line_risk_factor[]" value="' . $line_value . '" onclick="calRiskAfter($(this))">
                                        </td>';
                    $html .= '</tr>';
                }
            }

        }

        echo $html;
    }

    public function actionFindriskbefore()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $html = '';
        if ($workorder_id) {
            $model = \common\models\Workorder::find()->where(['id' => $workorder_id])->one();
            if ($model) {
                $html .=

                    '<tr>
                        <td>ความรุนแรง</td>
                        <td>
                            <input class="form-control factor-risk-1" type="number" min="0" name="factor_risk_1"
                                   value="' . $model->factor_risk_1 . '" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>ความถี่</td>
                        <td>
                            <input class="form-control factor-risk-2" type="number" min="0" name="factor_risk_2"
                                   value="' . $model->factor_risk_2 . '" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>มาตรการ Safety</td>
                        <td>
                            <input class="form-control factor-risk-3" type="number" min="0" name="factor_risk_3"
                                   value="' . $model->factor_risk_3 . '" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>(1)+(2)+(3)</td>
                        <td>
                            <input class="form-control factor-total" type="text" readonly name="factor_total"
                                   value="' . $model->factor_total . '">
                        </td>
                    </tr>
                    <tr>
                        <td>สรุปความเสี่ยง</td>
                        <td>
                            <input class="form-control" type="text" name="factor_final"
                                   value="' . $model->factor_risk_final . '" readonly>
                        </td>
                    </tr>';
            }

        }

        echo $html;
    }

    public function actionCloseworkorder()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $work_cause = \Yii::$app->request->post('work_cause');
        $work_solve = \Yii::$app->request->post('work_solve');
        $labour_cost = \Yii::$app->request->post('labour_cost');
        $spare_cost = \Yii::$app->request->post('spare_cost');
        $preventive_text = \Yii::$app->request->post('preventive_text');

        $uploaded = \yii\web\UploadedFile::getInstanceByName('file_close');
        if ($workorder_id) {
            $model = \common\models\Workorder::find()->where(['id' => $workorder_id])->one();
            if ($model) {
                $model->status = 4; // close order

                if ($model->save(false)) {

                    $close_photo = '';
                    if (!empty($uploaded)) {
                        $new_file = 'photo_close_' . Time() . '.' . $uploaded->getExtension();
                        if ($uploaded->saveAs('uploads/workclose_photo/' . $new_file)) {
                            $close_photo = $new_file;
                        }
                    }

                    $model_close = new \common\models\WorkorderClose();
                    $model_close->workorder_id = $model->id;
                    $model_close->trans_date = date('Y-m-d H:i:s');
                    $model_close->cause_id = $work_cause;
                    $model_close->solve_id = $work_solve;
                    $model_close->preventive_text = $preventive_text;
                    $model_close->labour_cost = $labour_cost;
                    $model_close->spare_cost = $spare_cost;
                    $model_close->photo = $close_photo;
                    $model_close->save(false);
                }
                $session = \Yii::$app->session;
                $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
//        return $this->redirect(['index']);

                return $this->redirect(['myworkassign/index', 'type' => 1]);
            }
        }

        return $this->redirect(['myworkassign/index', 'type' => 1]);
    }

}
