<?php

use common\models\Customer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Qarzdorlar ro\'yxati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">
   
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    yii\bootstrap4\Modal::begin(
        [
            'id' =>'modal',
            'bodyOptions' => [
                'class' => 'modal-body',
            ],
        ]);
    echo "<div id='modalContent'>fdgfdgdsgds</div>";
    
    yii\bootstrap4\Modal::end();
?>

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
            'inventory_number',
            'submission',  
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Customer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{return}',
                 'buttons' => [
                     'return' => function ($url, $model, $key) {
                         return Html::button('Qaytarish', [
                             'class' => 'btn btn-success',
                             'data' => [
                                 'key' => $key,                               
                             ],
                         ]);
                     },
                 ],                 
            ],
        ],
    ]); ?>


</div>
<?php

$js = <<<JS
   $('.btn-success').on('click', function(e) {
   e.preventDefault();
  // Get the model ID from the data-key attribute of the button's parent row
  var modelId = $(this).closest('tr').data('key'); 
  var inventory_number = $(this).closest('tr').find('td').eq(6).text(); 
  console.log(inventory_number);
  if (confirm("Kitobni qaytarmoqchimisiz?")) {
    send(modelId, inventory_number);
  } else {
    return false;
  }
  location.reload(); 
});
function send(id, inventory_number) {
    console.log(id);  
    $.ajax({
        url: 'return-book',        
        data: {id: id, inventory_number: inventory_number},
        success: function(res){
            alert("Kitob qaytarildi");         
        },
        error: function(error){
            console.log(error);
        }
    });
}

JS;
$this->registerJs($js);

?>


