<?php

namespace backend\controllers;

use backend\models\Workqueue;
use backend\models\WorkqueueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * WorkqueueController implements the CRUD actions for Workqueue model.
 */
class WorkqueueController extends Controller
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
     * Lists all Workqueue models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new WorkqueueSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->orderBy(['id' => SORT_DESC]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Workqueue model.
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
     * Creates a new Workqueue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Workqueue();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $new_date = $model->work_queue_date . ' ' . date('H:i:s');

                $model->work_queue_date = date('Y-m-d H:i:s', strtotime($new_date));
                $model->work_queue_no = $model->getLastNo();

                $line_doc_name = \Yii::$app->request->post('line_doc_name');
                // $line_file_name = \Yii::$app->request->post('line_file_name');
                $uploaded = UploadedFile::getInstancesByName('line_file_name');

                $item_id = \Yii::$app->request->post('line_work_queue_item_id');
                $description = \Yii::$app->request->post('line_work_queue_description');

//                print_r(count($uploaded)); return ;

                if ($model->save()) {

//                    echo '123'; return ;
                    if ($line_doc_name != null) {
                        for ($i = 0; $i <= count($line_doc_name) - 1; $i++) {

                            foreach ($uploaded as $key => $value) {
                                if ($key == $i) {
//                                    echo '123'; return ;
                                    if (!empty($value)) {
                                        $upfiles = time() . "." . $value->getExtension();
                                        // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
                                        if ($value->saveAs('../web/uploads/workqueue_doc/' . $upfiles)) {
                                            $model_doc = new \common\models\WorkQueueLine();
                                            $model_doc->work_queue_id = $model->id;
                                            $model_doc->doc = $upfiles;
                                            $model_doc->description = $line_doc_name[$i];
                                            $model_doc->save(false);
                                        }
                                    }
                                }
                            }


                        }
                    }
                    if ($item_id != null){
//                        print_r($item_id);return ;
                        for ($l = 0;$l <= count($item_id) - 1; $l++){
                            $model_line = new \common\models\WorkQueueItemLine();
                            $model_line->work_queue_id = $model->id;
                            $model_line->item_id = $item_id[$l];
                            $model_line->description = $description[$l];
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
     * Updates an existing Workqueue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_line_doc = \common\models\WorkQueueLine::find()->where(['work_queue_id' => $id])->all();

        $model_line_item = \common\models\WorkQueueItemLine::find()->where(['work_queue_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->work_queue_date = date('Y-m-d', strtotime($model->work_queue_date));
            $removelist = \Yii::$app->request->post('remove_list');
            $line_doc_name = \Yii::$app->request->post('line_doc_name');
            // $line_file_name = \Yii::$app->request->post('line_file_name');
            $uploaded = UploadedFile::getInstancesByName('line_file_name');
            $line_id = \Yii::$app->request->post('rec_id');

            $removelist1 = \Yii::$app->request->post('remove_list1');
            $item_id = \Yii::$app->request->post('line_work_queue_item_id');
            $description = \Yii::$app->request->post('line_work_queue_description');

            // print_r($line_id);return;
            if ($model->save()) {
                if ($line_id != null) {
                    // echo count($uploaded);return;
                    for ($i = 0; $i <= count($line_id) - 1; $i++) {
                        $model_check = \common\models\WorkQueueLine::find()->where(['id' => $line_id[$i]])->one();
                        if ($model_check) {
                            $model_check->description = $line_doc_name[$i];
                            $model_check->save(false);
                        } else {
                            foreach ($uploaded as $key => $value) {

                                if (!empty($value)) {
                                    $upfiles = time() + 2 . "." . $value->getExtension();
                                    // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
                                    if ($value->saveAs('../web/uploads/workqueue_doc/' . $upfiles)) {
                                        $model_doc = new \common\models\WorkQueueLine();
                                        $model_doc->work_queue_id = $model->id;
                                        $model_doc->doc = $upfiles;
                                        $model_doc->description = $line_doc_name[$i];
                                        $model_doc->save(false);
                                    }
                                }
                            }
                        }
                    }
                }


                if($item_id != null ){
//                    print_r(count($item_id)); return ;
                    for($j = 0; $j <= count($item_id) - 1; $j++ ) {
                        $model_chk = \common\models\WorkQueueItemLine::find()->where(['work_queue_id' => $model->id,'item_id' => $item_id[$j]])->one();
                        if($model_chk){
                            $model_chk->item_id = $item_id[$j];
                            $model_chk->description = $description[$j];
                            $model_chk->save(false);
                        } else {
//                            print_r($item_id); return ;
                            $model_item = new \common\models\WorkQueueItemLine();
                            $model_item->work_queue_id = $model->id;
                            $model_item->item_id = $item_id[$j];
                            $model_item->description = $description[$j];
                            $model_item->status = 1;
                            $model_item->save(false);
                        }
                    }
                }


                $delete_rec = explode(",", $removelist);
                if (count($delete_rec)) {
                    $model_find_doc_delete = \common\models\WorkQueueLine::find()->where(['id' => $delete_rec])->one();
                    if ($model_find_doc_delete) {
                        if (file_exists(\Yii::getAlias('@backend') . '/web/uploads/workqueue_doc/' . $model_find_doc_delete->doc)) {
                            if (unlink(\Yii::getAlias('@backend') . '/web/uploads/workqueue_doc/' . $model_find_doc_delete->doc)) {
                                \common\models\WorkQueueLine::deleteAll(['id' => $delete_rec]);
                            }
                        }
                    }

                }

                $delete_line = explode(",", $removelist1);
                if(count($delete_line)){
                    \common\models\WorkQueueItemLine::deleteAll(['id' => $delete_line]);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'model_line_doc' => $model_line_doc,
            'model_line_item' => $model_line_item,
        ]);
    }

    /**
     * Deletes an existing Workqueue model.
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
     * Finds the Workqueue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Workqueue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workqueue::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrintdocx($id)
    {
        if ($id) {
            $model = \backend\models\Workqueue::find()->where(['id' => $id])->one();
            $modelline = \common\models\WorkQueueLine::find()->where(['work_queue_id' => $id])->all();
            return $this->render('_printdocx', [
                'model' => $model,
                'modelline' => $modelline,
            ]);
        }

    }

    public function actionApprovejob($id, $approve_id)
    {
//        $work_id = \Yii::$app->request->post('work_id');
//        $user_approve = \Yii::$app->request->post('user_approve_id');
        $work_id = $id;
        $user_approve = $approve_id;
        $res = 0;
        if ($work_id && $user_approve) {
            $model = \backend\models\Workqueue::find()->where(['id' => $work_id])->one();
            if ($model) {
                $model->approve_status = 1;
                $model->approve_by = $user_approve;
                if ($model->save(false)) {
                    $res = 1;
                }
            }

        }
        if ($res > 0) {
            $this->redirect(['workqueue/index']);
        } else {
            $this->redirect(['workqueue/index']);
        }
    }

    public function actionRemovedoc()
    {
        $workqueue_id = \Yii::$app->request->post('work_queue_id');
        $doc_name = \Yii::$app->request->post('doc_name');

        echo $workqueue_id . ' = ' . $doc_name;

        if ($workqueue_id && $doc_name != '') {
            if (file_exists(\Yii::getAlias('@backend') . '/web/uploads/workqueue_doc/' . $doc_name)) {
                if (unlink(\Yii::getAlias('@backend') . '/web/uploads/workqueue_doc/' . $doc_name)) {
//                    $model = \backend\models\Workqueue::find()->where(['id' => $workqueue_id])->one();
//                    if ($model) {
//                        $model->doc = '';
//                        $model->save(false);
//                    }
                }
            }
        } else {
            echo "no";
            return;
        }
        return $this->redirect(['workqueue/update', 'id' => $workqueue_id]);
    }
}
