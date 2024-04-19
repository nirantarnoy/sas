<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Usergroup */

$this->title = 'สร้างกลุ่มผู้ใช้งาน';
$this->params['breadcrumbs'][] = ['label' => 'ผู้ใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usergroup-create">

    <br>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
