<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GasStation extends Migration
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
            'label' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ],
            'latitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '50,15',
            ],
            'longitude' => [
                'type'       => 'DECIMAL',
                'constraint' => '50,15',
            ],
            'ideess' => [
                'type' => 'VARCHAR',
                'constraint' => '250'
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
        $this->forge->createTable('gas_station');
    }

    public function down()
    {
        $this->forge->dropTable('gas_station');
    }
}
