<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Knowledge $model */

$this->title = 'Bilimlar sohasi';
$this->params['breadcrumbs'][] = ['label' => 'Bilimlar sohasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="knowledge-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
