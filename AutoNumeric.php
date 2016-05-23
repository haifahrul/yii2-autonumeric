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

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class AutoNumeric extends InputWidget
{
    public $pluginOptions = [];
    protected $_pluginName = 'autoNumeric';
    private $_inputOptions = [];

    public function init()
    {
        parent::init();
        $this->initPluginOptions();
        $this->_inputOptions = $this->options;
        $this->_inputOptions['id'] .= '-disp';
        if (isset($this->_inputOptions['name'])) {
            unset($this->_inputOptions['name']);
        }
        $this->registerAssets();
        $this->renderInput();
    }

    /**
     * Load default plugin options from params autoNumeric section
     */
    protected function initPluginOptions()
    {
        if (!empty(Yii::$app->params['autoNumericOptions'])) {
            $this->pluginOptions += Yii::$app->params['autoNumericOptions'];
        } else {
            $this->setDefaultFormat('decimalSeparator', 'aDec');
            $this->setDefaultFormat('thousandSeparator', 'aSep');
        }
    }

    /**
     * Load options from Yii::$app->formatter
     */
    protected function setDefaultFormat($paramFrom, $paramTo)
    {
        $formatter = Yii::$app->formatter;
        if (empty($this->pluginOptions[$paramTo]) && !empty($formatter->$paramFrom)) {
            $this->pluginOptions[$paramTo] = $formatter->$paramFrom;
        }
    }

    /**
     *  Register assets.
     */
    public function registerAssets()
    {
        $view = $this->getView();
        AutoNumericAsset::register($view);

        $id = 'jQuery("#' . $this->_inputOptions['id'] . '")';
        $idSave = 'jQuery("#' . $this->options['id'] . '")';
        $plugin = $this->_pluginName;
        $pluginOptions = Json::encode($this->pluginOptions);
        $js = <<< JS
            var val = parseFloat({$idSave}.val());
            {$id}.{$plugin}('init', {$pluginOptions});
            {$id}.{$plugin}('set', val);
            {$id}.on('change', function () {
                 var unformatted = {$id}.{$plugin}('get');
                {$idSave}.val(unformatted);
                {$idSave}.trigger('change');
            });
JS;
        $view->registerJs($js);
    }

    /**
     * Render hidden "real" input and visible input for formatted value
     */
    protected function renderInput()
    {
        $name = $this->_inputOptions['id'];
        Html::addCssClass($this->_inputOptions, 'form-control');
        $input = Html::textInput($name, $this->value, $this->_inputOptions);
        $input .= $this->hasModel() ?
            Html::activeHiddenInput($this->model, $this->attribute, $this->options) :
            Html::hiddenInput($this->name, $this->value, $this->options);
        echo $input;
    }
}
