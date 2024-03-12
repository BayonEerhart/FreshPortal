CREATE DATABASE IF NOT EXISTS Freshportal;

USE Freshportal;

CREATE TABLE IF NOT EXISTS employee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100),
    address VARCHAR(255),
    birthdate DATE
);
INSERT INTO employee (firstname, lastname, email, address, birthdate) VALUES
('John', 'Doe', 'john@example.com', '123 Main Street, City', '1990-05-15'),
('Jane', 'Smith', 'jane@example.com', '456 Elm Street, Town', '1988-10-20'),
('Michael', 'Johnson', 'michael@example.com', '789 Oak Street, Village', '1995-03-25'),
('Emily', 'Williams', 'emily@example.com', '321 Maple Street, Hamlet', '1992-07-10'),
('Daniel', 'Brown', 'daniel@example.com', '654 Pine Street, Borough', '1985-12-05');
