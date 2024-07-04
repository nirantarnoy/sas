<?php

namespace backend\controllers;

use Yii;
use backend\models\Location;
use backend\models\LocationSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LocationController implements the CRUD actions for Location model.
 */
class LocationController extends Controller
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
        ];
    }

    /**
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new LocationSearch();
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
     * Displays a single Location model.
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
     * Creates a new Location model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Location();

        if ($model->load(Yii::$app->request->post())) {

            $uploaded = UploadedFile::getInstances($model, 'loc_photo');
            $model->loc_photo = '';

            if ($model->save(false)) {

                if (!empty($uploaded)) {
//               for($i=0;$i<=count($uploaded)-1;$i++){
//
//               }
                    //     echo count($uploaded);return;
                    foreach ($uploaded as $file) {
                        if ($file->saveAs('uploads/location_photo/' . $file->baseName . '.' . $file->extension)) {
                            $model_photo = new \common\models\LocationPhoto();
                            $model_photo->location_id = $model->id;
                            $model_photo->loc_photo = $file->baseName . '.' . $file->extension;
                            $model->loc_photo = $file->baseName . '.' . $file->extension;
                            if ($model->save(false)) {
                                $model_photo->save(false);
                            }

                        }
                    }
                }

            }

//            return $this->redirect(['view', 'id' => $model->id]);
            $session = \Yii::$app->session;
            $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Location model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $loc_photo = '';
        $model_loc_photo = \common\models\LocationPhoto::find()->select(['loc_photo'])->where(['location_id' => $id])->one();
        if($model_loc_photo){
            $loc_photo = $model_loc_photo->loc_photo;
        }

//        print_r($loc_photo); return ;

        if ($model->load(Yii::$app->request->post())) {

            $uploaded = UploadedFile::getInstances($model, 'loc_photo');

            $loc_old_photo = \Yii::$app->request->post('loc_old_photo');
//            print_r($loc_photo); return ;

            if ($model->save(false)) {

                if (!empty($uploaded)) {
//               for($i=0;$i<=count($uploaded)-1;$i++){
//
//               }
                    //     echo count($uploaded);return;
                    if('uploads/location_photo/' .$loc_old_photo ){
                        if (\common\models\LocationPhoto::deleteAll(['location_id' => $model->id])) {
                            unlink('uploads/location_photo/' .$loc_old_photo);
                        }
                    }

                    foreach ($uploaded as $file) {
                        if ($file->saveAs('uploads/location_photo/' . $file->baseName . '.' . $file->extension)) {
                            $model_photo = new \common\models\LocationPhoto();
                            $model_photo->location_id = $model->id;
                            $model_photo->loc_photo = $file->baseName . '.' . $file->extension;
                            $model->loc_photo = $model_photo->loc_photo;
                            if ($model->save(false)) {
                                $model_photo->save(false);
                            }

                        }
                    }


                }
            }
//            return $this->redirect(['view', 'id' => $model->id]);
            $session = \Yii::$app->session;
            $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
            return $this->redirect(['index']);
        }


        return $this->render('update', [
            'model' => $model,
            'loc_photo' => $loc_photo,
        ]);
    }

    /**
     * Deletes an existing Location model.
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
     * Finds the Location model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Location the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Location::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
