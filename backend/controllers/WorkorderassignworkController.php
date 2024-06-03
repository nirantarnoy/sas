<?php

namespace backend\controllers;

use backend\models\UsergroupSearch;
use backend\models\Workorderassignwork;
use backend\models\WorkorderassignworkSearch;
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
            $model = \common\models\ViewEmployeeData::find()->where(['status' => 1, 'is_technician' => 1])->all();
            if ($model) {
                foreach ($model as $value) {
                    $model_has_assign = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id' => $work_assign_id, 'emp_id' => $value->id])->one();
                    $line_checked = '';
                    $line_work_assign_id = '';
                    $line_checked_class = 'btn-outline-success';
                    if ($model_has_assign) {
                        $line_checked = 'background-color: lightgreen';
                        $line_checked_class = 'btn-success';
                        $line_work_assign_id = $model_has_assign->id;
                    }
                    $html .= '<tr style="background-color: red">';
                    $html .= '<td style="text-align: center">
                                <div class="btn '.$line_checked_class.' btn-sm" onclick="addselecteditem($(this))" data-var="' . $value->id . '">เลือก</div>
                                <input type="hidden" class="line-find-work-assign-id" value="' . $work_assign_id . '">
                                <input type="hidden" class="line-find-work-assign-line-id" value="' . $line_work_assign_id . '">
                                <input type="hidden" class="line-find-emp-id" value="' . $value->id . '">
                                <input type="hidden" class="line-find-emp-code" value="' . $value->code . '">
                                <input type="hidden" class="line-emp-selected" value="0">
                                <input type="hidden" class="line-find-emp-name" value="' . $value->fname . ' ' . $value->lname . '">
                                <input type="hidden" class="line-find-emp-position" value="' . $value->position_name . '">
                             </td>';
                    $html .= '<td style="text-align: left">' . $value->code . '</td>';
                    $html .= '<td style="text-align: left">' . $value->fname . ' ' . $value->lname . '</td>';
                    $html .= '<td style="text-align: left">' . $value->position_name . '</td>';
                    $html .= '</tr>';

                }
            } else {
                $html .= '<tr>';
                $html .= '<td colspan="4" style="text-align: center;color: red;">';
                $html .= 'ไม่พบข้อมูล';
                $html .= '</td>';
                $html .= '</tr>';
            }

        } else {
            $html .= '<tr>';
            $html .= '<td colspan="4" style="text-align: center;color: red;">';
            $html .= 'ไม่พบข้อมูล';
            $html .= '</td>';
            $html .= '</tr>';
        }

        echo $html;
    }

    public function actionSaveassignemployee(){
        $emp_id = \Yii::$app->request->post('work_employee_id');
        $work_assign_id = \Yii::$app->request->post('work_assign_id');

        if($work_assign_id){
          $check_assign_no = \backend\models\Workorderassign::find()->where(['id'=>$work_assign_id])->one();
          if($check_assign_no){
              if($emp_id != null){
                  for($i=0;$i<count($emp_id);$i++){
                      $check_has = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id'=>$check_assign_no->id,'emp_id'=>$emp_id[$i]])->one();
                      if($check_has){
                          $check_has->message = '';
                          $check_has->save(false);
                      }else{
                          $model_line = new \common\models\Workorderassignline();
                          $model_line->workorder_assign_id = $check_assign_no->id;
                          $model_line->emp_id = $emp_id[$i];
                          $model_line->save(false);
                      }
                  }
              }
          }else{
              $model_new = new \backend\models\Workorderassign();
              $model_new->workorder_id = $work_assign_id;
              $model_new->assign_date = date('Y-m-d H:i:s');
              $model_new->assign_no = '';
              $model_new->status = 0;
              if($model_new->save(false)){
                  if($emp_id != null){
                      for($i=0;$i<count($emp_id);$i++){
                          $check_has = \common\models\WorkorderAssignLine::find()->where(['workorder_assign_id'=>$model_new->id,'emp_id'=>$emp_id[$i]])->one();
                          if($check_has){
                              $check_has->message = '';
                              $check_has->save(false);
                          }else{
                              $model_line = new \common\models\Workorderassignline();
                              $model_line->workorder_assign_id = $model_new->id;
                              $model_line->emp_id = $emp_id[$i];
                              $model_line->save(false);
                          }

                      }
                  }
              }
          }

        }
    }
}

