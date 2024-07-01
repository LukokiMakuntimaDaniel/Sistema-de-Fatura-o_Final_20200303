create database SistemadeFatura;
use SistemadeFatura;

create table users(
userId int not null primary key auto_increment,
userName  varchar(50) not null,
email  varchar(50) not null,
password varchar(500) not null,
phoneNumber varchar(50) not null,
userType varchar(50) not null,
address  varchar(50) not null
);

create table customers(
customerId int not null primary key auto_increment,
address varchar(50) not null,
city  varchar(50) not null,
phoneNumber varchar(50) not null,
email  varchar(50) not null
);

create table operators(
operatorId  int not null primary key auto_increment,
userId int not null,
foreign key(userId) references users(userId)
);

create table admins(
adminId  int not null primary key auto_increment,
userId int not null,
foreign key(userId) references users(userId)
);

create table products(
productId int primary key auto_increment not null,
productName varchar(50) not null,
description varchar(50) not null,
prince float not null,
amount int not null,
category varchar(50) not null,
image varchar(500) not null
);

create table companies(
companyId int not null primary key auto_increment,
companyName varchar(50) not null,
address varchar(50) not null,
city  varchar(50) not null,
phoneNumber varchar(50) not null,
email  varchar(50) not null
);

create table invoices(
invoiceId int not null primary key auto_increment,
productId int not null,
amount int not null,
total float not null,
invoceDate date not null,
foreign key(productId) references products(productId)
)