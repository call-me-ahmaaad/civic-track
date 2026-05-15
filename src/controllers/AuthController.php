<?php

namespace App\Controllers;

use App\Exceptions\DatabaseException;
use App\Exceptions\NotFoundException;
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

        session_start();

        try {
            $user = $this->userRepository->findByUsername($username);

            $status = password_verify($password, $user['password']);

            if ($status) {
                $_SESSION['user'] = $user['username'];

                header('Location: /dashboard');
                exit();
            } else {
                throw new NotFoundException("Invalid username or password");
            }
        } catch (NotFoundException $error) {
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
        session_start();

        unset($_SESSION['user']);

        session_destroy();

        header('Location: /login');
        exit();
    }
}