CREATE DATABASE mvc_stampee;
USE mvc_stampee;

-- Filtres de recherche de timbres sur la page des enchères.
CREATE TABLE theme (
	id INT NOT NULL PRIMARY KEY auto_increment,
	name varchar(45) NOT NULL
);

CREATE TABLE color (
	id INT NOT NULL PRIMARY KEY auto_increment,
    name varchar(45) NOT NULL
);

CREATE TABLE country (
	id INT NOT NULL PRIMARY KEY auto_increment,
    name varchar(45) NOT NULL
);

CREATE TABLE stamp_condition (
	id INT NOT NULL PRIMARY KEY auto_increment,
    name varchar(45) NOT NULL
);

-- Création d'utilisateur et privilèges.
CREATE TABLE privilege (
	id INT NOT NULL PRIMARY KEY auto_increment,
	role varchar(45) NOT NULL
);

CREATE TABLE user (
	id INT NOT NULL PRIMARY KEY auto_increment,
    name varchar(200) NOT NULL,
    username varchar(200) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    privilege_id INT NOT NULL,
    CONSTRAINT unique_username UNIQUE(username),
    CONSTRAINT unique_email UNIQUE(email),
	CONSTRAINT fk_privilege_user_id foreign key (privilege_id) references privilege(id)
);

-- Timbre et enchères.
CREATE TABLE stamp (
	id INT NOT NULL PRIMARY KEY auto_increment,
	name varchar(200) NOT NULL,
	description TEXT NOT NULL,
	year INT NOT NULL,
	tirage INT NOT NULL,
	width DOUBLE NOT NULL,
    height DOUBLE NOT NULL,
	is_certified TINYINT NOT NULL,
    stamp_condition_id INT NOT NULL,
    country_id INT NOT NULL,
    theme_id INT NOT NULL,
	color_id INT NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_stamp_condition_stamp_id 
    foreign key (stamp_condition_id) references stamp_condition(id),
    CONSTRAINT fk_country_stamp_id 
    foreign key (country_id) references country(id),
    CONSTRAINT fk_theme_stamp_id 
    foreign key (theme_id) references theme(id),
    CONSTRAINT fk_color_stamp_id 
    foreign key (color_id) references color(id),
    CONSTRAINT fk_user_stamp_id 
    foreign key (user_id) references user(id)
);

CREATE TABLE image_to_upload (
    id INT NOT NULL PRIMARY KEY auto_increment,
    file_name VARCHAR(255) NOT NULL,
	position INT NOT NULL, 
    description_alt VARCHAR(100) NOT NULL,
    stamp_id INT NOT NULL,
    CONSTRAINT fk_image_stamp_id 
	FOREIGN KEY (stamp_id) references stamp(id)
);

CREATE TABLE state (
    id INT NOT NULL PRIMARY KEY auto_increment,
    name VARCHAR(60) NOT NULL
);

-- Zone de création des enchères
CREATE TABLE auction (
    id INT NOT NULL PRIMARY KEY auto_increment,
    name VARCHAR(200) NOT NULL,
    started_at datetime NOT NULL,
    finish_at datetime NOT NULL,
    starting_price DOUBLE NOT NULL,
    lord_favorite TINYINT NOT NULL,
    stamp_id INT NOT NULL,
    state_id INT NOT NULL,
    CONSTRAINT fk_stamp_auction_id 
    FOREIGN KEY (stamp_id) references stamp(id),
    CONSTRAINT fk_state_auction_id 
    FOREIGN KEY (state_id) references state(id)
);

CREATE TABLE bid (
    id INT NOT NULL PRIMARY KEY auto_increment,
    bid_amount DOUBLE NOT NULL,
    created_at datetime NOT NULL,
    user_id INT NOT NULL,
    auction_id INT NOT NULL,
    CONSTRAINT fk_users_bid_id 
    foreign key (user_id) references user(id),
	CONSTRAINT fk_auction_bid_id 
    foreign key (auction_id) references auction(id)
);

CREATE TABLE comment( 
    id INT NOT NULL PRIMARY KEY auto_increment,
    comment_text TEXT NOT NULL,
    created_at datetime NOT NULL,
    updated_at datetime NOT NULL,
    user_id INT NOT NULL,
    auction_id INT NOT NULL,
    CONSTRAINT fk_users_comment_id 
    foreign key (user_id) references user(id),
    CONSTRAINT fk_auction_comment_id 
    foreign key (auction_id) references auction(id)
);

DROP TABLE IF EXISTS favorite;

CREATE TABLE favorite (
    auction_id INT NOT NULL,
    user_id INT NOT NULL, 
    PRIMARY KEY (auction_id, user_id),  
    CONSTRAINT fk_auction_favorite_id 
    FOREIGN KEY (auction_id) REFERENCES auction(id),
    CONSTRAINT fk_user_favorite_id 
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Insérer des données dans la table privilege

INSERT INTO privilege (role) VALUES ('Admin');
INSERT INTO privilege (role) VALUES ('Manager');
INSERT INTO privilege (role) VALUES ('Membre');

-- Demande de visualisation des tables
select * FROM privilege;
SELECT * FROM privilege WHERE id = 3;
