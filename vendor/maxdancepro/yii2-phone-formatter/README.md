Yii2 Форматтер телефона
==========================================


Установка
------------

Предпочтительный способ установить это расширение через [composer](http://getcomposer.org/download/).

Либо

```
php composer.phar require --prefer-dist maxdancepro/yii2-phone-formatter "*"
```

или добавить

```
"maxdancepro/yii2-phone-formatter": "*"
```

в требуемый раздел вашего `composer.json` файл.


Использование
-----

После того, как расширение установлено, подключите его в проекта:

```php
'components' => [
    'formatter' => [
        'class' => 'maxdancepro\phoneFormatter\i18n\Formatter',
    ],
],
```

 
После чего используйте его в своих проектах:
```php
echo \Yii::$app->formatter->asPhone('9195230345');
```
В результате будет сформирован телефон в формате, который будет иметь активную HTML ссылку:
**+7 (919) 523-03-45**

Для того чтобы убрать ссылку небходимо третим параметром передать **_FALSE_**
```php
echo \Yii::$app->formatter->asPhone('9195230345','RU', false);
```
В результате будет сформирован телефон в формате, который  **НЕ** будет иметь активную HTML ссылку:
**+7 (919) 523-03-45**


Описание функции **asPhone**:
---
```php
/**
     * 
     * Эта функция может принимать 11-значный, 10-значный, 7-значный или 6-значный номер
     * телефона и
     * возвращает
     *
     * @param int $number Номер телефона, который будет отформатирован
     *
     * @param string $code Код страны, по умолчанию Россия (RU -> +7)
     * @param bool $link Выводить телефон в виде HTML ссылки
     * @param array $options Опции для HTML ссылки
     *
     * @return string
     */
    public function asPhone($number, $code = 'RU', $link = true, array $options = [])
    {
        if ($number == null) {
            return $this->nullDisplay;
        } else {
            return $this->formatPhone($number, $code, $link, $options);
        }
    }
```

