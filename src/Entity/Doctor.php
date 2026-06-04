<?php

class Doctor
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private int $specialtyId;
    private bool $active;

    public function getId(): int {}
    public function getFirstName(): string {}
    public function getLastName(): string {}
    public function getEmail(): string {}
    public function getSpecialtyId(): int {}
    public function isActive(): bool {}

    public function setFirstName(string $firstName): void {}
    public function setLastName(string $lastName): void {}
    public function setEmail(string $email): void {}
    public function setSpecialtyId(int $specialtyId): void {}
    public function setActive(bool $active): void {}
}