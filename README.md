AutoNumericJs 1.9.43
=============

autoNumeric is a jQuery plugin that automatically formats currency and numbers as you type on form inputs.

[![Total Downloads](https://poser.pugx.org/haifahrul/yii2-autonumeric/downloads)](https://packagist.org/packages/haifahrul/yii2-autonumeric)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist haifahrul/yii2-autonumeric "*"
```

or add

```
"haifahrul/yii2-autonumeric": "*"
```

to the require section of your `composer.json` file.

Formatter Settings (optional)
-----------------------------

Default the thousandSeparator and decimalSeparator from Yii::$app->formatter, you can settings in your configuration file like below:
``` php
'components' => [
    'formatter' => [
        'class' => 'yii\i18n\formatter',
        'thousandSeparator' => '.',
        'decimalSeparator' => ',',
    ]
]
```

Usage
-----

Once the extension is installed, simply use it in your code by:

The complete list of options are below.
There are multiple ways of changing the options. To format "123456789.00" to "Rp. 123.456.789" you could do the following:
```php
<?= $form->field($model, 'price')->widget(\haifahrul\autonumeric\AutoNumeric::classname(), [
        'value' => $model->price,
        'options' => [
            'id' => 'your-id',
            'class' => 'your-class',
            'readonly' => true,
            'disabled' => true,
        ],
        'pluginOptions' => [
            'aSep' => '.', // if you using Formatter Settings, this is not necessary
            'aDec' => ',', // if you using Formatter Settings, this is not necessary
            'aSign' => 'Rp. ',
            'mDec' => '0' // default 2
        ]
    ]);
?>
```

Other options you can see at http://www.yiiframework.com/doc-2.0/guide-helper-html.html

An example and other plugin options, you can see autoNumeric docs: [https://github.com/BobKnothe/autoNumeric](https://github.com/BobKnothe/autoNumeric).

Thanks to extead. https://github.com/extead
