CREATE DATABASE article;
USE article;

CREATE TABLE users(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) UNIQUE NOT NULL,
password VARCHAR(100) NOT NULL,
img VARCHAR(255),
roles VARCHAR(50)
)ENGINE=InnoDB;

CREATE TABLE article(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
title VARCHAR(50) NOT NULL,
content TEXT NOT NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
updated_at DATE,
id_users INT
)ENGINE=InnoDB;

CREATE TABLE category(
id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
name_category VARCHAR(50) UNIQUE NOT NULL
)ENGINE=InnoDB;

CREATE TABLE article_category(
id_article INT,
id_category INT,
PRIMARY KEY(id_article, id_category)
)ENGINE=InnoDB;

-- Constraintes de foreign key
ALTER TABLE article
ADD CONSTRAINT fk_write_users
FOREIGN KEY(id_users)
REFERENCES users(id);

ALTER TABLE article_category
ADD CONSTRAINT fk_add_category
FOREIGN KEY(id_category)
REFERENCES category(id);

ALTER TABLE article_category
ADD CONSTRAINT fk_add_article
FOREIGN KEY(id_article)
REFERENCES article(id);

INSERT INTO category(name_category) VALUES
('news'),('cinema'),('musique'),('sport'),('litterature'),('cuisine'),('jeux video');