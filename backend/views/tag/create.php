<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Tag $model */

$this->title = 'Kalit so\'z qo\'shish';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
