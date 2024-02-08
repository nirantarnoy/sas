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
class CashreportdailyController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionReportcashrecord(){
        $search_date = \Yii::$app->request->post('search_date');
        $search_cost_type = \Yii::$app->request->post('search_cost_type');
        return $this->render('_cashreport',[
            'search_date' => $search_date,
            'search_cost_type' => $search_cost_type,
        ]);
    }
}