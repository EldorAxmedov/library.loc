<?php
use yii\helpers\Html;
?>
  <div class="text-center login-box">
    <div class="text-center">
        <img src="https://i.ibb.co/rshckyB/car-key.png" border="0" class="mb-5">
    </div>
    <div class="text-center">                              
        <?php $form = \yii\bootstrap5\ActiveForm::begin(['id' => 'login-form']) ?>
        <?= $form->field($model,'username')
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
  
        <?= $form->field($model, 'password')
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => '<div class="icheck-primary">{input}Eslab qolish</div>',
                    'labelOptions' => [
                        'class' => ''
                    ],
                    'uncheck' => null
                ]) ?>
            </div>
            <div class="col-8">
                <?= Html::submitButton('Tizimga kirish', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>
        </div>

        <?php \yii\bootstrap5\ActiveForm::end(); ?>        
    </div>
    <!-- /.login-card-body -->
