<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'ผู้ใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <br>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            //  'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
//            'email:email',

//            'created_at',
//            'updated_at',
//            'verification_token',
            [
                'attribute' => 'usergroup_id',
                'value' => function ($data) {
                    return \backend\models\Usergroup::findName($data->usergroup_id);
                },
            ],
            [
                'attribute' => 'emp_ref_id',
                'value' => function ($data) {
                    return \backend\models\Employee::findName($data->emp_ref_id);
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($data) {
                    if($data->status == 1){
                        return '<div class="badge badge-success">Active</div>';
                    }else{
                        return '<div class="badge badge-secondary">Inactive</div>';
                    }
                },
            ],
        ],
    ]) ?>

</div>
