<?php

class Appointment
{
    private int $id;
    private int $doctorId;
    private int $patientId;
    private string $date;
    private string $status;

    public function getId(): int {}
    public function getDoctorId(): int {}
    public function getPatientId(): int {}
    public function getDate(): string {}
    public function getStatus(): string {}

    public function setStatus(string $status): void {}
}