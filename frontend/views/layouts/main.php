<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<div id="cssLoader3" class="preloder-wrap">
<div class="loader">
    <div class="child-common child4"></div>
    <div class="child-common child3"></div>
    <div class="child-common child2"></div>
    <div class="child-common child1"></div>
</div>
</div>

<!-- heared area start -->
<header class="header-area header-area2">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="header-top-left">
                        <p>Kutubxona axborot tizimi</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="header-top-right text-right">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        </ul>
             
                    </div>                    
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class = "text-center">
                <?php
                            //$fullName = Yii::$app->user->identity->full_name;
                            if (Yii::$app->user->isGuest) {
                                echo Html::a('Tizimga kirish', ['/site/login'], ['style' => 'color: #fff; margin-left: 30px; background-color: #296dc1; padding: 10px 15px; border-radius: 5px; size: 20px;']);
                            } else {
                                echo Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'Tizimdan chiqish',
                                        ['style' => 'color: #fff; margin-left: 30px; background-color: #296dc1;  border-radius: 5px; size: 10px; padding: 5px 5px;']
                                    )
                                    . Html::endForm();
                            }                
                ?>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom  bg-2"  id="sticky-header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-8 col-xs-6">
                    <div class="logo">
                        <h1><a href="<?=Yii::$app->homeUrl?>">KAT</a></h1>
                    </div>
                </div>
                <div class="col-md-8 hidden-sm hidden-xs">
                    <div class="mainmenu">
                        <ul id="navigation">
                            <li><a href="<?=Url::to(['/site/literatures'])?>">Adabiyotlar</a>                                
                            </li>
                            <li><a href="#">Maqolalar</a>                               
                            </li>
                            <li><a href="#">Dissertatsiyalar</a>
                            </li>
                            <li><a href="#">Monografiyalar</a>
                            </li>                          
                            <li><a href="#">Jurnallar</a>
                            </li>
                            <li style="display:block; border-color:white"><a href="<?=Url::to(['/user/get-me'])?>"><i class="fa fa-address-card-o user-profile"></i></a></li>                               
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- heared area end -->
<!-- slider area start -->
<section class="slider-area">
    <div class="slider-active3 slider-next-prev-style">

    </div>
</section>
<!-- slider area end -->
<!-- .service-area start -->
<?=$content?>

<!-- footer-area start  -->
<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 col wow fadeInUp" data-wow-delay=".2s">
                    <div class="footer-widget footer-menu">
                        <a href="<?= Yii::$app->homeUrl?>"><img src="/images/SamITTechnology.png"></a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 col wow fadeInUp" data-wow-delay=".1s">
                    <div class="footer-widget footer-logo">
                        <h1>KAT</h1>
                        <p>Samarkand, 140104, UZB, Bostonsaroy 93</p>
                        <ul>
                            <li><i class="fa fa-phone"></i> +998 66 238-29-47</li>
                            <li><i class="fa fa-envelope"></i> info@samdchti.uz</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 col wow fadeInUp" data-wow-delay=".2s">
                    <div class="footer-widget footer-menu">
                        <h2>Меню</h2>
                        <ul>
                        <li><a href="about.html">Adabiyotlar</a>                                
                            </li>
                            <li><a href="service.html">Maqolalar</a>                               
                            </li>
                            <li><a href="service.html">Dissertatsiyalar</a>
                            </li>
                            <li><a href="service.html">Monografiyalar</a>
                            </li>
                            <li><a href="service.html">Mualliflar</a>
                            </li>
                            <li><a href="service.html">Jurnallar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" style="color: white;">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer-area end  -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
