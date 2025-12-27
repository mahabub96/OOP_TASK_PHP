<?php

namespace App\Repositories;

use PDO;
use InvalidArgumentException;
use App\Users\User;
use App\Users\Admin;
use App\Users\Customer;

class UserRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Save user
     */
    public function save(User $user): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (name, email, password, role)
             VALUES (:name, :email, :password, :role)'
        );

        $stmt->execute([
            'name'     => $user->getName(),
            'email'    => $user->getEmail(),
            'password' => $user->getPassword(),
            'role'     => $user->getRole(),
        ]);

        $user->setId((int) $this->pdo->lastInsertId());
    }

    /**
     * Find user by ID
     */
    public function find(int $id): ?User
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE id = :id'
        );

        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrate($row) : null;
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM users WHERE email = :email'
        );

        $stmt->execute(['email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrate($row) : null;
    }

    /**
     * Get all users
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM users');

        $users = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $this->hydrate($row);
        }

        return $users;
    }

    private function hydrate(array $row): User
    {
        $password = $row['password'];

        return match ($row['role']) {
            'admin'    => $this->createAdmin($row, $password),
            'customer' => $this->createCustomer($row, $password),
            default    => throw new InvalidArgumentException(
                'Invalid user role'
            ),
        };
    }

    private function createAdmin(array $row, string $password): User
    {
        $user = new Admin(
            $row['name'],
            $row['email'],
            $password,
            true
        );

        $user->setId((int) $row['id']);

        return $user;
    }

    private function createCustomer(array $row, string $password): User
    {
        $user = new Customer(
            $row['name'],
            $row['email'],
            $password,
            true
        );

        $user->setId((int) $row['id']);

        return $user;
    }
}

?>