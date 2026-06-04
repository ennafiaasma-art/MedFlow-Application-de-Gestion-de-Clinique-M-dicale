<?php

class DoctorRepository
{
    public function __construct(
        private PDO $pdo
    ){}

    public function findAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT d.*, s.name as specialty
            FROM doctors d
            JOIN specialties s
            ON d.specialty_id = s.id
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(Doctor $doctor): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO doctors
            (first_name,last_name,email,specialty_id)
            VALUES(?,?,?,?)
        ");

        return $stmt->execute([
            $doctor->getFirstName(),
            $doctor->getLastName(),
            $doctor->getEmail(),
            $doctor->getSpecialtyId()
        ]);
    }

    public function disable(int $id): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE doctors
            SET active = 0
            WHERE id = ?
        ");

        return $stmt->execute([$id]);
    }
}