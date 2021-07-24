<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserLogableTables extends Migration
{
	public function up()
	{
		/**
		 * user_logables table
		 */
		$this->forge->addField([
            'id' => [
            	'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true,
            	'auto_increment' => true
            ],
			'user_id' => [
				'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true
			],
			'logable_type' => [
            	'type' => 'varchar',
            	'constraint' => 255
            ],
			'logable_id' => [
				'type' => 'bigint',
            	'constraint' => 20,
            	'unsigned' => true
			],
			'new_data' => [
            	'type' => 'longtext',
            	'null' => true
            ],
			'old_data' => [
            	'type' => 'longtext',
            	'null' => true
            ],
			'type' => [
            	'type' => 'varchar',
            	'constraint' => 255,
            	'null' => true
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
		$this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
		$this->forge->addKey(['logable_type', 'logable_id']);

		$this->forge->createTable('user_logables', true);
	}

	public function down()
	{
		$this->forge->dropTable('user_logables', true);
	}
}
