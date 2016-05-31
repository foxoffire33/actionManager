<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m160130_185550_initial_data
 */
class m160130_185550_initial_data extends Migration
{
	public function up()
	{
		$this->insert('auth_item', [
			'name'        => 'admin',
			'type'        => 1,
			'description' => 'Admin',
			'rule_name'   => null,
			'data'        => null,
			'created_at'  => time(),
			'updated_at'  => time(),
		]);

		$this->insert('auth_item', [
			'name'        => 'member',
			'type'        => 1,
			'description' => 'Member',
			'rule_name'   => null,
			'data'        => null,
			'created_at'  => time(),
			'updated_at'  => time(),
		]);

		$this->insert('user', [
			'id'                   => 1,
			'username'             => 'admin',
			'auth_key'             => 'fFOg234-MHlMW4eLSnaYpPF-b_qN0DGB',
			'password_hash'        => '$2y$13$JZ.bBASpjgBECdOy0PLaiuKJMTRbF2Gzwd/x5RGN6u/j0T.oPr7Iy', // asdasd
			'password_reset_token' => null,
			'email'                => 'admin@example.com',
			'status'               => 10,
			'last_login'           => time(),
			'created_at'           => time(),
			'updated_at'           => time(),
		]);

		$this->insert('auth_assignment', [
			'item_name'  => 'admin',
			'user_id'    => 1,
			'created_at' => time(),
		]);

		$this->insert('user', [
			'id'                   => 2,
			'username'             => 'member',
			'auth_key'             => 'fFOg234-MHlMW4eLSnaYpPF-b_qN0DGB',
			'password_hash'        => '$2y$13$JZ.bBASpjgBECdOy0PLaiuKJMTRbF2Gzwd/x5RGN6u/j0T.oPr7Iy', // asdasd
			'password_reset_token' => null,
			'email'                => 'member@example.com',
			'status'               => 10,
			'last_login'           => time(),
			'created_at'           => time(),
			'updated_at'           => time(),
		]);

		$this->insert('auth_assignment', [
			'item_name'  => 'member',
			'user_id'    => 2,
			'created_at' => time(),
		]);
	}

	public function down()
	{
		echo "m160130_185550_initial_data cannot be reverted.\n";

		return false;
	}

}
