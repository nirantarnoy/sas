<?php

namespace backend\controllers;

use backend\models\RoutePlan;
use backend\models\RouteplanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RouteplanController implements the CRUD actions for Routeplan model.
 */
class RouteplanController extends Controller
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
     * Lists all Routeplan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new RouteplanSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Routeplan model.
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
     * Creates a new Routeplan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new RoutePlan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $drop_off_place = \Yii::$app->request->post('drop_off_place');
                $drop_off_qty = \Yii::$app->request->post('drop_off_qty');

                $car_type_id = \Yii::$app->request->post('car_type_id');
                $labour_price_line = \Yii::$app->request->post('labour_price_line');
                $express_road_price_line = \Yii::$app->request->post('express_road_price_line');


//                print_r($drop_off_place);return ;
                if ($model->save(false)) {
                    if (count($drop_off_place)) {
                        for ($i = 0; $i <= count($drop_off_place) - 1; $i++) {
                            if ($drop_off_place[$i] != 0) {
                                $route_plan_line_chk = \common\models\RoutePlanLine::find()->where(['route_plan_id' => $model->id, 'dropoff_place_id' => $drop_off_place[$i]])->one();
                                if ($route_plan_line_chk) {
                                    $route_plan_line_chk->dropoff_place_id = $drop_off_place[$i];
                                    $route_plan_line_chk->dropoff_qty = $drop_off_qty[$i];
                                    $route_plan_line_chk->status = $model->status;
                                    if ($route_plan_line_chk->save(false)) {

                                    }
                                } else {
                                    $new_line = new \common\models\RoutePlanLine();
                                    $new_line->route_plan_id = $model->id;
                                    $new_line->dropoff_place_id = $drop_off_place[$i];
                                    $new_line->dropoff_qty = $drop_off_qty[$i];
                                    $new_line->status = $model->status;
                                    if ($new_line->save(false)) {

                                    }
                                }

                            }
                        }

                    }
                    if (count($car_type_id)) {
                        for ($z = 0; $z <= count($car_type_id) - 1; $z++) {
                            if ($car_type_id[$z] != 0) {
                                $route_plan_price_line_chk = \common\models\RoutePlanPrice::find()->where(['route_plan_id' => $model->id, 'car_type_id' => $car_type_id[$z]])->one();
                                if ($route_plan_price_line_chk) {
                                    $route_plan_price_line_chk->car_type_id = $car_type_id[$z];
                                    $route_plan_price_line_chk->labour_price = $labour_price_line[$z];
                                    $route_plan_price_line_chk->express_road_price = $express_road_price_line[$z];
                                    if ($route_plan_price_line_chk->save(false)){

                                    }
                                }else{
                                    $new_route_plan_price = new \common\models\RoutePlanPrice();
                                    $new_route_plan_price->route_plan_id = $model->id;
                                    $new_route_plan_price->car_type_id = $car_type_id[$z];
                                    $new_route_plan_price->labour_price = $labour_price_line[$z];
                                    $new_route_plan_price->express_road_price = $express_road_price_line[$z];
                                    $new_route_plan_price->status = $model->status;
                                    if ($new_route_plan_price->save(false)){

                                    }
                                }
                            }
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
     * Updates an existing Routeplan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_line = \common\models\RoutePlanLine::find()->where(['route_plan_id' => $model->id])->all();

        $model_line2 = \common\models\RoutePlanPrice::find()->where(['route_plan_id' => $model->id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $drop_off_place = \Yii::$app->request->post('drop_off_place');
            $drop_off_qty = \Yii::$app->request->post('drop_off_qty');

            $removelist = \Yii::$app->request->post('remove_list');
            $removelist2 = \Yii::$app->request->post('remove_list2');

            $car_type_id = \Yii::$app->request->post('car_type_id');
            $labour_price_line = \Yii::$app->request->post('labour_price_line');
            $express_road_price_line = \Yii::$app->request->post('express_road_price_line');



            if ($model->save(false)) {
                if (count($drop_off_place)) {
                    for ($i = 0; $i <= count($drop_off_place) - 1; $i++) {
                        if ($drop_off_place[$i] != 0) {
                            $route_plan_line_chk = \common\models\RoutePlanLine::find()->where(['route_plan_id' => $model->id, 'dropoff_place_id' => $drop_off_place[$i]])->one();
                            if ($route_plan_line_chk) {
                                $route_plan_line_chk->dropoff_place_id = $drop_off_place[$i];
                                $route_plan_line_chk->dropoff_qty = $drop_off_qty[$i];
                                $route_plan_line_chk->status = $model->status;
                                if ($route_plan_line_chk->save(false)) {

                                }
                            } else {
                                $new_line = new \common\models\RoutePlanLine();
                                $new_line->route_plan_id = $model->id;
                                $new_line->dropoff_place_id = $drop_off_place[$i];
                                $new_line->dropoff_qty = $drop_off_qty[$i];
                                $new_line->status = $model->status;
                                if ($new_line->save(false)) {

                                }
                            }
                        }
                    }
                }
                if (count($car_type_id)) {
                    for ($z = 0; $z <= count($car_type_id) - 1; $z++) {
                        if ($car_type_id[$z] != 0) {
                            $route_plan_price_line_chk = \common\models\RoutePlanPrice::find()->where(['route_plan_id' => $model->id,'car_type_id' => $car_type_id[$z]])->one();
                            if ($route_plan_price_line_chk) {
                                $route_plan_price_line_chk->car_type_id = $car_type_id[$z];
                                $route_plan_price_line_chk->labour_price = $labour_price_line[$z];
                                $route_plan_price_line_chk->express_road_price = $express_road_price_line[$z];
                                if ($route_plan_price_line_chk->save(false)){

                                }
                            }else{
                                $new_route_plan_price = new \common\models\RoutePlanPrice();
                                $new_route_plan_price->route_plan_id = $model->id;
                                $new_route_plan_price->car_type_id = $car_type_id[$z];
                                $new_route_plan_price->labour_price = $labour_price_line[$z];
                                $new_route_plan_price->express_road_price = $express_road_price_line[$z];
                                $new_route_plan_price->status = $model->status;
                                if ($new_route_plan_price->save(false)){

                                }
                            }
                        }
                    }
                }
            }


            $delete_rec = explode(",", $removelist);
            if (count($delete_rec)) {
                \common\models\RoutePlanLine::deleteAll(['id' => $delete_rec]);
            }
            $delete_rec2 = explode(",", $removelist2);
            if (count($delete_rec2)) {
                \common\models\RoutePlanPrice::deleteAll(['id' => $delete_rec2]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
            'model_line2' => $model_line2,
        ]);
    }

    /**
     * Deletes an existing Routeplan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
//        $this->findModel($id)->delete();

        $model_line = \common\models\RoutePlanLine::find()->where(['route_plan_id' => $id])->all();
        if ($model_line) {
            if (\common\models\RoutePlanLine::deleteAll(['route_plan_id' => $id])) {
                $this->findModel($id)->delete();
            }
        } else {
            $this->findModel($id)->delete();
        }

        $model_line2 = \common\models\RoutePlanPrice::find()->where(['route_plan_id' => $id])->all();
        if ($model_line2) {
            if (\common\models\RoutePlanPrice::deleteAll(['route_plan_id' => $id])) {
                $this->findModel($id)->delete();
            }
        } else {
            $this->findModel($id)->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Routeplan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Routeplan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RoutePlan::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
