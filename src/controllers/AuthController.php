<?php

namespace App\Controllers;

use App\Exceptions\{DatabaseException, AuthException};
use App\Repositories\UserRepository;

class AuthController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        require 'views/auth/login.php';
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $user = $this->userRepository->findByUsername($username);

            $status = password_verify($password, $user['password']);

            if ($status) {
                $_SESSION['user'] = $user['username'];

                header('Location: /');
                exit();
            } else {
                throw new AuthException("Invalid username or password");
            }
        } catch (AuthException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /login');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);

        session_destroy();

        header('Location: /login');
        exit();
    }
}