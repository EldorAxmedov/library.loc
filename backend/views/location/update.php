<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Location $model */

$this->title = 'Joylashuvni yagilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Joylashuv', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
