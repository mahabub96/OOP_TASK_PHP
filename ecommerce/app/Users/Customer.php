<?php

namespace App\Users;

class Customer extends User
{
    public function getRole(): string
    {
        return 'customer';
    }
}
?>