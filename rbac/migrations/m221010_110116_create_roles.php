<?php

use yii2mod\rbac\migrations\Migration;

class m221010_110116_create_roles extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $viewDashboard = $auth->getPermission('viewDashboard');
        $viewUsersList = $auth->getPermission('viewUsersList');
        $addUser = $auth->getPermission('addUser');
        $viewUser = $auth->getPermission('viewUser');
        $updateUsers = $auth->getPermission('updateUsers');
        $deleteUsers = $auth->getPermission('deleteUsers');
        $useRBAC = $auth->getPermission('useRBAC');
        $viewDealsList = $auth->getPermission('viewDealsList');
        $viewDeal = $auth->getPermission('viewDeal');
        $addDeal = $auth->getPermission('addDeal');
        $updateDeals = $auth->getPermission('updateDeals');
        $deleteDeals = $auth->getPermission('deleteDeals');
        $useFilters = $auth->getPermission('useFilters');
        $editStatuses = $auth->getPermission('editStatuses');
        $printDocuments = $auth->getPermission('printDocuments');
        $viewClientsList = $auth->getPermission('viewClientsList');
        $addClient = $auth->getPermission('addClient');
        $updateClients = $auth->getPermission('updateClients');
        $deleteClients = $auth->getPermission('deleteClients');
        $viewComments = $auth->getPermission('viewComments');
        $addComment = $auth->getPermission('addComment');
        $editComment = $auth->getPermission('editComment');
        $deleteComment = $auth->getPermission('deleteComment');
        $viewObjectList = $auth->getPermission('viewObjectList');
        $addObject = $auth->getPermission('addObject');
        $updateObject = $auth->getPermission('updateObject');
        $deleteObject = $auth->getPermission('deleteObject');
        $accessReport = $auth->getPermission('accessReport');
        $accessFinance = $auth->getPermission('accessFinance');
        $archiveObject = $auth->getPermission('archiveObject');

        $agent = $auth->createRole('agent');
        $agent->description = 'Агент';
        $auth->add($agent);
        $auth->addChild($agent, $viewObjectList);
        $auth->addChild($agent, $addObject);
        $auth->addChild($agent, $updateObject);
        $auth->addChild($agent, $archiveObject);
        $auth->addChild($agent, $viewDealsList);
        $auth->addChild($agent, $viewDeal);
        $auth->addChild($agent, $addDeal);
        $auth->addChild($agent, $updateDeals);
        $auth->addChild($agent, $useFilters);
        $auth->addChild($agent, $editStatuses);
        $auth->addChild($agent, $printDocuments);
        $auth->addChild($agent, $viewClientsList);
        $auth->addChild($agent, $addClient);
        $auth->addChild($agent, $updateClients);
        $auth->addChild($agent, $viewComments);
        $auth->addChild($agent, $addComment);
        $auth->addChild($agent, $editComment);

        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';
        $auth->add($manager);
        $auth->addChild($manager, $agent);
        $auth->addChild($manager, $deleteObject);
        $auth->addChild($manager, $deleteDeals);
        $auth->addChild($manager, $deleteClients);
        $auth->addChild($manager, $deleteComment);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);
        $auth->addChild($admin, $agent);
        $auth->addChild($admin, $manager);
        $auth->addChild($admin, $viewUsersList);
        $auth->addChild($admin, $addUser);
        $auth->addChild($admin, $viewUser);
        $auth->addChild($admin, $updateUsers);
        $auth->addChild($admin, $deleteUsers);
        $auth->addChild($admin, $useRBAC);
        $auth->addChild($admin, $accessReport);
        $auth->addChild($admin, $accessFinance);

        $auth->assign($admin, 1);
    }

    public function safeDown()
    {
        echo "m221010_110116_create_roles cannot be reverted.\n";

        return false;
    }
}