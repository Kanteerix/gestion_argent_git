CREATE DATABASE money ;
USE money ;
CREATE TABLE personnes (
    personne_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    personne_name VARCHAR(100) NOT NULL
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
INSERT INTO personnes (personne_name) VALUES 
("Princia"),
("Dada"),
("Neny"),
("Kevin"),
("Anja");


