<?php

namespace App\Controllers\Rest;

use App\Entities\Users;
use App\Models\UsersModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class UsersController extends ResourceController
{
    // Check if the user exist
    public function existUser($username=null)
    {
        try {
            $userM = new UsersModel();
            $request = $this->request;
            $body = $request->getJSON();

            if($username) {
                $user = $userM->getUserByUsername($username);

                if($user) {
                    return $this->respond('true', 200, 'Usuario enontrado');
                    
                } else {
                    return $this->respond('false' , 200, 'Usuario no encontrado');
                }
            } else {
                return $this->respond('', 400, 'Usuario no enviado');
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error intero del servidor');
        }
    }

    // Check if the login is correct
    public function checkUser()
    {
        try {
            $userM = new UsersModel();
            $request = $this->request;
            $body = $request->getJSON();

            if(isset($body->username) && isset($body->password)) {
                $user = $userM->getUserByUsername($body->username);

                if($user) {
                    if(password_verify($body->password, $user->password)) {
                        return $this->respond($user, 200, 'Usuario y contraseña coinciden');
                    } else {
                        return $this->respond('', 404, 'Usuario o contraseña incorrectos');
                    }
                } else {
                    return $this->respond('', 404, 'Usuario o contraseña incorrectos');
                }
            } else {
                return $this->respond('', 400, 'Falta algun campo obligatorio');
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error intero del servidor');
        }
    }

    // Make a new user
    public function createUser()
    {
        try {
            $userM = new UsersModel();
            $request = $this->request;
            $body = $request->getJSON();

            if(isset($body->username) && isset($body->password) && isset($body->email) && isset($body->name) && isset($body->surname)) {
                $data = array(
                    'username' => $body->username,
                    'email' => $body->email,
                    'password' => password_hash($body->password, 1),
                    'name' => $body->name,
                    'surname' => $body->surname
                );
                $newUser = new Users($data);
                $userM->save($newUser);

                return $this->respond('', 200, 'Usuario creado con exito');
            } else {
                return $this->respond('', 400, 'Falta algun campo obligatorio');
            }
        } catch (Exception $e) {
            return $this->respond('', 500, 'Error intero del servidor');
        }
    }
}
