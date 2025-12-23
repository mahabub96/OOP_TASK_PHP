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

    public function getName(){
        return $htis->name;
    }
    
    public function getEmail(){
        return $htis->email;
    }

    
    abstract public function getRole(): string;
}
?>