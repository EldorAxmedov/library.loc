<?php


$this->title                   = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-xs-12">
    <div class="seemore-btn text-center login-page">
        <?php $choice = \yii\authclient\widgets\AuthChoice::begin(['baseAuthUrl' => ['site/auth']]) ?>

        <div class="col"></div>
        <?php foreach ($choice->getClients() as $client): ?>
            <div class="col">
                <a href="<?= $choice->createClientUrl($client) ?>" class="auth-link btn btn-secondary" style="padding:40px"> <?= $client->getName() ?> <p class="text-white">tizimi orqali kirish</p></a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php \yii\authclient\widgets\AuthChoice::end() ?>
                        </div>
     
