<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'js/sweeper/swiper.min.css',
        'js/sweeper/custom/custom.css',
        '/fonts/fonts.css',
        'js/lightslider/lightgallery.css',
        'css/flipclock.css',
        'css/style_media.css',
        'js/slick/slick-theme.css',
        'js/slick/slick.css',

    ];
    public $js = [
        'js/sweeper/swiper.min.js',
        'js/lightslider/lightgallery-all.min.js',
        'js/lightslider/lg-thumbnail.min.js',
        'js/lightslider/lg-fullscreen.min.js',
        'js/script.js',
        'js/clipboard.min.js',
        'js/jquery.matchHeight-min.js',
        'js/slick/slick.js',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
