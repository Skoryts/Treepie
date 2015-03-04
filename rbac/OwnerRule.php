<?php

namespace app\rbac;

use yii\rbac\Rule;

class OwnerRule extends Rule
{
	public $name = 'isOwner';

	/**
	 * @param string|integer $user the user ID.
	 * @param Item $item the role or permission that this rule is associated with
	 * @param array $params parameters passed to ManagerInterface::checkAccess().
	 * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
	 */
	public function execute($user, $item, $params)
	{
		return isset($params['userId']) ? $params['userId'] == $user : false;
	}
}