<?php

use common\models\BookAuthor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\BookAuthorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Kitob-Muallif';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-author-index">

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
            'author_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, BookAuthor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{view} {delete}'

            ],
        ],
    ]); ?>


</div>
