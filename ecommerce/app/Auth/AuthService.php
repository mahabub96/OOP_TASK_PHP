<?php

namespace App\Auth;

use App\Repositories\UserRepository;
use App\Users\User;
use App\Users\Admin;
use App\Users\Customer;
use RuntimeException;

class AuthService
{
    private UserRepository $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register(string $name, string $email, string $password, string $role = 'customer'): User
    {
        $role = strtolower($role);

        $user = match ($role) {
            'admin'    => new Admin($name, $email, $password),
            'customer' => new Customer($name, $email, $password),
            default    => throw new RuntimeException('Invalid role'),
        };

        $this->users->save($user);
        return $user;
    }

    public function login(string $email, string $password): User
    {
        $user = $this->users->findByEmail($email);

        if ($user === null || !$user->verifyPassword($password)) {
            throw new RuntimeException('Invalid credentials');
        }

        $_SESSION['user_id'] = $user->getId();
        $_SESSION['role'] = $user->getRole();

        return $user;
    }

    public function logout(): void
    {
        session_destroy();
    }

    public function user(): ?User
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return $this->users->find((int)$_SESSION['user_id']);
    }
}
?>