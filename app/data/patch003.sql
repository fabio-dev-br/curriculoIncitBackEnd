-- Patch para criar a database curriculoIncit e criar as tabelas modeladas do banco de dados

create database curriculoIncit;

use curriculoIncit;

create table user(
    id int(11) not null auto_increment primary key,
    name varchar(50),
    email varchar(50),
    identity int(15),
    user_type boolean,
    password varchar(50)
);

create table request_password(
    id int(11) not null auto_increment primary key,
    id_user int(11),
    hash varchar(32),
    exp_date datetime,
    foreign key(id_user) references user(id)
);

create table curriculum(
    id int(11) not null auto_increment primary key,
    area varchar(100),
    course varchar(100),
    id_file int(11),
    reg_date datetime,
    reg_up datetime,
    institute varchar(50),
    graduate_year int(4),
    id_user int(11),
    foreign key(id_user) references user(id)
);

create table user_hability(
    id int(11) not null auto_increment primary key,
    hability varchar(50),
    id_curriculum int(11),
    foreign key(id_curriculum) references curriculum(id)
);

create table interest(
    id int(11) not null auto_increment primary key,
    interest varchar(50),
    id_user int(11),
    foreign key(id_user) references user(id)
);