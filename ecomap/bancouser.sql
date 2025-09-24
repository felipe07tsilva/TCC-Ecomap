CREATE DATABASE ecomap;

USE ecomap;

CREATE TABLE usuarios (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  nome_user VARCHAR(100) NOT NULL,
  email_user VARCHAR(150) UNIQUE NOT NULL,
  senha_user VARCHAR(255) NOT NULL,
  foto_user VARCHAR(255) DEFAULT 'default.png'
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(100) NOT NULL,
    caption TEXT,
    foto_post BLOB,
    time VARCHAR(50),
    likes INT DEFAULT 0,
    comments JSON
);
CREATE TABLE ecopoint (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  address VARCHAR(255) NOT NULL,
  lat DECIMAL(10,7) NOT NULL,
  lng DECIMAL(10,7) NOT NULL,
  materiais TEXT NOT NULL
);
INSERT INTO ecopoint (name, address, lat, lng, materiais)
VALUES (
  'Ecoponto Vila Mariana',
  'R. Afonso Celso, 147 - Vila Mariana, São Paulo - SP, 04119-002',
  -23.590776,
  -46.635269,
  'Cartuchos de tinta,Garrafas de vidro,Garrafas plásticas,Lâmpadas,Latas de metal,Sacos plásticos'
);