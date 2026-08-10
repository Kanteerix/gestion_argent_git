CREATE DATABASE money ;
USE money ;
CREATE TABLE personnes (
    personne_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    personne_name VARCHAR(100) NOT NULL
);
CREATE TABLE retrait (
    retrait_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    the_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL, 
    personne_id INT,
    raisons_detaille_id INT,  
    reste INT  
);
CREATE TABLE raisons_detaille (
    raisons_detaille_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    raisons TEXT,
    prix INT    
);

