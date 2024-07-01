<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Todolist $model */

$this->title = $model->todolist_no;
$this->params['breadcrumbs'][] = ['label' => 'Todolists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="todolist-view">

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
         //   'id',
            'todolist_no',
            'trans_date',
            'machine_name',
            'machine_type_name',
            'brand_name',
            'todolist_name',
            'assign_emp_id',
            'target_date',
//            'created_at',
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('Y-m-d H:i:s', $data->created_at);
                }
            ],
//            'created_by',
            [
                'attribute' => 'created_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->created_by);
                }
            ],
//            'updated_at',
            [
                'attribute' => 'updated_at',
                'value' => function ($data) {
                    return date('Y-m-d H:i:s', $data->updated_at);
                }
            ],
//            'updated_by',
            [
                'attribute' => 'updated_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->updated_by);
                }
            ],
        ],
    ]) ?>

</div>
