CREATE DATABASE money ;
USE money ;
CREATE TABLE personnes (
    personne_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    personne_name VARCHAR(100) NOT NULL
);
CREATE TABLE historique_depot (
    historique_depot_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    the_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    personne_id INT,
    raison_titre VARCHAR(100),
    montant INT, 
    total INT  
);
CREATE TABLE historique_retrait (
    historique_retrait_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    the_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, 
    personne_id INT,
    raison_titre VARCHAR(100),
    raisons_detaille_id INT, 
    total_retrait INT, 
    reste INT  
);
CREATE TABLE historique_depot_retrait (
    historique_depot_retrait_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    the_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, 
    type_d_r ENUM('depot', 'retrait'), 
    personne_id INT,
    raison VARCHAR(100),
    solde_initial INT,
    montant INT,
    solde_final INT
);
CREATE TABLE raisons_detaille (
    raisons_detaille_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    raisons TEXT,
    prix INT    
);
INSERT INTO personnes (personne_name) VALUES 
("Princia"),
("Dada"),
("Neny"),
("Kevin"),
("Anja");


