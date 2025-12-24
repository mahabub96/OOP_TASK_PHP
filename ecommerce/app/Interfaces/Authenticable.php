<?php

namespace App\Interfaces;

interface Authenticable
{
    public function getEmail(): string;

    public function getPassword(): string;

    public function verifyPassword(string $password): bool;
}
?>