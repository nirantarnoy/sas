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
        $c_user = \Yii::$app->user->id;
        $model = null;
        if ($c_user) {
            $emp_id = \backend\models\User::findEmpId($c_user);
            $model = \common\models\ViewEmpWorkAssign::find()->where(['emp_id' => $emp_id])->all();
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionAcceptworkorder()
    {
        $workorder_id = \Yii::$app->request->post('workorder_id');
        $workorder_accept_type = \Yii::$app->request->post('workorder_accept_type');
        $workorder_reason = \Yii::$app->request->post('accept_workorder_reason');

        if ($workorder_id && $workorder_accept_type) {
            $model = \common\models\Workorder::find()->where(['id' => $workorder_id])->one();
            if ($model) {
                if ($workorder_accept_type == 1) {
                    $model->status = 2; // accept order
                } else if ($workorder_accept_type == 0) {
                    $model->status = 5; // accept order
                }
                $model->reason = $workorder_reason;
                $model->save(false);
            }

        }
        return $this->redirect(['myworkassign/index']);
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
                                   value="'.$model->factor_risk_1.'">
                        </td>
                    </tr>
                    <tr>
                        <td>ความถี่</td>
                        <td>
                            <input class="form-control factor-risk-2" type="number" min="0" name="factor_risk_2"
                                   value="'.$model->factor_risk_2 .'">
                        </td>
                    </tr>
                    <tr>
                        <td>มาตรการ Safety</td>
                        <td>
                            <input class="form-control factor-risk-3" type="number" min="0" name="factor_risk_3"
                                   value="'.$model->factor_risk_3 .'">
                        </td>
                    </tr>
                    <tr>
                        <td>(1)+(2)+(3)</td>
                        <td>
                            <input class="form-control factor-total" type="text" readonly name="factor_total"
                                   value="'.$model->factor_total .'">
                        </td>
                    </tr>
                    <tr>
                        <td>สรุปความเสี่ยง</td>
                        <td>
                            <input class="form-control" type="text" name="factor_final"
                                   value="'.$model->factor_risk_final.'">
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
                    $model_close->photo = $close_photo;
                    $model_close->save(false);
                }
            }
        }
        return $this->redirect(['myworkassign/index']);
    }

}