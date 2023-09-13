<?php

use backend\models\Customerinvoice;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\CustomerinvoiceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'วางบิล';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customerinvoice-index">

    <p>
        <?= Html::a('สร้างใบวางบิล', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'invoice_no',
            'invoice_date',
            'invoice_target_date',
            'sale_id',
            //'work_name',
            //'customer_id',
            //'total_amount',
            //'vat_amount',
            //'vat_per',
            //'total_all_amount',
            //'total_text',
            //'remark',
            //'remark2',
            //'create_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'status',
            //'customer_extend_remark',
            //'company_extend_remark',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Customerinvoice $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
