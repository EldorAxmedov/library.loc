<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\TypeBook $model */

$this->title = 'Kitob turi qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Kitob turi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
