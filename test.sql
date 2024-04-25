----
-- phpLiteAdmin database dump (https://www.phpliteadmin.org/)
-- phpLiteAdmin version: 1.9.9-dev
-- Exported: 2:38am on April 25, 2024 (UTC)
-- database file: ./db/noman
----
BEGIN TRANSACTION;

----
-- Table structure for papers
----
CREATE TABLE papers(
 paperID INTEGER PRIMARY KEY,
 userID INTEGER REFERENCES users(userID),
 paper_type INTEGER REFERENCES "locations"(paper_type),
 accepted BOOLEAN NOT NULL,
   title TEXT NOT NULL,
 abstract TEXT NOT NULL
 );

----
-- Data dump for papers, a total of 0 rows
----

----
-- Table structure for review
----
CREATE TABLE review(
 reviewID INTEGER PRIMARY KEY AUTOINCREMENT,
 userID INTEGER REFERENCES users(userID),
 paperID INTEGER REFERENCES papers(paperID),
 result INTEGER NOT NULL 
 );

----
-- Data dump for review, a total of 0 rows
----

----
-- Table structure for role
----
CREATE TABLE role(
 roleID INTEGER PRIMARY KEY AUTOINCREMENT,
 description TEXT NOT NULL
 );

----
-- Data dump for role, a total of 0 rows
----

----
-- Table structure for locations
----
CREATE TABLE "locations"(
    paper_type INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
   description TEXT NOT NULL,
     location TEXT NOT NULL);

----
-- Data dump for locations, a total of 0 rows
----

----
-- Table structure for users
----
CREATE TABLE users(
 userID INTEGER PRIMARY KEY AUTOINCREMENT,
 name TEXT NOT NULL,
 email_address TEXT NOT NULL,
 affiliation TEXT NOT NULL,
 role NUMERIC NOT NULL
 , contact  VARCHAR);

----
-- Data dump for users, a total of 0 rows
----
COMMIT;
