<?php

namespace Mvc\Controller;

use Framework\Controller;
use Mvc\Model\UserModel;
use Twig\Environment;

class UserController extends Controller
{
    private UserModel $userModel;

    public function __construct() {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function register() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['mail']) && isset($_POST['password'])) {

            $this->userModel->createUser($_POST['lastname'], $_POST['firstname'], $_POST['mail'], password_hash($_POST['password'], PASSWORD_DEFAULT));

            header('location: /login');
            exit();
        }

        echo $this->twig->render('user/register.html.twig');
    }

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mail']) && isset($_POST['password'])) {

            $account = $this->userModel->loginIn($_POST['mail']);

            if (isset($_POST['password']) && isset($account['password']) && password_verify($_POST['password'], $account['password'])) {

                $_SESSION['user'] = [
                    'id' => $account['id'],
                    'lastname' => $account['lastname'],
                    'firstname' => $account['firstname'],
                    'mail' => $account['mail'],
                ];

                header('Location:/admin');
                exit();

            }
        }

        echo $this->twig->render('user/login.html.twig');
    }
}