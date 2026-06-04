<?php

class DashboardRepository
{
    public function __construct(
        private PDO $pdo
    ){}

    public function getTotalDoctors(): int
    {
        return $this->pdo
            ->query("SELECT COUNT(*) FROM doctors")
            ->fetchColumn();
    }

    public function getTotalAppointments(): int
    {
        return $this->pdo
            ->query("SELECT COUNT(*) FROM appointments")
            ->fetchColumn();
    }

    public function getCancellationRate(): float
    {
        return $this->pdo
            ->query("
                SELECT ROUND(
                    COUNT(
                        CASE
                        WHEN status='cancelled'
                        THEN 1
                        END
                    ) * 100 / COUNT(*),
                2)
                FROM appointments
            ")
            ->fetchColumn();
    }
}