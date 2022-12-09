<?php

use Yii;
use app\modules\base\models\Base;
use app\modules\clients\models\Clients;
use app\modules\export\models\Export;
use app\modules\base\models\Communication;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use corpsepk\DaData\SuggestionsWidget;
use dosamigos\ckeditor\CKEditor;
use dosamigos\multiselect\MultiSelect;
use kartik\select2\Select2;
use kartik\file\FileInput;

$region = '';
$city = '';
$street = '';
$house = '';

$script = <<< JS
var token = "643fa8d6eea841cd698e05e7bae37f3d1af8795f";

var type  = "ADDRESS";
let $region = $("#region");
let $city   = $("#city");
let $street = $("#street");
let $house  = $("#house");

// регион и район
$("#region").suggestions({
  token: token,
  type: type,
  hint: false,
  bounds: "region-area"
});

// город и населенный пункт
$("#city").suggestions({
  token: token,
  type: type,
  hint: false,
  bounds: "city-settlement",
  constraints: region
});

// улица
$("#street").suggestions({
  token: token,
  type: type,
  hint: false,
  bounds: "street",
  constraints: city,
  count: 15
});

// дом
$("#house").suggestions({
  token: token,
  type: type,
  hint: false,
  noSuggestionsHint: false,
  bounds: "house",
  constraints: street
});
JS;
$position = $this::POS_END;
$this->registerJs($script, $position);

?>

<div class="card card-primary">
    <?php $form = ActiveForm::begin(
        [
            'id' => 'kv-form',
        ]
    ); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'typeAds')->widget(Select2::classname(), [ 
                        'data' => Base::getAdsArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Тип объявления'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'typeKv')->widget(Select2::classname(), [ 
                        'data' => Base::getKvArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Квартира'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'step')->widget(Select2::classname(), [ 
                        'data' => Base::getStepArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Тип объекта'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'client')->widget(Select2::classname(), [ 
                        'data' => ArrayHelper::map(Clients::getAll(), 'id', 'fullName'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Собственник...'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'agent')->widget(Select2::classname(), [ 
                        'data' => ArrayHelper::map(Base::getAgents(), 'id', 'full_name'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Агент...'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'land')->textInput(['placeholder'=>'Регион', 'id' => 'region'])->label(false) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'city')->textInput(['placeholder'=>'Город', 'id' => 'city'])->label(false) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'street')->textInput(['placeholder' => 'Улица', 'id' => 'street'])->label(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'house')->textInput(['placeholder' => 'Дом', 'id' => 'house'])->label(false) ?>
            </div>
            <div class="col-md-1">
                <?= $form->field($model, 'kv')->textInput(['placeholder' => 'Квартира'])->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'price_sale')->widget(\yii\widgets\MaskedInput::class, [
                        'options' => ['placeholder' => 'Цена продажи'],
                        'clientOptions' => [
                            'alias' => 'decimal', 
                            'digits' => 2, 
                            'digitsOptional' => false,
                            'radixPoint' => '.',
                            'groupSeparator' => ',', 
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                        ],
                    ])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'price_owner')->widget(\yii\widgets\MaskedInput::class, [
                        'options' => ['placeholder' => 'Цена на руки'],
                        'clientOptions' => [
                            'alias' => 'decimal', 
                            'digits' => 2, 
                            'digitsOptional' => false,
                            'radixPoint' => '.',
                            'groupSeparator' => ',', 
                            'autoGroup' => true,
                            'removeMaskOnSubmit' => true,
                        ],
                    ])->label(false) ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'rid')->widget(Select2::classname(), [ 
                        'data' => \yii\helpers\ArrayHelper::map(\app\modules\residential\models\Residential::find()->all(), 'id', 'title'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Жилой комплекс'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'kadastr')->widget(\yii\widgets\MaskedInput::class, ['options' => ['placeholder' => 'Кадастровый номер'],'mask' => '99:99:9999999:999999'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'totalSquare')->textInput(['placeholder' => 'Общая площадь'])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <div class="form-group">
                    <?= $form->field($model, 'liveSquare')->textInput(['placeholder' => 'Жилая'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?= $form->field($model, 'kitchenSquare')->textInput(['placeholder' => 'Кухня'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?= $form->field($model, 'roomCount')->textInput(['placeholder' => 'Комнат'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?= $form->field($model, 'floor')->textInput(['placeholder' => 'Этаж'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <?= $form->field($model, 'floors')->textInput(['placeholder' => 'Этажность'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'builded')->textInput(['placeholder' => 'Дата постройки'])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= $form->field($model, 'communication[]')->widget(Select2::classname(), [ 
                        'data' => \yii\helpers\ArrayHelper::map(\app\modules\base\models\Communication::find()->all(), 'name', 'name'),
                        'language' => 'ru',
                        'options' => [
                            'placeholder' => 'Коммуникации',
                            'multiple' => true,
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'exp_ya')->dropDownList([
                        Export::YANDEX_TRUE => Yii::t('app.export', 'Yandex Export True'),
                        Export::YANDEX_FALSE => Yii::t('app.export', 'Yandex Export False'),
                        ],
                        [
                            'options' => [
                                Export::YANDEX_TRUE => ['selected' => true]
                            ],
                        ]
                    )->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'exp_avito')->dropDownList([
                        Export::AVITO_TRUE => Yii::t('app.export', 'Avito Export True'),
                        Export::AVITO_FALSE => Yii::t('app.export', 'Avito Export False'),
                        ],
                        [
                            'options' => [
                                Export::AVITO_TRUE => ['selected' => true]
                            ],
                        ]
                    )->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'exp_domclick')->dropDownList([
                        Export::DOMCLICK_TRUE => Yii::t('app.export', 'Domclick Export True'),
                        Export::DOMCLICK_FALSE => Yii::t('app.export', 'Domclick Export False'),
                        ],
                        [
                            'options' => [
                                Export::DOMCLICK_TRUE => ['selected' => true]
                            ],
                        ]
                    )->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'exp_cian')->dropDownList([
                        Export::CIAN_TRUE => Yii::t('app.export', 'Cian Export True'),
                        Export::CIAN_FALSE => Yii::t('app.export', 'Cian Export False'),
                        ],
                        [
                            'options' => [
                                Export::CIAN_TRUE => ['selected' => true]
                            ],
                        ]
                    )->label(false)
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'repair')->widget(Select2::classname(), [ 
                        'data' => ArrayHelper::map(Base::getTypeRepair(), 'id', 'name'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Тип ремонта...'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?= $form->field($model, 'wall')->widget(Select2::classname(), [ 
                        'data' => ArrayHelper::map(Base::getTypeWall(), 'id', 'name'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Тип стен...'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'balcon')->widget(Select2::classname(), [ 
                        'data' => Base::getBalconArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Балкон...'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'elevator')->widget(Select2::classname(), [ 
                        'data' => Base::getElevatorArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Кол-во лифтов...'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?= $form->field($model, 'bathroom')->widget(Select2::classname(), [ 
                        'data' => Base::getBathroomArray(),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Cанузел...'],
                        'pluginOptions' => [
                            'allowClear' => false,
                        ],
                        ])->label(false)
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
                        'options' => ['rows' => 6],
                        'preset' => 'advanced'
                    ])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?= $form->field($model, 'files')->widget(floor12\files\components\FileInputWidget::class) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
