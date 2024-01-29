<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BookInventory $model */

$this->title = 'Create Book Inventory';
$this->params['breadcrumbs'][] = ['label' => 'Book Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-inventory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
