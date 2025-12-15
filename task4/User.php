<?php
class User{
    private static int $userCount = 0;
    private int $id = 0;
    private string $name;
    private string $email;

    public function __construct(){
        self::$userCount++;
        $this->id = self::$userCount;
    }

    public static function getUserCount(){
        return self::$userCount;

    }

    public static function create($name, $email){
        $user = new self();
        $user->name = $name;
        $user->email = $email;
        return $user;

    }
}
?>