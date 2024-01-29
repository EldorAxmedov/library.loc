<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Location $model */

$this->title = 'Joylashuvni kiritish';
$this->params['breadcrumbs'][] = ['label' => 'Joylashuv', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
