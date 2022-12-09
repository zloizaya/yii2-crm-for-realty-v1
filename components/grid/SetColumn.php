<?php
namespace app\components\grid;

use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class SetColumn extends DataColumn
{
    /**
     * @var callable
     */
    public $name;
    /**
     * Array of status classes
     * ```
     * [
     *     User::STATUS_ACTIVE => 'success',
     *     User::STATUS_WAIT => 'warning',
     *     User::STATUS_BLOCKED => 'default',
     * ]
     * ```
     * @var array
     */
    public $cssCLasses = [];

    protected function renderDataCellContent($model, $key, $index)
    {
        $value = $this->getDataCellValue($model, $key, $index);
        $name = $this->getStatusName($model, $key, $index, $value);
        $class = ArrayHelper::getValue($this->cssCLasses, $value, 'default');
        $html = Html::tag('span', Html::encode($name), ['class' => 'badge bg-' . $class]);
        return $value === null ? $this->grid->emptyCell : $html;
    }

    /**
     * @param mixed $model
     * @param mixed $key
     * @param integer $index
     * @param mixed $value
     * @return string
     */
    private function getStatusName($model, $key, $index, $value)
    {
        if ($this->name !== null) {
            if (is_string($this->name)) {
                $name = ArrayHelper::getValue($model, $this->name);
            } else {
                $name = call_user_func($this->name, $model, $key, $index, $this);
            }
        } else {
            $name = null;
        }
        return $name === null ? $value : $name;
    }
}