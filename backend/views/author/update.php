<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Author $model */

$this->title = 'Muallifni yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Muallif', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
