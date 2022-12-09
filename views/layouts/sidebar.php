<?php 
$name = explode(' ', Yii::$app->user->identity->full_name);
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="<?= Yii::$app->params['appName'] ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Yii::$app->params['appName'] ?></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="/profile" class="d-block"><?= $name[0] . ' ' . $name[1] ?>
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Панель', 'header' => true],
                    ['label' => 'Главная', 'url'=>['/'], 'active' => $this->context->route == 'base/main/index', 'iconStyle' => 'far', 'icon' => 'compass'],
                    ['label' => 'Сделки', 'url'=>['/deals'], 'active' => $this->context->route == 'deals/main/index', 'iconStyle' => 'fas', 'icon' => 'briefcase', 'visible' => Yii::$app->user->can('agent')],
                     ['label' => 'Задачи', 'url'=>['/tasks'], 'active' => $this->context->route == 'tasks/main/index', 'iconStyle' => 'fas', 'icon' => 'tasks', 'visible' => Yii::$app->user->can('agent')],
                    ['label' => 'Клиенты', 'url'=>['/clients'], 'active' => $this->context->route == 'clients/main/index', 'iconStyle' => 'fas', 'icon' => 'phone', 'visible' => Yii::$app->user->can('agent')],
                    ['label' => 'Застройщики', 'url'=>['/developers'], 'active' => $this->context->route == 'developers/main/index', 'iconStyle' => 'fas', 'icon' => 'building', 'visible' => Yii::$app->user->can('agent')],
                    ['label' => 'Жилые Комплексы', 'url'=>['/residential'], 'active' => $this->context->route == 'residential/main/index', 'iconStyle' => 'fas', 'icon' => 'city', 'visible' => Yii::$app->user->can('agent')],
                    ['label' => 'Настройки', 'header' => true, 'visible' => Yii::$app->user->can('agent')],
                    ['label' => 'Пользователи', 'url'=>['/users'], 'active' => $this->context->route == 'users/main/index', 'iconStyle' => 'fas', 'icon' => 'users', 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Параметры', 'url'=>['/settings'], 'active' => $this->context->route == 'settings/main/index', 'iconStyle' => 'fas', 'icon' => 'tools', 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Профиль', 'url'=>['/profile'], 'active' => $this->context->route == 'profile/main/index', 'iconStyle' => 'fas', 'icon' => 'user', 'visible' => Yii::$app->user->can('agent')],
                    ['label' => 'Права доступа', 'header' => true, 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Назначения', 'url'=>['/rbac'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Маршруты', 'url'=>['/rbac/route'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Разрешения', 'url'=>['/rbac/permission'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Роли', 'url'=>['/rbac/role'], 'iconStyle' => 'far', 'visible' => Yii::$app->user->can('admin')],
                    ['label' => 'Выход', 'url' => ['/site/logout'], 'template' => '<a href="{url}" class="nav-link" data-method="post"><i class="nav-icon fas fa-sign-out-alt"></i> {label}</a>'],
                ],
            ]);
            ?>
        </nav>
    </div>
</aside>