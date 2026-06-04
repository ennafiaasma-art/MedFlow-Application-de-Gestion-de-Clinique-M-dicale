<?php

class SpecialtyRepository
{
    public function __construct(
        private PDO $pdo
    ){}

    public function findAll(): array
    {
        return $this->pdo
            ->query("SELECT * FROM specialties")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO specialties(name) VALUES(?)"
        );

        return $stmt->execute([$name]);
    }
}