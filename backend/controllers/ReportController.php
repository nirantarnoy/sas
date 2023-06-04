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
class ReportController extends Controller
{
    public function actionReport1(){
      return $this->render('_report1');
    }
    public function actionReport2(){
        return $this->render('_report2');
    }
}