<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Country $model */

$this->title = 'Mamlakatni yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mamlakatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
