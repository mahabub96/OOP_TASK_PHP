<?php 
interface Payable{
    function calculatePayment();
}
interface Identifiable{
    function getId();
    function setId(int $id);
}

class Employee implements Payable, Identifiable{
    private static int $userEmployee = 0;
    private int $id = 0;
    private string $name ;
    private float $hourlyRate;
    private float $hoursWorked;

    public function __construct($name,$hourlyRate,$hoursWorked){
        self::$userEmployee++;
        $this->id = self::$userEmployee;
        $this->name = $name;
        $this->hourlyRate = $hourlyRate;
        $this->hoursWorked = $hoursWorked;
    }

    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function calculatePayment(){
        return $this->hourlyRate*$this->hoursWorked;
    }
}

class Freelancer implements Payable, Identifiable{
    private static int $userFreelancer = 0;
    private int $id = 0;
    private string $name;
    private float $projectRate;
    private float $projectsCompleted;

    public function __construct($name,$projectRate,$projectsCompleted){
        self::$userFreelancer++;
        $this->id = self::$userFreelancer;
        $this->name = $name;
        $this->projectRate = $projectRate;
        $this->projectsCompleted = $projectsCompleted;
    }

    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function calculatePayment(){
        return $this->projectRate*$this->projectsCompleted;
    }
}
?>