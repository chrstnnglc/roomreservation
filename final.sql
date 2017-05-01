CREATE TYPE role AS ENUM('admin', 'media', 'treasury', 'user');

CREATE TYPE status AS ENUM('paid', 'not paid', 'waitlisted');

CREATE TABLE Users (
	id SERIAL PRIMARY KEY,
	username varchar(50) NOT NULL UNIQUE,
	firstname varchar(255),
	lastname varchar(255),
	email varchar(50) UNIQUE,
	password varchar(255) NOT NULL,
	mobile varchar(11),
	affiliation varchar(255),
	users_role role NOT NULL default 'user'
);

CREATE TABLE Rooms (
	id SERIAL PRIMARY KEY,
	name varchar(255) NOT NULL UNIQUE,
	capacity integer NOT NULL,
	rate decimal NOT NULL
);

CREATE TABLE Equipment (
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	brand varchar(50) NOT NULL,
	model varchar(50) NOT NULL,
	price decimal NOT NULL,
	condition varchar(50) NOT NULL,
	room_id integer 
);

CREATE TABLE Reservations (
	id SERIAL PRIMARY KEY,
	user_id integer REFERENCES Users (id) NOT NULL,
	room_id integer REFERENCES Rooms (id) NOT NULL,
	date_of_reservation timestamp NOT NULL,
	date_reserved date NOT NULL,
	start_of_reserved time NOT NULL,
	end_of_reserved time NOT NULL,
	hours integer NOT NULL,
	price decimal NOT NULL,
	date_paid timestamp,
	reservations_status status NOT NULL,
	OR_number integer
);

CREATE TABLE Reservation_Equipments (
	id SERIAL PRIMARY KEY,
	reservation_id integer REFERENCES Reservations (id) NOT NULL,
	equipment_id integer REFERENCES Equipment (id) NOT NULL
); 

CREATE TABLE Logs (
	id SERIAL PRIMARY KEY,
	user_id integer REFERENCES Users (id) NOT NULL,
	date_of_reservation timestamp NOT NULL,
	remarks varchar(255) NOT NULL
);

INSERT INTO Users (username, password, users_role)
VALUES ('admin1','$2a$10$PIUngUxqyEVPeIugGM4VpOniaa1bQ6d..WoaAnXNWLMqMiR1qEcwm', 'admin');
VALUES ('media1','$2a$10$PIUngUxqyEVPeIugGM4VpOniaa1bQ6d..WoaAnXNWLMqMiR1qEcwm', 'media');
VALUES ('treasury1','$2a$10$PIUngUxqyEVPeIugGM4VpOniaa1bQ6d..WoaAnXNWLMqMiR1qEcwm', 'treasury');