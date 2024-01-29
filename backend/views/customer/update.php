<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Customer $model */

$this->title = 'Ma\'lumotlarni yangilash: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kitobxon', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="customer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
