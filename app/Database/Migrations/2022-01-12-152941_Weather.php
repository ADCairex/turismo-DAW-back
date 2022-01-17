<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Weather extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'auto_increment' => true,
                'unsigned'       => true,
                'null'           => true,
            ],
            'main' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'icon' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
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
        $this->forge->createTable('weather');
    }

    public function down()
    {
        $this->forge->dropTable('weather');
    }
}
