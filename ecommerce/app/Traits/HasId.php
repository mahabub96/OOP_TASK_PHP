<?php
namespace App\Traits;

trait HasId{
    protected ?int $id = null;

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getId(): ?int{
        return $this->id;
    }
}
?>