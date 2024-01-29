<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\BooksSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'isbn') ?>

    <?= $form->field($model, 'udk') ?>

    <?= $form->field($model, 'bbk') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'another_name') ?>

    <?php // echo $form->field($model, 'year_id') ?>

    <?php // echo $form->field($model, 'page') ?>

    <?php // echo $form->field($model, 'exemplary') ?>

    <?php // echo $form->field($model, 'language_id') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'annotation') ?>

    <?php // echo $form->field($model, 'inventory_number') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
