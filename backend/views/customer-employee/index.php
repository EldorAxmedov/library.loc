<?php

use common\models\CustomerEmployee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Xodim - Kitob berish';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <p>
        <?= Html::a('Kitob berish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax'=>true,
        'export'=>false,
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
            'user_id',
            [
                'attribute' => 'get_date',
                'value' => function ($model) {
                    return date('d.m.Y', $model->get_date);
                },
                'filterType' => \kartik\date\DatePicker::class,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        // format timestamp
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true,
                    ],
                ],
                'options' => [
                    // clear input on focus
                    'autocomplete' => 'off'
                ]
            ],        
            [
                'attribute' => 'final_date',
                'value' => function ($model) {
                    return date('d.m.Y', $model->final_date);
                },
                'filterType' => \kartik\date\DatePicker::class,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        // format timestamp
                        'format' => 'dd.mm.yyyy',
                        'todayHighlight' => true,
                    ],
                ],
            ],
            [
                'attribute' => 'inventory_number',
                'value' => 'inventory_number'                
            ],        
            [
                'attribute' => 'submission',
                'format' => 'raw',
                'value' => function ($model) {
                    $badgeWidth = '100px';     // Set the width you want for the badge
                    $badgeHeight = '30px';    // Set the height you want for the badge
                    $textSize = '14px';       // Set the font size for the badge text
            
                    if ($model->submission == 0) {
                        return '<span class="badge badge-danger" style="width: ' . $badgeWidth . '; height: ' . $badgeHeight . '; font-size: ' . $textSize . '">Qaytarmagan</span>';
                    } else {
                        return '<span class="badge badge-success" style="width: ' . $badgeWidth . '; height: ' . $badgeHeight . '; font-size: ' . $textSize . '">Qaytargan</span>';
                    }
                },
                'filter' => [
                    0 => 'Qaytarmagan',
                    1 => 'Qaytargan',
                ],
            ],
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CustomerEmployee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }              
                 
            ],
        ],
    ]); ?>


</div>
