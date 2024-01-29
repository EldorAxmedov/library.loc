<?php

use common\models\Books;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\BooksSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kitoblar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
            'options' => [
                'class' => 'pagination justify-content-center',
                'size' => 'lg',
            ],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'isbn',
            'udk',
            'bbk',
            'name',
            //'another_name',
            //'year_id',
            //'page',
            //'exemplary',
            //'language_id',
            //'type_id',
            //'annotation:ntext',
            [
                'attribute' => 'inventory_number',
                // add class to td
                'contentOptions' => ['class' => 'text-center'],
                // add class to th
                'headerOptions' => ['class' => 'text-center'],
            ],
            
            //'price',
            'count',
            //'location_id',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Books $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{view} {update} {delete} {inventory}',
                 'buttons' => [
                     'inventory' => function ($url, $model, $key) {
                        $isDisabled = $model->count == $model->getInventoryCount();
                         return Html::button('INV', [
                             'class' => 'btn btn-primary',
                             'disabled' => $isDisabled,
                             'onclick' => 'location.href="'.Url::toRoute(['book-inventory/inventory', 'id' => $model->id]).'"',
                         ]);
                     },
                 ],
            ],
        ],
    ]); ?>


</div>
