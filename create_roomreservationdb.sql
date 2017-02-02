create database roomreservationdb;
\c roomreservationdb

drop table rooms;
drop table equipment;
drop table reservations;

create table rooms (
	roomName varchar(50) not null,
	capacity integer not null,
	pricePerHour decimal not null,
	primary key (roomName)
);

create table reservations (
	eventID serial not null,
	eventName varchar(50) not null,
	startDate timestamp not null,
	endDate timestamp not null,
	hours integer not null,
	price decimal not null,
	isPaid boolean not null,
	primary key (eventID)
);

create table equipment (
	equipmentName varchar(50) not null,
	model varchar(50) not null,
	quantity integer not null,
	priceEach decimal not null,
	primary key (equipmentName)
);