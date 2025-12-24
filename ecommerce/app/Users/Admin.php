<?php

namespace App\Users;

class Admin extends User
{
    public function getRole(): string
    {
        return 'admin';
    }
}
?>