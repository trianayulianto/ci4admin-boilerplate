<?php

namespace Fluent\Auth\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAuthTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        /**
         * Users table.
         */
        $this->forge->addField([
            'id'                => ['type' => 'bigint', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'name'              => ['type' => 'varchar', 'constraint' => 255],
            'email'             => ['type' => 'varchar', 'constraint' => 255],
            'password'          => ['type' => 'varchar', 'constraint' => 255],
            'email_verified_at' => ['type' => 'datetime', 'null' => true],
            'remember_token'    => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('email');

        $this->forge->createTable('users', true);

        /**
         * Password reset table.
         */
        $this->forge->addField([
            'email'      => ['type' => 'varchar', 'constraint' => 255],
            'token'      => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => false],
        ]);

        $this->forge->addKey(['email']);
        $this->forge->createTable('password_resets', true);
    }

    //--------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('password_resets', true);
    }
}
