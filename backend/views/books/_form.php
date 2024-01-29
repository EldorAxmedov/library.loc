<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\LanguageBook;
use common\models\Location;
use common\models\TypeBook;
use common\models\Tag;
use common\models\Knowledge;
use common\models\Subject;
use common\models\Author;
use common\models\Country;
use kartik\select2\Select2;
use yii\widgets\MaskedInput;
/** @var yii\web\View $this */
/** @var common\models\Books $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="books-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php
    if($model->isNewRecord){
        $tags = \yii\helpers\ArrayHelper::map(\common\models\BookTag::find()->where(['book_id' => $model->id])->all(), 'id', 'tag.name');
        $tags_str = implode(',', $tags);
        $authors = \yii\helpers\ArrayHelper::map(\common\models\BookAuthor::find()->where(['book_id' => $model->id])->all(), 'id', 'author.full_name');
        $authors_str = implode(',', $authors);
    }
    else{
        $tags_str = '';
        $authors_str = '';
    }
    ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'knowledge_id')->widget(Select2::classname(), [
                'model' => $model,
                'language' => 'ru',
                'name' => 'knowledge_id',
                'data' => Knowledge::getKnowledgeList(),
                'options' => [
                    'placeholder' => 'Bilimlar sohasi',
                    'multiple' => false],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => false,
                    'tokenSeparators' => [','],
                    'maximumInputLength' => 20,
                ] 
            ])->label('Bilimlar sohasi') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'subject_id')->widget(Select2::classname(), [
                'data' => Subject::getSubjectList(),
                'language' => 'ru',
                'options' => [
                    'placeholder' => 'Fanlar sohasini kiriting',
                    'multiple' => false],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                    'tokenSeparators' => [','],
                    'maximumInputLength' => 20,
                ],
            ])->label('Fanlar sohasi') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'udk')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'bbk')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'another_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= \dosamigos\selectize\SelectizeTextInput::widget([
         'name' => 'Books[book_author_join]',
         'loadUrl' => ['author/list'],
         'value' => $authors_str,
         'options' => [
             'class' => 'form-control',
             'placeholder' => 'Mualliflarni kiriting',
             //'multiple' => true
         ],
         'clientOptions' => [
             'plugins' => ['remove_button'],
             'valueField' => 'author',
             'labelField' => 'author',
             'searchField' => ['author'],
             'create' => true,
             'delimiter' => ',',
             'persist' => false,
             'createOnBlur' => true,
             'preload' => false,
          ],

    ])
    ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
                'data' => Country::getCountryList(),
                'language' => 'ru',
                'options' => [
                    'placeholder' => 'Mamlakatni tanlang',
                    'multiple' => false],
                'pluginOptions' => [
                    'allowClear' => true,
                    'tags' => true,
                    'tokenSeparators' => [','],
                    'maximumInputLength' => 20,
                ],
            ])->label('Mamlakatni tanlang') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'region')->textInput()->label('Shaharni kiriting') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'publisher')->textInput()->label('Nashriyotni kiriting') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'year_id')->textInput()->widget(MaskedInput::class,[
            'mask'=>'9999',
            ])?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'page')->textInput() ?>
        </div>
     </div>
     <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'exemplary')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'language_id')->dropDownList(LanguageBook::getLanguageBooks(), ['prompt' => 'Tilni tanlang'])?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'type_id')->dropDownList(TypeBook::getTypeBooks(), ['prompt' => 'Kitob turini tanlang'])?>
        </div>
    </div>

    <?= $form->field($model, 'annotation')->textarea(['rows' => 6]) ?>

    <?= \dosamigos\selectize\SelectizeTextInput::widget([
        'name' => 'Books[book_tag_join]',
        'loadUrl' => ['tag/list'],
        'value' => $tags_str,
        'options' => [
            'class' => 'form-control',
            'placeholder' => 'Kitobga teglar',
            'multiple' => true,
        ],
        'clientOptions' => [
            'plugins' => ['remove_button'],
            'valueField' => 'keyword',
            'labelField' => 'keyword',
            'searchField' => ['keyword'],
            'create' => true,
            'delimiter' => ',',
            'persist' => false,
            'createOnBlur' => true,
            'preload' => false,
        ],
    ])?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'inventory_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'count')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'location_id')->dropDownList(Location::getLocationBooks(), ['prompt' => 'Joylashuvini tanlang'])?>
        </div>
    </div>

    <?= $form->field($model, 'img')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php echo $form->errorSummary($model); ?>

    <?php ActiveForm::end(); ?>

</div>




