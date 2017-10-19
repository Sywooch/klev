<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\lc\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LcAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/lc/web';
    public $css = [
        'css/style.css',
        'css/media.css',
    ];
    public $js = [
        'js/scr.js',
        'http://api-maps.yandex.ru/2.1/?lang=ru_RU',
    ];
    public $publishOptions = [
        'forceCopy'=>true,
    ];

}
