<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\bootstrap4\Modal;
/** @var yii\web\View $this */
/** @var common\models\Customer $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
    <!-- search inputs start -->
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" id="inventory-id" name="inventory-id" class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="button" class="btn btn-success" id="inventory-search" value="Qidirish">
                </div>
            </div>
        </div>    
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" id="user-id" name="user-id" class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="button" class="btn btn-success" id="user-search" value="Qidirish">
                </div>
            </div>
        </div>
    </div>
    <!-- search inputs end -->

    <!-- form model start -->
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'inventory_number')->textInput(['placeholder'=>"Inventar raqami"])->label("Inventar raqami") ?>
            <?= $form->field($model, 'book_id')->textInput(['placeholder'=>"Kitob IDsi"])->label("Kitob IDsi") ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'user_id')->textInput(['placeholder'=>'Xodim IDsi'])->label("Xodim IDsi") ?>
        </div>
    </div>
 <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'get_date')->widget(DatePicker::classname(), [
      'id' => 'get-date-input', // Add an ID to the get_date input
    'options' => ['placeholder' => 'Select date', 'value' => date('Y-m-d')],
    'pluginOptions' => [        
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true

    ]
]); ?>
    </div>
    <div class="col-md-6">

<?= $form->field($model, 'final_date')->widget(DatePicker::classname(), [     
    'options' => ['placeholder' => 'Select date', 'value' => date('Y-m-d', strtotime('+15 days'))],    
     'pluginOptions' => [
        'autoclose' => true,
        
        // format timestamp
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true
    ]
]); ?>

    </div>
    </div>
    </div>
    <div class="col-md-6" id="book-form">
    </div>
    </div>

    <div class="row">
    <div class="col-md-6">
    <div class="text-center">
            <h3>Kitob haqida ma'lumot</h3>
        </div>
     <label for="book-name">Kitob nomi:</label>
    <input type="text" id="book-name" name="book-name" class="form-control" disabled>
    <label for="book-author">Kitob muallif(lar)i:</label>
    <input type="text" id="book-author" name="book-author" class="form-control" disabled>
    <label for="book-genre">Kitob kategoriyasi:</label>
    <input type="text" id="book-genre" name="book-genre" class="form-control" disabled>
    <label for="book-language">Kitob tili:</label>
    <input type="text" id="book-language" name="book-language" class="form-control" disabled>
    <label for="book-year">Kitob yili:</label>
    <input type="text" id="book-year" name="book-year" class="form-control" disabled>
    <label for="book-pages">Kitob sahifalari:</label>
    <input type="text" id="book-pages" name="book-pages" class="form-control" disabled>
    <label for="book-img">Kitob rasmi:</label>
    <img src="" alt="" id="book-img" class="img-fluid" whidth="200">
    </div>
    <div class="col-md-6">
    <div class="text-center">
            <h3>Xodim haqida ma'lumot</h3>
        </div>
    <label for="customer-name">Xodim ismi:</label>
    <input type="text" id="customer-name" name="customer-name" class="form-control" disabled>
    <label for="customer-department">Bo'lim:</label>
    <input type="text" id="customer-department" name="customer-department" class="form-control" disabled>
    <label for="customer-position">Lavozimi:</label>
    <input type="text" id="customer-position" name="customer-position" class="form-control" disabled>
    <label for="customer-employee-type">Lavozim turi:</label>
    <input type="text" id="customer-employee-type" name="customer-employee-type" class="form-control" disabled>
    <label for="customer-employee-form">Mehnat shakli:</label>
    <input type="text" id="customer-employee-form" name="customer-employee-form" class="form-control" disabled>
    <label for="customer-employee-status">Mehnat holati:</label>
    <input type="text" id="customer-employee-status" name="customer-employee-status" class="form-control" disabled>
    <label for="customer-img">Foydalanuvchi rasmi:</label>
    <img src="" alt="" id="customer-img" class="img-fluid" whidth="200">
    </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-block btn-success', 'id'=>'submit-button']) ?>
    </div>
    <?php echo $form->errorSummary($model); ?>
    <?php ActiveForm::end(); ?>
   
</div>
<?php
$js = <<<JS
 $(document).ready(function() {
    $('#inventory-search').on('click', function() {

    var inventory_id = $('#inventory-id').val();       
        $.ajax({
    url: '/admin/book-inventory/list?query=' + inventory_id,
    type: 'POST',
    success: function(data) {        
        console.log("Received data:", data); // Add this line for debugging
        $('#customeremployee-inventory_number').val(inventory_id);
        $('#customeremployee-book_id').val(data.book_id);
        $('#book-name').val(data.name);
        // authors array to string
        let authors = data.authors.map(function(author) {
            return author.full_name;
        }).join(', ');
        $('#book-author').val(authors);
        $('#book-genre').val(data.category);
        $('#book-language').val(data.language);
        $('#book-year').val(data.publish_year);
        $('#book-pages').val(data.pages);
        // set book_id_required to true
        $('#customer-book_id_required').val(1);
        if (data.img == '') {
            data.img = '/images/no_image.png';
        $('#book-img').attr('src', data.img);
        }
        else{
        $('#book-img').attr('src', '/uploads/books/' + data.img);
        }
        
    },
    error: function(xhr, status, error) {
        if (xhr.status == 400) {
            alert('Kitob berilgan');
        }
        else{
            alert('Kitob topilmadi');
        }
    }
});
        
    });
    $('#user-search').on('click', function() {
        var user_id = $('#user-id').val();        
        $.ajax({
    url: '/admin/employee/get-me?query=' + user_id,
    type: 'POST',

    success: function(data) {
        console.log("Received data:", data); // Add this line for debugging
        if (data.error){
            alert(data.error);
        }else{
        $('#customeremployee-user_id').val(user_id);
        $('#customer-name').val(data.full_name);
        $('#customer-department').val(data.department_name);
        $('#customer-position').val(data.staff_position_name);
        $('#customer-employee-type').val(data.employee_type_name);
        $('#customer-employee-form').val(data.employment_form_name);
        $('#customer-employee-status').val(data.employee_status_name);
        if (data.image == '') {
            data.image = '/images/no_image.png';
            $('#customer-img').attr('src', data.image);
        }
        else{
        $('#customer-img').attr('src', data.image);
        }
    }        
    },
    error: function(xhr, status, error){
        //console.log(error); // Add this line for debugging
    }
    });            
    });    
});

$(document).ready(function() {
    
    $('#customer-get_date').on('change', function() {        
        // Get the selected date from the get_date input
        var selectedDate = $(this).val();
        // Calculate the final date based on the selected date
        // For example, here we add 15 days to the selected date
        var finalDate = new Date(selectedDate);
        finalDate.setDate(finalDate.getDate() + 15);
        // Format the final date as 'yyyy-mm-dd'
        var finalDateFormatted = finalDate.toISOString().slice(0, 10);
        // Set the value of the final_date input to the calculated final date
        $('#customer-final_date').val(finalDateFormatted);
    });
});
JS;
$this->registerJs($js);
?>