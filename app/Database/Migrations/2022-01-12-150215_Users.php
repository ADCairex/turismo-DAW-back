<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'surname' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'role_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => true,
                'default'        => '2',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('email');
        $this->forge->addForeignKey('role_id','roles','id','CASCADE','SET NULL');

        $this->forge->createTable('users');

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
