<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Books $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kitoblar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('O\'chirish', ['delete', 'id' => $model->id], [
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
            'isbn',
            'udk',
            'bbk',
            'name',
            'another_name',
            // 'country_id',
            [
                'attribute' => 'country_id',
                'value' => function ($model) {
                    return $model->country->name;
                }
            ],
            'region',
            'publisher',
            [
                'label' => 'Mualliflar',
                'value' => function ($model) {
                    $authors = $model->authors;
                    $authorNames = array_map(function ($author) {
                        return $author->full_name; // Adjust the attribute as per your Author model
                    }, $authors);
 
                    return implode(', ', $authorNames);
                },
            ],
            'year_id',
            'page',
            'exemplary',
            //'language_id',
            [
                'attribute' => 'language_id',
                'value' => function ($model) {
                    return $model->language->name;
                }
            ],
            //'type_id',
            [
                'attribute' => 'type_id',
                'value' => function ($model) {
                    return $model->type->name;
                }
            ],
            'annotation:ntext',
            // tags
            [
                'label' => 'Kalit so\'zlar',
                'value' => function ($model) {
                    $tags = $model->tags;
                    $tagNames = array_map(function ($tag) {
                        return $tag->name; // Adjust the attribute as per your Author model
                    }, $tags);
 
                    return implode(', ', $tagNames);
                },
            ],
            'inventory_number',
            'price',
            'count',
            //'location_id',
            [
                'attribute' => 'location_id',
                'value' => function ($model) {
                    return $model->location->name;
                }
            ],

            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y: H:i:s'],
            ],

            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y: H:i:s'],
            ],
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img('/uploads/books/' . $model->img,
                        ['width' => '70px']);
                },
            ],
        ],
    ]) ?>

</div>
