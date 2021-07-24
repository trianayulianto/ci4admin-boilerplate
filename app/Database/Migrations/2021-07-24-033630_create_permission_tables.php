<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function config;

class CreatePermissionTables extends Migration
{
	public function up()
	{
        /**
         * roles table.
         */
		$this->forge->addField([
            'id' => [
            	'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true,
            	'auto_increment' => true
            ],
            'name' => [
            	'type' => 'varchar',
            	'constraint' => 255
            ],
            'created_at' => [
            	'type' => 'datetime',
            	'null' => true
            ],
            'updated_at' => [
            	'type' => 'datetime',
            	'null' => true
            ],
		]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('name');

        $this->forge->createTable(config('Defender')->role_table ?? 'roles', true);

        /**
         * permissions table
         */
        $this->forge->addField([
            'id' => [
            	'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true,
            	'auto_increment' => true
            ],
            'name' => [
            	'type' => 'varchar',
            	'constraint' => 255
            ],
            'readable_name' => [
            	'type' => 'varchar',
            	'constraint' => 255
            ],
            'created_at' => [
            	'type' => 'datetime',
            	'null' => true
            ],
            'updated_at' => [
            	'type' => 'datetime',
            	'null' => true
            ],
		]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('name');

        $this->forge->createTable(config('Defender')->permission_table ?? 'permissions', true);
	}

	public function down()
	{
        $this->forge->dropTable(config('Defender')->role_table ?? 'roles', true);
        $this->forge->dropTable(config('Defender')->permission_table ?? 'permissions', true);
	}
}
