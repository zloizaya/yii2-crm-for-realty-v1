<?php
namespace hail812\adminlte3\assets;

use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
    //public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
        'css/adminlte.min.css',
        'css/suggestions.min.css',
    ];

    public $js = [
        'js/adminlte.min.js',
        'js/jquery.suggestions.min.js',
    ];

    public $depends = [
        'hail812\adminlte3\assets\BaseAsset',
        'hail812\adminlte3\assets\PluginAsset'
    ];
}