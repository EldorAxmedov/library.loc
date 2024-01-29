<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\CustomerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?> 
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'book_id') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'user_id') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'get_date') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'final_date') ?>
        </div>
    </div>
    <?php // echo $form->field($model, 'submission') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
