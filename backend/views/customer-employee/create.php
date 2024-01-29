<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CustomerEmployee $model */

$this->title = 'Xodim - Kitob berish';
$this->params['breadcrumbs'][] = ['label' => 'Mijozlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
