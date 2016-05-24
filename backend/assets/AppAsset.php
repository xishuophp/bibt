<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

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
        //'static/css/site.css',
        //'static/css/bootstrap.min.css',
        'static/css/font-awesome.min.css',
        'static/css/ace-fonts.css',
        'static/css/jquery-ui.min.css',
        'static/css/chosen.css',
        'static/css/ace.min.css',
        'static/css/ace-skins.min.css',
        'static/css/ace-rtl.min.css',
    ];
    public $js = [
        'static/js/bootstrap.min.js',
        'static/js/ace.min.js',
        'static/js/ace-extra.min.js',
        'static/js/ace-elements.min.js',
        'static/js/spin.min.js',
        'static/js/bootbox.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
