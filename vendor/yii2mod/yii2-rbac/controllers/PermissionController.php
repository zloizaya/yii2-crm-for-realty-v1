<?php

namespace yii2mod\rbac\controllers;

use yii\rbac\Item;
use yii2mod\rbac\base\ItemController;

/**
 * Class PermissionController
 *
 * @package yii2mod\rbac\controllers
 */
class PermissionController extends ItemController
{
    public $layout = '@app/views/layouts/main.php';
    /**
     * @var int
     */
    protected $type = Item::TYPE_PERMISSION;

    /**
     * @var array
     */
    protected $labels = [
        'Item' => 'Permission',
        'Items' => 'Permissions',
    ];
}
