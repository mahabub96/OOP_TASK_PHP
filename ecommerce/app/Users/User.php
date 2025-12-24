<?php 
namespace App\Users;

use App\Interfaces\UserRole;
use App\Traits\HasId;
use InvalidArgumentException;

abstract class User implements UserRole{
    use HasId;

    protected string $name;
    protected string $email;

    public function __construct(string $name, string $email){
        if($name === ''){
            throw new InvalidArgumentException('Name cannot be empty.');
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new InvalidArgumentException('Invalid email address');
        }

        $this->name = $name;
        $this->email = $email;
    }

    // Fix: Correct typos ($htis -> $this) and add return type hints
    public function getName(): string {
        return $this->name;
    }
    
    // Fix: Correct typos ($htis -> $this) and add return type hints
    public function getEmail(): string {
        return $this->email;
    }

    
    abstract public function getRole(): string;
}
?>