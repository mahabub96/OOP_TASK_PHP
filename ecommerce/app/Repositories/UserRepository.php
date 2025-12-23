<?php 
namespace App\Repositories;

use PDO;
use App\Users\User;
use App\Users\Customer;
use InvalidArgumentException;

class UserRepository{
    private PDO $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function save(User $user): void{
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email,role) VALUES (:name, :email, :role)");
        $stmt -> execute([
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'role'=>$user->getRole()
        ]);

        $user->setId((int)$this->pdo->lastInsertId());
    }

    public function find(int $id): ?User{
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id'=>$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return null;
        }

        return $this->hydrate($row);
    }

    public function findAll(): array{
        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $users[] = $this->hydrate($row); 
        }
        return $users;
    }

    public function findByEmail(string $email): ?User{
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email'=>$email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row){
            return null;
        }

        return $this->hydrate($row);
    }

    private function hydrate(array $row): User
    {
        if ($row['role'] === 'customer') {
            $user = new Customer(
                $row['name'],
                $row['email']
            );
        } else {
            throw new InvalidArgumentException('Invalid user role in database.');
        }

        $user->setId((int)$row['id']);

        return $user;
    }



}
?>