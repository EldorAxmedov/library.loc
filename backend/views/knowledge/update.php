<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Knowledge $model */

$this->title = 'Bilimlar sohasini yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bilimlar sohasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="knowledge-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
