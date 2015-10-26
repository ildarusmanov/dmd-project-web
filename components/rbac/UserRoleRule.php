<?php
namespace app\components\rbac;

use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use app\models\User;

class UserRoleRule extends Rule
{
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));
        if ($user) {
            if ($item->name === 'admin') {
                return $user->isAdmin();
            } elseif ($item->name === 'manager') {
                return $user->isAdmin() || $user->isManager();
            }
            elseif ($item->name === 'user') {
                return $user->isAdmin() || $user->isManager()
                || $user->isUser();
            }
        }
        return false;
    }
}
