<?php

namespace App\Controllers;

use App\Exceptions\{DatabaseException, AuthException, NotFoundException};
use App\Repositories\UserRepository;

class AuthController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): void
    {
        require __DIR__ . '/../../views/auth/login.php';
    }

    public function login(): void
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            if (empty($username) || empty($password)) {
                throw new AuthException("Username or password cannot be empty");
            }

            $user = $this->userRepository->findByUsername($username);

            $status = password_verify($password, $user['password']);

            if ($status) {
                $_SESSION['user'] = $user['username'];

                $_SESSION['alert'] = [
                    'icon' => 'success',
                    'title' => 'Login Successful',
                    'text' => 'Welcome back. You have successfully signed in.'
                ];

                header('Location: /');
                exit();
            } else {
                throw new AuthException("Invalid password");
            }
        } catch (AuthException | NotFoundException $error) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Login Failed',
                'text' => 'Invalid username or password.'
            ];

            header('Location: /login');
            exit();
        } catch (DatabaseException $error) {
            $_SESSION['error'] = $error->getMessage();

            header('Location: /databaseError');
            exit();
        }
    }

    public function logout(): void
    {
        unset($_SESSION['user']);

        session_destroy();

        header('Location: /login');
        exit();
    }
}