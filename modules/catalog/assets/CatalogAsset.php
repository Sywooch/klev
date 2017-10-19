<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\catalog\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CatalogAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/catalog/web';
    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/scr.js',
    ];
    public $publishOptions = [
        'forceCopy'=>true,
    ];
}
