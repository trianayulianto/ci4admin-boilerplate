<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function config;

class CreatePermissionPivotTables extends Migration
{
	public function up()
	{
		/**
		 * role_user table
		 */
		$role_key = config('Defender')->role_key ?? 'role_id';
		$this->forge->addField([
			'user_id' => [
				'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true
			],
			"$role_key" => [
				'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true
			]
		]);

		$role_table = config('Defender')->role_table ?? 'roles';
		$this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
		$this->forge->addForeignKey($role_key, $role_table,'id','CASCADE','CASCADE');

		$role_user_table = config('Defender')->role_user_table ?? 'role_user';
		$this->forge->createTable($role_user_table, true);

		/**
		 * permission_user table
		 */
		$permission_key = config('Defender')->permission_key ?? 'permission_id';
		$this->forge->addField([
			'user_id' => [
				'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true
			],
			"$permission_key" => [
				'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true
			]
		]);

		$permission_table = config('Defender')->permission_table ?? 'permissions';
		$this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
		$this->forge->addForeignKey($permission_key, $permission_table,'id','CASCADE','CASCADE');

		$permission_user_table = config('Defender')->permission_user_table ?? 'permission_user';
		$this->forge->createTable($permission_user_table, true);

		/**
		 * permission_role table
		 */
		$this->forge->addField([
			"$role_key" => [
				'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true
			],
			"$permission_key" => [
				'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true
			],
			'value' => [
				'type' => 'tinyint',
				'constraint' => 4,
				'default' => -1
			],
			'expires' => [
            	'type' => 'datetime',
            	'null' => true
			]
		]);

		$this->forge->addForeignKey($role_key, $role_table,'id','CASCADE','CASCADE');
		$this->forge->addForeignKey($permission_key, $permission_table,'id','CASCADE','CASCADE');

		$permission_role_table = config('Defender')->permission_role_table ?? 'permission_role';
		$this->forge->createTable($permission_role_table, true);
	}

	public function down()
	{
		$role_user_table = config('Defender')->role_user_table ?? 'role_user';
		$this->forge->dropTable($role_user_table, true);

		$permission_user_table = config('Defender')->permission_user_table ?? 'permission_user';
		$this->forge->dropTable($permission_user_table, true);

		$permission_role_table = config('Defender')->permission_role_table ?? 'permission_role';
		$this->forge->dropTable($permission_role_table, true);
	}
}
