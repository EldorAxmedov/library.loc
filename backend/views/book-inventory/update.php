<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BookInventory $model */

$this->title = 'Update Book Inventory: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Book Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="book-inventory-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
