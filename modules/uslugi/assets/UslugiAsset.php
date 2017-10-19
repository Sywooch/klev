<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\uslugi\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UslugiAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/uslugi/web';
    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/scr.js',
    ];
    public $publishOptions = [
        'forceCopy'=>true,
    ];
}
