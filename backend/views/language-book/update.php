<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LanguageBook $model */

$this->title = 'Kitob tilini yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kitob tili', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="language-book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
