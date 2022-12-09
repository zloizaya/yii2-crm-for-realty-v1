<?php

use yii2mod\rbac\migrations\Migration;

class m221009_135006_create_permissions extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        /** Пользователи */
        $viewUsersList = $auth->createPermission('viewUsersList');
        $viewUsersList->description = 'Просмотр списка пользователей';
        $auth->add($viewUsersList);

        $addUser = $auth->createPermission('addUser');
        $addUser->description = 'Добавление пользователя';
        $auth->add($addUser);

        $viewUser = $auth->createPermission('viewUser');
        $viewUser->description = 'Просмотр пользователя';
        $auth->add($viewUser);

        $updateUsers = $auth->createPermission('updateUsers');
        $updateUsers->description = 'Редактирование пользователей';
        $auth->add($updateUsers);

        $deleteUsers = $auth->createPermission('deleteUsers');
        $deleteUsers->description = 'Удаление пользователей';
        $auth->add($deleteUsers);

        /** Управление правами */
        $useRBAC = $auth->createPermission('useRBAC');
        $useRBAC->description = 'Управление правами';
        $auth->add($useRBAC);

        /** CRM */
        $viewDealsList = $auth->createPermission('viewDealsList');
        $viewDealsList->description = 'Просмотр сделок';
        $auth->add($viewDealsList);

        $viewDeal = $auth->createPermission('viewDeal');
        $viewDeal->description = 'Просмотр сделки';
        $auth->add($viewDeal);

        $addDeal = $auth->createPermission('addDeal');
        $addDeal->description = 'Добавление сделки';
        $auth->add($addDeal);

        $updateDeals = $auth->createPermission('updateDeals');
        $updateDeals->description = 'Редактирование сделки';
        $auth->add($updateDeals);

        $deleteDeals = $auth->createPermission('deleteDeals');
        $deleteDeals->description = 'Удаление сделки';
        $auth->add($deleteDeals);

        $useFilters = $auth->createPermission('useFilters');
        $useFilters->description = 'Использование фильтров';
        $auth->add($useFilters);

        $editStatuses = $auth->createPermission('editStatuses');
        $editStatuses->description = 'Выставление статусов оплат';
        $auth->add($editStatuses);

        $printDocuments = $auth->createPermission('printDocuments');
        $printDocuments->description = 'Печать документов';
        $auth->add($printDocuments);

        /** Клиенты */
        $viewClientsList = $auth->createPermission('viewClientsList');
        $viewClientsList->description = 'Просмотр списка клиентов';
        $auth->add($viewClientsList);

        $addClient = $auth->createPermission('addClient');
        $addClient->description = 'Добавление клиентов';
        $auth->add($addClient);

        $updateClients = $auth->createPermission('updateClients');
        $updateClients->description = 'Редактирование клиентов';
        $auth->add($updateClients);

        $deleteClients = $auth->createPermission('deleteClients');
        $deleteClients->description = 'Удаление клиентов';
        $auth->add($deleteClients);

        /** Комментарии */

        $viewComments = $auth->createPermission('viewComments');
        $viewComments->description = 'Просмотр комментариев';
        $auth->add($viewComments);

        $addComment = $auth->createPermission('addComment');
        $addComment->description = 'Добавление комментария';
        $auth->add($addComment);

        $editComment = $auth->createPermission('editComment');
        $editComment->description = 'Редактирование комментария';
        $auth->add($editComment);

        $deleteComment = $auth->createPermission('deleteComment');
        $deleteComment->description = 'Удаление комментария';
        $auth->add($deleteComment);


        /** Base */

        $viewObjectList = $auth->createPermission('viewObjectList');
        $viewObjectList->description = 'Просмотр списка объектов';
        $auth->add($viewObjectList);

        $addObject = $auth->createPermission('addObject');
        $addObject->description = 'Добавление объекта';
        $auth->add($addObject);

        $updateObject = $auth->createPermission('updateObject');
        $updateObject->description = 'Редактирование объекта';
        $auth->add($updateObject);

        $deleteObject = $auth->createPermission('deleteObject');
        $deleteObject->description = 'Удаление объекта';
        $auth->add($deleteObject);

        $archiveObject = $auth->createPermission('archiveObject');
        $archiveObject->description = 'Архивирование объекта';
        $auth->add($archiveObject);

        /** Отчеты */

        $accessReport = $auth->createPermission('accessReport');
        $accessReport->description = 'Доступ к отчетам';
        $auth->add($accessReport);

        $accessFinance = $auth->createPermission('accessFinance');
        $accessFinance->description = 'Доступ к финансам';
        $auth->add($accessFinance);

    }

    public function safeDown()
    {
        echo "m221009_135006_create_permissions cannot be reverted.\n";

        return false;
    }
}