<?php

namespace App\Controllers\OAuth;

use App\Libraries\OAuth\OAuthLibrary;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use OAuth2\Request;

class OAuthController extends ResourceController
{
    protected $format = 'json';

    protected $oauthLibrary;
    protected $oauthRequest;
    protected $oauthResponse;

    public function __construct()
    {
        $this->oauthLibrary = new OAuthLibrary();
        $this->oauthRequest = new Request();
    }

    public function login()
    {
        try {
            // Manage the login request

            $this->oauthResponse = $this->oauthLibrary->server->handleTokenRequest(
                $this->oauthRequest->createFromGlobals()
            );

            $status = $this->oauthResponse->getStatusCode();
            $body = $this->oauthResponse->getResponseBody();

            if($status == 200) {
                return $this->respond([
                    'status' => $status,
                    'data' => json_decode($body),
                    'message' => 'Authorization succesfully'
                ]);
            } else {
                return $this->respond(json_decode($body), 500, 'Authorization error');
            }

        } catch(Exception $e) {
            return $this->respond($e->getMessage(), 500, 'Error');
        }
    }
}
