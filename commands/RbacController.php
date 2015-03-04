<?php

namespace app\commands;

use app\components\helpers\Rbac;
use Yii;
use yii\console\Controller;
use app\rbac\OwnerRule;

class RbacController extends Controller
{
	public function actionInit()
	{
		$auth = Yii::$app->authManager;

		$auth->removeAll();

		$ownerRule = new OwnerRule();
		$auth->add($ownerRule);


		//article permissions

		$viewArticle = $auth->createPermission(Rbac::PERMISSION_VIEW_ARTICLE);
		$auth->add($viewArticle);

		$createArticle = $auth->createPermission(Rbac::PERMISSION_CREATE_ARTICLE);
		$auth->add($createArticle);

		$updateArticle = $auth->createPermission(Rbac::PERMISSION_UPDATE_ARTICLE);
		$auth->add($updateArticle);

		$updateOwnArticle = $auth->createPermission(Rbac::PERMISSION_UPDATE_OWN_ARTICLE);
		$updateOwnArticle->ruleName = $ownerRule->name;
		$auth->add($updateOwnArticle);

		$deleteArticle = $auth->createPermission(Rbac::PERMISSION_DELETE_ARTICLE);
		$auth->add($deleteArticle);

		$deleteOwnArticle = $auth->createPermission(Rbac::PERMISSION_DELETE_OWN_ARTICLE);
		$deleteOwnArticle->ruleName = $ownerRule->name;
		$auth->add($deleteOwnArticle);


		//roles

		$guest = $auth->createRole(Rbac::ROLE_GUEST);
		$auth->add($guest);
		$auth->addChild($guest, $viewArticle);

		$user = $auth->createRole(Rbac::ROLE_USER);
		$auth->add($user);
		$auth->addChild($user, $guest);

		$admin = $auth->createRole(Rbac::ROLE_ADMIN);
		$auth->add($admin);
		$auth->addChild($admin, $user);
		$auth->addChild($admin, $updateArticle);
		$auth->addChild($admin, $deleteArticle);

		$auth->assign($admin, 1);
	}
}