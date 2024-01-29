<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Country $model */

$this->title = 'Mamlakat qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Mamlakatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
