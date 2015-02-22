create database if not exists bookstore;
use bookstore;

create table if not exists accounts(
ismoderator boolean not null,
usermail varchar(30) not null,
password varchar(100) not null,
primary key (usermail)
);

create table if not exists books(
isbn varchar(20) not null, 
title varchar(30) not null,
image varchar(100) not null,
author varchar(30) not null, 
category varchar(30) not null, 
summary text(250) not null,
price int not null,
dateadded date not null,
primary key(isbn)
);

create table if not exists account_book(
usermail varchar(30) not null,
booknumber varchar(30) not null,
score int not null, 
review text(140) not null,
postdate datetime not null,
wishlist boolean not null,
primary key (usermail, booknumber),
foreign key (usermail) references accounts(usermail),
foreign key (booknumber) references books(isbn)
);

-- 104.130.213.200