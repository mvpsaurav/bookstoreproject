create database if not exists bookstore;
use bookstore;

SET foreign_key_checks = 0;
DROP TABLE IF EXISTS account_book;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS accounts;
SET foreign_key_checks = 1;

create table accounts(
ismoderator boolean not null,
usermail varchar(30) not null,
password varchar(100) not null,
primary key (usermail)
);

create table books(
isbn varchar(20) not null,
title varchar(30) not null,
image varchar(100) not null,
author varchar(30) not null,
category varchar(30) not null,
summary text(250) not null,
price double not null,
dateadded date not null,
primary key(isbn)
);

load data infile 'BookList.txt'
into table books
fields terminated by ','
ignore 1 lines (isbn, title, image, author, category, summary, @price, @datevar) SET price = 19.99, dateadded = CURDATE();

create table account_book(
usermail varchar(30) not null,
booknumber varchar(20) not null,
score int not null,
review text(140) not null,
postdate datetime not null,
wishlist boolean not null,
primary key (usermail, booknumber),
foreign key (usermail) references accounts(usermail),
foreign key (booknumber) references books(isbn)
);

-- 104.130.213.200
