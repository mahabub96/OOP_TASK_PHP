<?php
namespace App\Traits;

trait HasId{
    // Fix: Make id nullable to avoid uninitialized typed property errors
    protected ?int $id = null;

    public function setId(int $id): void{
        $this->id = $id;
    }

    // Fix: Return nullable id; callers should ensure setId() was called before usage
    public function getId(): ?int{
        return $this->id;
    }
}
?>