<?php
/**
 * Created by Maxim Vorozhtsov
 * Email: myks1992@mail.ru
 * Date: 07.02.2019
 * Time: 22:19
 */

namespace maxdancepro\phoneFormatter\i18n;


use yii\helpers\Html;

/**
 * Class Formatter
 */
class Formatter extends \yii\i18n\Formatter
{
    /**
     * Дефолтное значение кода страны номера
     *
     * @var string
     */
    private $defaultPhoneCode = 'RU';

    /**
     * Форматирование номера телефона
     * Эта функция может принимать 11-значный, 10-значный, 7-значный или 6-значный номер
     * телефона и
     * возвращает
     *
     * @param int $number    Номер телефона, который будет отформатирован
     *
     * @param string $code   Код страны, по умолчанию Россия (RU -> +7)
     * @param bool $link     Выводить телефон в виде HTML ссылки
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

    /**
     * Функция форматирования
     *
     * @param $number
     * @param string $code
     * @param bool $link
     * @param array $options
     *
     * @return string
     */
    private function formatPhone($number, $code, $link, $options)
    {
        $number = preg_replace("/[^0-9]/", "", $number);

        if (strlen($number) == 6) {
            $number = preg_replace("/([0-9]{3})([0-9]{3})/", "$1-$2", $number);
        } else if (strlen($number) == 7) {
            $number = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $number);
        } else if (strlen($number) == 10) {
            $number = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", "($1) $2-$3-$4", $number);
        } else if (strlen($number) == 11) {
            $number = preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{2})([0-9]{2})/", "$1 ($2) $3-$4-$5", $number);
        }

        $number = $this->getCodeCountryByIso($code) . ' ' . $number;

        if ($link == false) {
            return $number;
        } else {
            $url = $this->buildUrlPhone($number);
            return Html::a($number, $url, $options);
        }
    }

    /**
     * Получаем код страны телефона, по умолчанию  RU => +7
     * Реализована только россия
     *
     * @param $code
     *
     * @return null|string
     */
    private function getCodeCountryByIso($code)
    {
        if ($code == null) {
            $code = $this->defaultPhoneCode;
        }

        if ($code == 'RU') {
            return '+7';
        }
        return null;
    }

    /**
     * Строит телефонную ссылку из передаваемой строки
     * Передаваемая строка может быть числом, отформатированным числом или номером телефона.
     *
     * @param string $url The number or tel url to use in the link
     *
     * @return string rfc3966 formatted tel URL
     */
    private function buildUrlPhone($url)
    {
        $number = preg_replace("/[^0-9]+/", "", $url);
        return "tel:+" . $number;
    }
}