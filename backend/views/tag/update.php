<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tag $model */

$this->title = 'Kalit so\'zni yangilash: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kalit so\'zlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Yangilash';
?>
<div class="tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
