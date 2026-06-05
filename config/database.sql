CREATE DATABASE medflow;
USE medflow;



-- =========================
-- TABLE ROLE
-- =========================
CREATE TABLE role (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    nom_role VARCHAR(50) NOT NULL
);

-- =========================
-- TABLE USER
-- =========================
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES role(id_role)
);

-- =========================
-- TABLE SPECIALITE
-- =========================
CREATE TABLE specialite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

-- =========================
-- TABLE PATIENT
-- =========================
CREATE TABLE patient (
    id_patient INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- =========================
-- TABLE DOCTOR
-- =========================
CREATE TABLE doctor (
    id_doctor INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    specialite_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (specialite_id) REFERENCES specialite(id)
);

-- =========================
-- TABLE ADMIN
-- =========================
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- =========================
-- TABLE DISPONIBILITE
-- =========================
CREATE TABLE disponibilite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    disponible BOOLEAN DEFAULT TRUE,
    id_medcin INT NOT NULL,
    FOREIGN KEY (id_medcin) REFERENCES doctor(id_doctor)
);

-- =========================
-- TABLE RENDEZVOUS
-- =========================
CREATE TABLE rendezvous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    statut VARCHAR(50) DEFAULT 'en_attente',
    dateCreation DATETIME DEFAULT CURRENT_TIMESTAMP,
    patient_id INT NOT NULL,
    disponibilite_id INT NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patient(id_patient),
    FOREIGN KEY (disponibilite_id) REFERENCES disponibilite(id)
);

-- =========================
-- TABLE ORDONNANCE
-- =========================
CREATE TABLE ordonnance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    dateCreation DATETIME DEFAULT CURRENT_TIMESTAMP,
    rendezVous_id INT NOT NULL,
    FOREIGN KEY (rendezVous_id) REFERENCES rendezvous(id)
);

-- =====================================================
-- DATA TEST
-- =====================================================

-- ROLES
INSERT INTO role (nom_role) VALUES
('Admin'),
('Doctor'),
('Patient');

-- SPECIALITES
INSERT INTO specialite (nom, description) VALUES
('Cardiologue', 'Spécialiste du cœur'),
('Dermatologue', 'Spécialiste de la peau'),
('Pédiatre', 'Spécialiste des enfants'),
('Généraliste', 'Médecin général');

-- USERS
INSERT INTO user (nom, email, role_id) VALUES
('Admin One', 'admin@medflow.com', 1),
('Dr Hassan', 'hassan@medflow.com', 2),
('Dr Sara', 'sara@medflow.com', 2),
('Yassine Patient', 'yassine@medflow.com', 3),
('Omar Patient', 'omar@medflow.com', 3),
('Salma Patient', 'salma@medflow.com', 3);

-- ADMIN
INSERT INTO admin (user_id) VALUES (1);

-- DOCTORS
INSERT INTO doctor (user_id, specialite_id) VALUES
(2, 1),
(3, 2);

-- PATIENTS
INSERT INTO patient (user_id) VALUES
(4),
(5),
(6);

-- DISPONIBILITES (PLANNING)
INSERT INTO disponibilite (date_debut, date_fin, disponible, id_medcin) VALUES
('2026-06-01 09:00:00', '2026-06-01 10:00:00', TRUE, 1),
('2026-06-01 10:00:00', '2026-06-01 11:00:00', FALSE, 1),
('2026-06-01 11:00:00', '2026-06-01 12:00:00', TRUE, 1),

('2026-06-02 09:00:00', '2026-06-02 10:00:00', TRUE, 1),
('2026-06-02 10:00:00', '2026-06-02 11:00:00', FALSE, 1),

('2026-06-03 09:00:00', '2026-06-03 10:00:00', TRUE, 2),
('2026-06-03 10:00:00', '2026-06-03 11:00:00', TRUE, 2),

('2026-06-04 14:00:00', '2026-06-04 15:00:00', TRUE, 2),
('2026-06-04 15:00:00', '2026-06-04 16:00:00', FALSE, 2);

-- RENDEZVOUS
INSERT INTO rendezvous (statut, dateCreation, patient_id, disponibilite_id) VALUES
('en_attente', '2026-06-01 08:30:00', 1, 1),
('confirme', '2026-06-01 09:15:00', 1, 2),
('annule', '2026-06-01 10:00:00', 2, 3),
('en_attente', '2026-06-02 11:20:00', 2, 4),
('en_attente', '2026-06-02 14:45:00', 3, 5),
('en_attente', '2026-06-03 09:00:00', 1, 6),
('confirme', '2026-06-03 09:30:00', 2, 7);

-- ORDONNANCES
INSERT INTO ordonnance (contenu, rendezVous_id) VALUES
('Paracetamol 500mg - 3 jours', 1),
('Amoxicilline 1g - 7 jours', 2),
('Vitamine C - 1 mois', 3),
('Ibuprofene 400mg - 5 jours', 4),
('Omeprazole 20mg - 14 jours', 5);


