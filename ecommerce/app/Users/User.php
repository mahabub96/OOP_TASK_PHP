<?php

namespace App\Users;

use App\Interfaces\Authenticable;
use App\Traits\HasId;

abstract class User implements Authenticable
{
    use HasId;

    protected string $name;
    protected string $email;
    protected string $password;

    // Fix: Support hydration with already-hashed passwords via $isHashed flag
    public function __construct(string $name, string $email, string $password, bool $isHashed = false)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $isHashed ? $password : password_hash($password, PASSWORD_DEFAULT);
    }

    abstract public function getRole(): string;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    // Fix: Add missing name accessor used by repositories and views
    public function getName(): string
    {
        return $this->name;
    }
}

?>