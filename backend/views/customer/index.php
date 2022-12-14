<?php

use backend\models\Customer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\CustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">



    <p>
        <?= Html::a('สร้าง', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'code',
            'name',
            'business_type',
//            'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'label'=>'สถานะ',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        return '<div>ใช้งาน</div>';
                    } else {
                        return '<div>ไม่ใช้งาน</div>';
                    }
                }
            ],
            //'crated_at',
            //'created_by',
            //'updated_at',
            //'udpated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Customer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>



    <?php Pjax::end(); ?>

</div>
