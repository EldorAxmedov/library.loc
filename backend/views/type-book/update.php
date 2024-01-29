<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TypeBook $model */

$this->title = 'Kitob turini yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kitob turi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="type-book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
