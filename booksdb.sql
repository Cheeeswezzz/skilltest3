CREATE DATABASE booksdb;
USE booksdb;

CREATE TABLE books(
    isbn INT,
    title TEXT,
    author TEXT,
    copyright TEXT,
    edition TEXT,
    price DECIMAL(10,2),
    qty INT,
    total DECIMAL
);
