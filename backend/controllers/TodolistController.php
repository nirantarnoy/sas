<?php

namespace backend\controllers;

use backend\models\PositionSearch;
use backend\models\Todolist;
use backend\models\TodolistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TodolistController implements the CRUD actions for Todolist model.
 */
class TodolistController extends Controller
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
            if ($model->load($this->request->post()) && $model->save()) {
                $session = \Yii::$app->session;
                $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
                //return $this->redirect(['view', 'id' => $model->id]);
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $session = \Yii::$app->session;
            $session->setFlash('msg-success', 'บันทึกรายการเรียบร้อย');
            return $this->redirect(['index']);
           // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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

            }
        }

        echo $html;
    }
}
