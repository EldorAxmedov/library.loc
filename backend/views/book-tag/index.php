<?php

use common\models\BookTag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\BookTagSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kitob-Kalit so\'z';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-tag-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'book_id',
            'tag_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BookTag $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                    'template' => '{view} {delete}'
            ],
        ],
    ]); ?>


</div>
