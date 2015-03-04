<?php
/**
 * Created by PhpStorm.
 * User: tooleks
 * Date: 22.02.15
 * Time: 23:26
 */

namespace app\components\helpers;

class Rbac
{
	const PERMISSION_VIEW_ARTICLE = 'viewArticle';
	const PERMISSION_CREATE_ARTICLE = 'createArticle';
	const PERMISSION_UPDATE_ARTICLE = 'updateArticle';
	const PERMISSION_UPDATE_OWN_ARTICLE = 'updateOwnArticle';
	const PERMISSION_DELETE_ARTICLE = 'deleteArticle';
	const PERMISSION_DELETE_OWN_ARTICLE = 'deleteOwnArticle';

	const ROLE_GUEST = 'guest';
	const ROLE_USER = 'user';
	const ROLE_ADMIN = 'admin';
}