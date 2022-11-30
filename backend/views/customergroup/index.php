<?php

use backend\models\Customergroup;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\CustomergroupSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'กลุ่มลูกค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customergroup-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

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

            // 'id',
            'name',
            'description',
            // 'status',
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
            // 'company_id',
            [
                'attribute' => 'company_id',
                'value' => function ($model){
                    return \backend\models\Company::findCompanyName($model->company_id);
                }
            ],
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Customergroup $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
