<?php

/**
 * @package   yii2-autoNumeric
 * @author    Ahmad Fakhrurozi Syah <haifahrul@gmail.com>
 * @copyright Copyright &copy; Ahmad Fakhrurozi Syah, 2016
 * @version   1.0.0
 * Asset bundle for the [[AutoNumerical]] widget. Includes client assets from
 * [autoNumeric](https://github.com/BobKnothe/autoNumeric).
 */

namespace haifahrul\autonumeric;

use yii\web\AssetBundle;

class AutoNumericAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/autoNumeric';
    public $js = [
        'autoNumeric.js'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}
