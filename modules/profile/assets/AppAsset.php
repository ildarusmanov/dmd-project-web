<?php
/**
 * @link http:www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http:www.yiiframework.com/license/
 */

namespace app\modules\profile\assets;

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
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
        'css/app.css',
        'flatui/css/flat-ui.min.css',
        'font-awesome/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Open+Sans',
        'profile/css/messages.css',
        'profile/css/bills.css',
        'profile/css/custom.css',
    ];

    public $js = [
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
        'profile/js/sidebar.js',
        'js/app.js',
        'flatui/js/flat-ui.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
