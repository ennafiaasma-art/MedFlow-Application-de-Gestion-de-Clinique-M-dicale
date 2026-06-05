<?php

class AdminRepository
{
    private PDO $db;

    public function __construct(PDO $databaseConnection)
    {
        $this->db = $databaseConnection;
    }

    public function createDoctor(
        string $doctor_name,
        string $doctor_email,
        string $doctor_password,
        int $specialite_id
    ): bool {
        try {
            $this->db->beginTransaction();

            $stmtUser = $this->db->prepare("
                INSERT INTO user (nom, email, password, role_id)
                VALUES (:nom, :email, :password, :role_id)
            ");

            $stmtUser->execute([
                ':nom'      => $doctor_name,
                ':email'    => $doctor_email,
                ':password' => password_hash($doctor_password, PASSWORD_BCRYPT), 
                ':role_id'  => 2,
            ]);

            $userId = $this->db->lastInsertId();

            $stmtDoctor = $this->db->prepare("
                INSERT INTO doctor (user_id, specialite_id)
                VALUES (:user_id, :specialite_id)
            ");

            $stmtDoctor->execute([
                ':user_id'       => $userId,
                ':specialite_id' => $specialite_id
            ]);

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log($e->getMessage());
            return false;
        }
    }

    public function getAllDoctors(): array
    {
        try {
            $stmt = $this->db->prepare("
                SELECT
                    d.id_doctor,
                    d.user_id,
                    d.specialite_id,
                    d.status,
                    u.nom,
                    u.email,
                    s.nom AS specialite_nom
                FROM doctor d
                LEFT JOIN user u ON d.user_id = u.id
                LEFT JOIN specialite s ON d.specialite_id = s.id
                ORDER BY d.id_doctor DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getDoctorById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT d.id_doctor, u.id, u.nom, u.email, d.specialite_id, d.status
            FROM doctor d
            INNER JOIN user u ON d.user_id = u.id
            WHERE u.id = ?
        ");
        $stmt->execute([$id]);
        $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
        return $doctor ?: null;
    }

    public function updateDoctor(int $userId, string $doctor_name, int $specialite_id): bool
    {
        try {
            $this->db->beginTransaction();

            $stmtUser = $this->db->prepare("UPDATE user SET nom = ? WHERE id = ?");
            $stmtUser->execute([$doctor_name, $userId]);

            $stmtDoctor = $this->db->prepare("UPDATE doctor SET specialite_id = ? WHERE user_id = ?");
            $stmtDoctor->execute([$specialite_id, $userId]);

            $this->db->commit();
            return true;
        } catch(PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log($e->getMessage());
            return false;
        }
    }

    public function deleteDoctor(int $userId): bool
    {
        try {
            $this->db->beginTransaction();

            $stmtDoctor = $this->db->prepare("DELETE FROM doctor WHERE user_id = ?");
            $stmtDoctor->execute([$userId]);

            $stmtUser = $this->db->prepare("DELETE FROM user WHERE id = ?");
            $stmtUser->execute([$userId]);

            $this->db->commit();
            return true;
        } catch(PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log($e->getMessage());
            return false;
        }
    }

    public function getSpecialities(): array
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM specialite ORDER BY nom ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function createSpecialite(string $nom, ?string $description = null): bool
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO specialite (nom, description) VALUES (:nom, :description)");
            return $stmt->execute([':nom' => $nom, ':description' => $description]);
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function updateSpecialite(int $id, string $nom, ?string $description = null): bool
    {
        $stmt = $this->db->prepare("UPDATE specialite SET nom = ?, description = ? WHERE id = ?");
        return $stmt->execute([$nom, $description, $id]);
    }

    public function deleteSpecialite(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM specialite WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function countDoctors(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM doctor")->fetchColumn();
    }

    public function countPatients(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM patient")->fetchColumn();
    }

    public function countAppointments(): int
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM rendezvous")->fetchColumn();
    }

    public function getCancelationRate(): float
    {
        $stmt = $this->db->query("
            SELECT COALESCE(ROUND((SUM(CASE WHEN statut = 'annule' THEN 1 ELSE 0 END) / COUNT(*)) * 100, 2), 0)
            FROM rendezvous
        ");
        return (float) $stmt->fetchColumn();
    }
    public function getAllSpecialities() {
    try {
        $querySpec = "SELECT id, nom FROM specialite ORDER BY nom ASC";
        $stmtSpec = $this->db->prepare($querySpec);
        $stmtSpec->execute();
        $specialites = $stmtSpec->fetchAll(PDO::FETCH_ASSOC);
        return $specialites;
        } catch (PDOException $e) {
        die('Erreur SQL : ' . $e->getMessage());
    }
}
}