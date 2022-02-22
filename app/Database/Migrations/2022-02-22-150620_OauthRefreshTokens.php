<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OauthRefreshTokens extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'refresh_token' => [
                'type' => 'VARCHAR',
                'constraint' => '40',
                'null' => false
            ],
            'client_id' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => false
            ],
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
            ],
            'expires' => [
                'type' => 'TIMESTAMP',
                'null' => false
            ],
            'scope' => [
                'type' => 'VARCHAR',
                'constraint' => '4000',
            ]
        ]);

        $this->forge->addPrimaryKey('refresh_token');
        $this->forge->createTable('oauth_refresh_token');
    }

    public function down()
    {
        $this->forge->dropTable('oauth_refresh_token');
    }
}
