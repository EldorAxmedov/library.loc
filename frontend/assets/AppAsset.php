<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
        "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",
        "css/animate.css",
        "css/owl.carousel.css",
        //"css/font-awesome.min.css",
        "css/magnific-popup.css",
        "css/slicknav.min.css",
        "css/styles.css",
        "css/responsive.css"
    ];
    public $js = [
        "https://code.jquery.com/jquery-3.6.0.min.js",
        //"js/vendor/jquery-1.12.4.min.js",
        "js/bootstrap.min.js",
        "js/owl.carousel.min.js",
        "js/counterup.main.js",
        "js/imagesloaded.pkgd.min.js",
        "js/isotope.pkgd.min.js",
        "js/jquery.waypoints.min.js",
        "js/jquery.magnific-popup.min.js",
        "js/jquery.slicknav.min.js",
        "js/snake.min.js",
        "js/wow.min.js",
        "js/plugins.js",
        "js/scripts.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
