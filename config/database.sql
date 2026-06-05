CREATE DATABASE medflow;


USE medflow;

CREATE TABLE role (
    id_role INT AUTO_INCREMENT PRIMARY KEY,
    nom_role VARCHAR(50) NOT NULL
);

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES role(id_role)
);

CREATE TABLE specialite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE patient (
    id_patient INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE doctor (
    id_doctor INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    specialite_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (specialite_id) REFERENCES specialite(id)
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE disponibilite (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    disponible BOOLEAN DEFAULT TRUE,
    id_medcin INT NOT NULL,
    FOREIGN KEY (id_medcin) REFERENCES doctor(id_doctor)
);

CREATE TABLE rendezvous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    statut VARCHAR(50) DEFAULT 'en_attente',
    dateCreation DATETIME DEFAULT CURRENT_TIMESTAMP,
    patient_id INT NOT NULL,
    disponibilite_id INT NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patient(id_patient),
    FOREIGN KEY (disponibilite_id) REFERENCES disponibilite(id)
);

CREATE TABLE ordonnance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    dateCreation DATETIME DEFAULT CURRENT_TIMESTAMP,
    rendezVous_id INT NOT NULL,
    FOREIGN KEY (rendezVous_id) REFERENCES rendezvous(id)
);

INSERT INTO role (nom_role)
VALUES
('Admin'),
('Doctor'),
('Patient');

INSERT INTO specialite (nom, description)
VALUES
('Cardiologue', 'Spécialiste du cœur'),
('Dermatologue', 'Spécialiste de la peau');

INSERT INTO user (nom, email, role_id)
VALUES
('Amine', 'amine@gmail.com', 1),
('Dr Hassan', 'hassan@gmail.com', 2),
('Yassine', 'yassine@gmail.com', 3);

INSERT INTO admin (user_id)
VALUES (1);

INSERT INTO doctor (user_id, specialite_id)
VALUES (2, 1);

INSERT INTO patient (user_id)
VALUES (3);

INSERT INTO disponibilite
(date_debut, date_fin, disponible, id_medcin)
VALUES
('2025-06-01 09:00:00',
 '2025-06-01 10:00:00',
 TRUE,
 1);

INSERT INTO rendezvous
(statut, patient_id, disponibilite_id)
VALUES
('confirmé', 1, 1);

INSERT INTO ordonnance
(contenu, rendezVous_id)
VALUES
('Paracetamol 500mg', 1);