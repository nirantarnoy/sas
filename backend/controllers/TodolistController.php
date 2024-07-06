<?php

namespace backend\controllers;

use backend\models\PositionSearch;
use backend\models\Todolist;
use backend\models\TodolistSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TodolistController implements the CRUD actions for Todolist model.
 */
class TodolistController extends Controller
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
                        'delete' => ['POST','GET'],
                    ],
                ],
//                'access'=>[
//                    'class'=>AccessControl::className(),
//                    'denyCallback' => function ($rule, $action) {
//                        throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
//                    },
//                    'rules'=>[
//                        [
//                            'allow'=>true,
//                            'roles'=>['@'],
//                            'matchCallback'=>function($rule,$action){
//                                $currentRoute = \Yii::$app->controller->getRoute();
//                                if(\Yii::$app->user->can($currentRoute)){
//                                    return true;
//                                }
//                            }
//                        ]
//                    ]
//                ],
            ]
        );
    }

    /**
     * Lists all Todolist models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new TodolistSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = $pageSize;
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Todolist model.
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
     * Creates a new Todolist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Todolist();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $line_emp_id = \Yii::$app->request->post('line_emp_id');

                $save_trans_date = date('Y-m-d');
                $save_target_date = date('Y-m-d');
                $save_act_date = date('Y-m-d');
                $save_end_date = date('Y-m-d');
                $or_trans_date = explode('-',$model->trans_date);
                $or_target_date = explode('-',$model->target_date);
                $or_act_date = explode('-',$model->act_date);
                $or_end_date = explode('-',$model->end_date);

//                print_r($model->trans_date); return ;

                if($or_trans_date !=null){
                    if(count($or_trans_date)>1){
                        $save_trans_date = $or_trans_date[2].'/'.$or_trans_date[1].'/'.$or_trans_date[0];
                    }
                }

//                print_r($or_trans_date); return ;
                if($or_target_date !=null){
                    if(count($or_target_date)>1){
                        $save_target_date = $or_target_date[2].'/'.$or_target_date[1].'/'.$or_target_date[0];
                    }
                }

                if($or_act_date !=null){
                    if(count($or_act_date)>1){
                        $save_act_date = $or_act_date[2].'/'.$or_act_date[1].'/'.$or_act_date[0];
                    }
                }

                if($or_end_date !=null){
                    if(count($or_end_date)>1){
                        $save_end_date = $or_end_date[2].'/'.$or_end_date[1].'/'.$or_end_date[0];
                    }
                }


                $model->trans_date = date('Y-m-d',strtotime($save_trans_date));
                $model->target_date = date('Y-m-d',strtotime($save_target_date));
                $model->act_date = date('Y-m-d',strtotime($save_act_date));
                //$model->end_date = date('Y-m-d',strtotime($save_end_date));
                $model->end_date = date('Y-m-d H:i:s');
                $model->todolist_no = $model::getLastNo();
                $model->status = 0;

                if($model->save(false)){

                    if($line_emp_id !=null){
//                        print_r($line_emp_id); return ;
                       for($i=0;$i<count($line_emp_id);$i++){
                           $model2 = new \common\models\TodolistAssign();
                           $model2->todolist_id = $model->id;
                           $model2->emp_id = $line_emp_id[$i];
                           $model2->remark = '';
                           $model2->save(false);
                       }
                    }
                    $session = \Yii::$app->session;
                    $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
                    return $this->redirect(['index']);
                    //return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Todolist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\TodolistAssign::find()->where(['todolist_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $line_emp_id = \Yii::$app->request->post('line_emp_id');
            $save_trans_date = date('Y-m-d');
            $save_target_date = date('Y-m-d');
            $save_act_date = date('Y-m-d');
            $save_end_date = date('Y-m-d');
            $or_trans_date = explode('-',$model->trans_date);
            $or_target_date = explode('-',$model->target_date);
            $or_act_date = explode('-',$model->act_date);
            $or_end_date = explode('-',$model->end_date);

            $removelist = \Yii::$app->request->post('removelist');

//            print_r($line_emp_id); return ;

            if($or_trans_date !=null){
                if(count($or_trans_date)>1){
                    $save_trans_date = $or_trans_date[2].'/'.$or_trans_date[1].'/'.$or_trans_date[0];
                }
            }

            if($or_target_date !=null){
                if(count($or_target_date)>1){
                    $save_target_date = $or_target_date[2].'/'.$or_target_date[1].'/'.$or_target_date[0];
                }
            }

            if($or_act_date !=null){
                if(count($or_act_date)>1){
                    $save_act_date = $or_act_date[2].'/'.$or_act_date[1].'/'.$or_act_date[0];
                }
            }

            if($or_end_date !=null){
                if(count($or_end_date)>1){
                    $save_end_date = $or_end_date[2].'/'.$or_end_date[1].'/'.$or_end_date[0];
                }
            }


            $model->trans_date = date('Y-m-d',strtotime($save_trans_date));
            $model->target_date = date('Y-m-d',strtotime($save_target_date));
            $model->act_date = date('Y-m-d',strtotime($save_act_date));
            $model->end_date = date('Y-m-d',strtotime($save_end_date));

            if($model->save(false)){
                if($line_emp_id !=null){

                    \common\models\TodolistAssign::deleteAll(['todolist_id' => $model->id]);
                    for($i=0;$i<count($line_emp_id);$i++){

                        if($line_emp_id[$i]==0)continue;

                        $model2 = new \common\models\TodolistAssign();
                        $model2->todolist_id = $model->id;
                        $model2->emp_id = $line_emp_id[$i];
                        $model2->remark = '';
                        $model2->save(false);
                    }
                }

                if ($removelist != '') {
                    $x = explode(',', $removelist);
                    if (count($x) > 0) {
                        for ($m = 0; $m <= count($x) - 1; $m++) {
                            \common\models\TodolistAssign::deleteAll(['id' => $x[$m]]);
                        }
                    }
                }

                $session = \Yii::$app->session;
                $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
                //return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Todolist model.
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
     * Finds the Todolist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Todolist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Todolist::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetempdata(){
        $html = '';
        $model = \backend\models\Employee::find()->where(['status'=>1])->all();
        if($model){
            foreach($model as $value){
                $html .= '<tr>';
                $html .= '<td style="text-align: center">
                            <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $value->id . '">เลือก</div>
                            <input type="hidden" class="line-find-emp-id" value="' . $value->id . '">                    
                            <input type="hidden" class="line-find-emp-name" value="' . $value->fname. ' ' . $value->lname . '">
                           </td>';
                $html .= '<td style="text-align: left">' .$value->fname. ' ' . $value->lname. '</td>';
                $html .= '</tr>';
            }
        }

        echo $html;
    }
}
