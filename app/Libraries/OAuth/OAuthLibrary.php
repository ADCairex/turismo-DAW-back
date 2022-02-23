<?php

namespace App\Libraries\OAuth;

use OAuth2\GrantType\RefreshToken;
use OAuth2\GrantType\UserCredentials;
use OAuth2\Storage\Pdo;
use OAuth2\Server;

class OAuthLibrary {
    
    public $server;
    
    // DB conexion
    protected $dsn;
    protected $username;
    protected $password;

    public function __construct()
    {
        $dbName = getenv('database.default.database');
        $dbHost = getenv('database.default.hostname');

        $this->dsn = 'mysql:dbname='.$dbName.';host='.$dbHost;
        $this->username = getenv('database.default.username');
        $this->password = getenv('database.default.password');

        $this->initialize();
    }

    private function initialize()
    {
        // OAuth server initialization

        $storage = new Pdo([
            'dsn' => $this->dsn,
            'username' => $this->username,
            'password' => $this->password
        ]);

        $this->server = new Server($storage);

        $this->server->addGrantType(new UserCredentials($storage));
        $this->server->addGrantType(new RefreshToken($storage));
    }
}