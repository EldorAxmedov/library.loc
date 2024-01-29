<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Customer $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kitobxonlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'book_id',
            'user_id',
            [
                'attribute' => 'get_date',
                'value' => function($model){
                    return date('Y-m-d', $model->get_date);
                }
            ],
            [
                'attribute' => 'final_date',
                'value' => function($model){
                    return date('Y-m-d', $model->final_date);
                }
            ],            
            [
                'attribute' => 'submission',
                // set color for status
                'format' => 'raw',
                'value' => function ($model) {
                    $badgeWidth = '120px';     // Set the width you want for the badge
                    $badgeHeight = '30px';    // Set the height you want for the badge
                    $textSize = '16px';       // Set the font size for the badge text
            
                    if ($model->submission == 0) {
                        return '<span class="badge badge-danger" style="width: ' . $badgeWidth . '; height: ' . $badgeHeight . '; font-size: ' . $textSize . '">Qaytarmagan</span>';
                    } else {
                        return '<span class="badge badge-success" style="width: ' . $badgeWidth . '; height: ' . $badgeHeight . '; font-size: ' . $textSize . '">Qaytargan</span>';
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date('Y-m-d H:i:s', $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model){
                    return date('Y-m-d H:i:s', $model->updated_at);
                }
            ],
        ],
    ]) ?>

</div>