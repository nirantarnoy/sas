<?php

use backend\models\Fueldailyprice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\FueldailypriceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ราคาน้ำมันประจำวัน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fueldailyprice-index">

    <p>
        <?= Html::a('Create Fueldailyprice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'fuel_id',
            'province_id',
           // 'city_id',
            'price_date',
            'price',
            //'status',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Fueldailyprice $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
