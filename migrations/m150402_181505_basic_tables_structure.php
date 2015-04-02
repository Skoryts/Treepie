<?php

use yii\db\Schema;
use yii\db\Migration;

class m150402_181505_basic_tables_structure extends Migration
{
	public function up()
	{
		$this->createTable(
			't_user', [
				'id' => 'pk',
				'email' => Schema::TYPE_STRING . '(255)',
				'username' => Schema::TYPE_STRING . '(255)',
				'passwordHash' => Schema::TYPE_STRING . '(60)',
				'authKey' => Schema::TYPE_STRING . '(32)',
				'createdAt' => Schema::TYPE_TIMESTAMP . ' NULL',
				'updatedAt' => Schema::TYPE_TIMESTAMP . ' NULL',
			]
		);
		$this->createIndex('uq_user_email', 't_user', 'email', true);
		$this->createIndex('uq_user_username', 't_user', 'username', true);
		$this->insert('t_user', [
			'email' => 'admin@admin.admin',
			'username' => 'admin',
			'passwordHash' => '$2y$13$jXUdSTaUoKpQMWL9xVza4u7lT4TqUgwf1qr6.7uYRHozT9juRmGfC',
			'authKey' => '70THFHCdcb-e-8pyzkMDklM-oC9nq5J_',
		]);

		$this->createTable(
			't_profile', [
				'userId' => Schema::TYPE_INTEGER,
				'firstName' => Schema::TYPE_STRING . '(100)',
				'lastName' => Schema::TYPE_STRING . '(100)',
			]
		);
		$this->addPrimaryKey('pk_profile_userId', 't_profile', 'userId');
		$this->insert('t_profile', ['userId' => 1]);

		$this->createTable(
			't_article', [
				'id' => 'pk',
				'userId' => Schema::TYPE_INTEGER,
				'categoryId' => Schema::TYPE_INTEGER,
				'title' => Schema::TYPE_STRING . '(255)',
				'slug' => Schema::TYPE_STRING . '(255)',
				'body' => Schema::TYPE_TEXT,
				'published' => Schema::TYPE_STRING . '(1)',
				'draft' => Schema::TYPE_STRING . '(1)',
				'tags' => Schema::TYPE_TEXT,
				'createdAt' => Schema::TYPE_TIMESTAMP . ' NULL',
				'updatedAt' => Schema::TYPE_TIMESTAMP . ' NULL',
			]
		);

		$this->createTable(
			't_category', [
				'id' => 'pk',
				'userId' => Schema::TYPE_INTEGER,
				'parentCategoryId' => Schema::TYPE_INTEGER,
				'name' => Schema::TYPE_STRING . '(100)',
				'slug' => Schema::TYPE_STRING . '(100)',
				'createdAt' => Schema::TYPE_TIMESTAMP . ' NULL',
				'updatedAt' => Schema::TYPE_TIMESTAMP . ' NULL',
			]
		);

		$this->createTable(
			't_file', [
				'id' => 'pk',
				'userId' => Schema::TYPE_INTEGER,
				'relationTypeId' => Schema::TYPE_INTEGER,
				'relationId' => Schema::TYPE_INTEGER,
				'path' => Schema::TYPE_STRING . '(255)',
				'name' => Schema::TYPE_STRING . '(32)',
				'originalName' => Schema::TYPE_STRING . '(255)',
				'extension' => Schema::TYPE_STRING . '(255)',
				'type' => Schema::TYPE_STRING . '(255)',
				'createdAt' => Schema::TYPE_TIMESTAMP . ' NULL',
				'updatedAt' => Schema::TYPE_TIMESTAMP . ' NULL',
			]
		);

		$this->createTable(
			't_relation_type', [
				'id' => 'pk',
				'name' => Schema::TYPE_STRING . '(100)',
			]
		);
		$this->insert('t_relation_type', ['name' => 'app\models\Article']);
	}

	public function down()
	{
		$this->dropTable('t_user');
		$this->dropTable('t_profile');
		$this->dropTable('t_article');
		$this->dropTable('t_category');
		$this->dropTable('t_file');
		$this->dropTable('t_relation_type');
	}
}
