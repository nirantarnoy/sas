<?php

namespace backend\controllers;

use backend\models\Fueldailyprice;
use backend\models\FueldailypriceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FueldailypriceController implements the CRUD actions for Fueldailyprice model.
 */
class FueldailypriceController extends Controller
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
     * Lists all Fueldailyprice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FueldailypriceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fueldailyprice model.
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
     * Creates a new Fueldailyprice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Fueldailyprice();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $line_fuel_id = \Yii::$app->request->post('line_fuel_id');
                $line_fuel_price = \Yii::$app->request->post('line_fuel_price');
                $line_fuel_price_add = \Yii::$app->request->post('line_fuel_price_add');
                $line_fuel_price_total = \Yii::$app->request->post('line_fuel_price_total');

                $res = 0;

                if($line_fuel_id != null){
                    for($x=0;$x<=count($line_fuel_id)-1;$x++){
                        $model_x = new \backend\models\Fueldailyprice();
                        $model_x->fuel_id= $line_fuel_id[$x];
                        $model_x->price_date = date('Y-m-d H:i:s');
                        $model_x->price_origin = $line_fuel_price[$x];
                        $model_x->price_add = $line_fuel_price_add[$x];
                        $model_x->price = $line_fuel_price[$x];
                        $model_x->status = 1;
                        if($model_x->save(false)){
                            $res+=1;
                        }
                    }
                }

                  if($res > 0){
                      return $this->redirect(['index']);
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
     * Updates an existing Fueldailyprice model.
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
     * Deletes an existing Fueldailyprice model.
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
     * Finds the Fueldailyprice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Fueldailyprice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fueldailyprice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetapiprice(){
        $html = '';

        $model = \common\models\FuelPrice::find()->all();
        if($model){
            foreach($model as $value){
                $oil_id = $value->fuel_id;
                $oil_name = \backend\models\Fuel::findName($value->fuel_id);
                $price = $value->price;

                $html.='<tr>';
                $html.='<td> <input type="hidden" name="line_fuel_id[]" class="form-control line-fuel-id" value="'.$oil_id.'" />'.$oil_name;
                $html.='</td>';
                $html.='<td> <input style="text-align: right;" type="text" name="line_fuel_price[]" class="form-control line-fuel-price" readonly value="'.$price.'" />';
                $html.='</td>';
                $html.='<td><input style="text-align: right;" type="text" name="line_fuel_price_add[]" class="form-control line-fuel-price-add" value="0" />';
                $html.='</td>';
                $html.='<td><input style="text-align: right;" type="text" name="line_fuel_price_total[]" class="form-control line-fuel-price-total" readonly value="0" />';
                $html.='</td>';
                $html.='<td>';
                $html.='</td>';
                $html.='</tr>';
            }
        }

        echo $html;
    }
}
