<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\rescenter\assets;

use yii\web\AssetBundle;
use const YII_DEBUG;

/**
 * Description of SiteAssets
 *
 * @author Administrator
 */
class ResCenterAssets extends AssetBundle{
    //put your code here
    public $sourcePath = '@frontend/modules/rescenter/assets';
    public $depends = [
        'yii\web\YiiAsset'
    ];
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
    public $css = [
        'css/rescenter.css',
    ];
    public $js = [
        
    ];
}
