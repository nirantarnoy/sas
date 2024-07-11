<?php

namespace backend\controllers;

use Yii;
use backend\models\Asset;
use backend\models\AssetSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AssetController implements the CRUD actions for Asset model.
 */
class AssetController extends Controller
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
                    'delete' => ['POST','GET'],
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
     * Lists all Asset models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new AssetSearch();
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
     * Displays a single Asset model.
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
     * Creates a new Asset model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Asset();

        if ($model->load(Yii::$app->request->post())) {
            $uploaded = UploadedFile::getInstances($model, 'photo');

            $r_date = date('Y-m-d');
            $fr_date = explode('/', $model->recieve_date);
            if ($fr_date != null) {
                if (count($fr_date) > 1) {
                    $r_date = $fr_date[2] . '/' . $fr_date[1] . '/' . $fr_date[0] . ' ' . date('H:i:s');
                }
            }

            $w_date = date('Y-m-d');
            $fw_date = explode('/', $model->waranty_exp_date);
            if ($fw_date != null) {
                if (count($fw_date) > 1) {
                    $w_date = $fw_date[2] . '/' . $fw_date[1] . '/' . $fw_date[0] . ' ' . date('H:i:s');
                }
            }

            $model->recieve_date = date('Y-m-d H:i:s', strtotime($r_date));
            $model->waranty_exp_date = date('Y-m-d H:i:s', strtotime($w_date));

            $model->photo = '';
            if ($model->save(false)) {
                if (!empty($uploaded)) {
//               for($i=0;$i<=count($uploaded)-1;$i++){
//
//               }
                    //     echo count($uploaded);return;
                    foreach ($uploaded as $file) {
                        if ($file->saveAs('uploads/asset_photo/' . $file->baseName . '.' . $file->extension)) {
                            $model_photo = new \common\models\AssetPhoto();
                            $model_photo->asset_id = $model->id;
                            $model_photo->photo = $file->baseName . '.' . $file->extension;
                            $model->photo = $model_photo->photo;
                            if ($model->save(false)) {
                                $model_photo->save(false);
                            }
                        }
                    }
                }
            }
            $session = \Yii::$app->session;
            $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
            return $this->redirect(['asset/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Asset model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_asset_photo = \common\models\AssetPhoto::find()->where(['asset_id' => $id])->all();
        if ($model->load(Yii::$app->request->post())) {
            $uploaded = UploadedFile::getInstances($model, 'photo');
            $model->photo = '';


            $r_date = date('Y-m-d');
            $fr_date = explode('/', $model->recieve_date);

            if ($fr_date != null) {

                if (count($fr_date) > 0) {
//                    echo "hello error";
//                    print_r($model->recieve_date);
//                    return;
//
                    $r_date = $fr_date[2] . '/' . $fr_date[1] . '/' . $fr_date[0] . ' ' . date('H:i:s');
                }
            }

            $w_date = date('Y-m-d');
            $fw_date = explode('/', $model->waranty_exp_date);
            if ($fw_date != null) {
                if (count($fw_date) > 1) {
                    $w_date = $fw_date[2] . '/' . $fw_date[1] . '/' . $fw_date[0] . ' ' . date('H:i:s');
                }
            }
//            print_r($w_date); return;

            $old_photo = \Yii::$app->request->post('old_photo');
//            print_r($old_photo); return;

            $model->recieve_date = date('Y-m-d H:i:s', strtotime($r_date));
            $model->waranty_exp_date = date('Y-m-d H:i:s', strtotime($w_date));

            if ($model->save()) {

                if (!empty($uploaded)) {
//               for($i=0;$i<=count($uploaded)-1;$i++){
//
//               }
                    //     echo count($uploaded);return;
                    if (str_ireplace(' ','','uploads/asset_photo/'.$old_photo)) {
//                        print_r(str_ireplace(' ','','uploads/asset_photo/'.$old_photo)); return ;
                        if (\common\models\AssetPhoto::deleteAll(['asset_id' => $model->id])) {
                            unlink(str_ireplace(' ','','uploads/asset_photo/'.$old_photo));
                        }
                    }
                    foreach ($uploaded as $file) {
                        if ($file->saveAs('uploads/asset_photo/' . $file->baseName . '.' . $file->extension)) {
                            $model_photo = new \common\models\AssetPhoto();
                            $model_photo->asset_id = $model->id;
                            $model_photo->photo = $file->baseName . '.' . $file->extension;
                            $model->photo = $model_photo->photo;
                            if ($model->save(false)) {
                                $model_photo->save(false);
                            }
                        }
                    }


                }


                $session = \Yii::$app->session;
                $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
                return $this->redirect(['asset/index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'model_asset_photo' => $model_asset_photo,
        ]);
    }

    public function actionTasklist($id)
    {

        $model = \common\models\AssetTaskList::find()->where(['asset_id' => $id])->all();

        return $this->render('tasklist', [
            'model' => $model,
            'asset_id' => $id
        ]);
    }

    /**
     * Deletes an existing Asset model.
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
     * Finds the Asset model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Asset the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Asset::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetlocation()
    {
        $name = '';
        $asset_id = \Yii::$app->request->post('asset_id');
//        print_r($asset_id); return;
        if ($asset_id) {
            $name = \backend\models\Asset::findLocationName($asset_id);
        }
        echo $name;
    }
    public function actionGetlocationoption()
    {
        $html = '';
        $asset_id = \Yii::$app->request->post('asset_id');
        $location_id = 0;
//        print_r($asset_id); return;
        if ($asset_id) {
            $model = \common\models\Asset::find()->where(['id' => $asset_id])->one();
            if ($model) {
                $location_id = $model->location_id;
            }
        }
        if($location_id){
            $model_location = \common\models\Location::find()->all();
            foreach ($model_location as $value) {
                if($value->id == $location_id){
                    $html .= '<option value="'.$value->id.'" selected>'.$value->name.'</option>';
                }else{
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }
        }
        echo $html;
    }

    public function actionAddtasklist()
    {
        $asset_id = \Yii::$app->request->post('asset_id');
        $line_rec_id = \Yii::$app->request->post('line_rec_id');
        $line_seq_no = \Yii::$app->request->post('line_seq_no');
        $line_todolist = \Yii::$app->request->post('line_todolist');
        $line_detail = \Yii::$app->request->post('line_detail');
        $removelist = \Yii::$app->request->post('remove_list');

        if ($asset_id) {

            if ($line_todolist != null) {
                //echo "ok";return;
                for ($i = 0; $i <= count($line_todolist) - 1; $i++) {
                    if ($line_todolist[$i] == "") {
                        continue;
                    }

                    $model = \common\models\AssetTaskList::find()->where(['asset_id' => $asset_id, 'id' => $line_rec_id[$i]])->one();
                    if ($model) {
                        $model->seq_no = $line_seq_no[$i];
                        $model->todo_name = $line_todolist[$i];
                        $model->todo_description = $line_detail[$i];
                        $model->save(false);
                    } else {
                        $model = new \common\models\AssetTaskList();
                        $model->asset_id = $asset_id;
                        $model->seq_no = $line_seq_no[$i];
                        $model->todo_name = $line_todolist[$i];
                        $model->todo_description = $line_detail[$i];
                        $model->save(false);
                    }
                }


            }

            if ($removelist != null) {
                $xvalue = explode(',', $removelist);
                for ($i = 0; $i <= count($xvalue) - 1; $i++) {
                    \common\models\AssetTaskList::deleteAll(['asset_id' => $asset_id, 'id' => $xvalue[$i]]);
                }
            }
        }
        return $this->redirect(['index']);
    }

    public function actionFindassettask(){
        $asset_id = \Yii::$app->request->post('asset_id');
        $html = '';
        if ($asset_id) {
            $model = \common\models\AssetTaskList::find()->where(['asset_id' => $asset_id])->all();
            if($model){

                foreach ($model as $key => $value) {
                    $html .= '<tr><td>'.($key + 1).'</td><td>'.$value->todo_name.'</td><td>'.$value->todo_description.'</td></tr>';
                }
            }else{
                $html .= '<tr><td colspan="3" style="text-align: center;color: red;">ไม่มีข้อมูล</td></tr>';
            }
        }
        echo $html;
    }
}
