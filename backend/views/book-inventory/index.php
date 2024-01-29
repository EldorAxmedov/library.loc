<?php

use common\models\BookInventory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\BookInventorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kitobning inventar raqamlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?//= Html::a('Create Book Inventory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
            'options' => [
                'class' => 'pagination justify-content-center',
                'size' => 'lg',
            ],
        ],
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'book_id',
            'inventory_number',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    $badgeWidth = '150px';     // Set the width you want for the badge
                    $badgeHeight = '30px';    // Set the height you want for the badge
                    $textSize = '14px';       // Set the font size for the badge text
            
                    if ($model->status == 1) {
                        return '<span class="badge badge-danger" style="width: ' . $badgeWidth . '; height: ' . $badgeHeight . '; font-size: ' . $textSize . '">Berilgan</span>';
                    } else {
                        return '<span class="badge badge-success" style="width: ' . $badgeWidth . '; height: ' . $badgeHeight . '; font-size: ' . $textSize . '">Kutubxonada mavjud</span>';
                    }
                },
                'filter' => [
                    0 => 'Kutubxonada bor',
                    1 => 'Berilgan',
                ],
            ],            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BookInventory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
