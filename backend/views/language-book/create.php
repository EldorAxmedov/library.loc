<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\LanguageBook $model */

$this->title = 'Tilni kiritish';
$this->params['breadcrumbs'][] = ['label' => 'Kitob tili', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
