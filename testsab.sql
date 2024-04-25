----
-- phpLiteAdmin database dump (https://www.phpliteadmin.org/)
-- phpLiteAdmin version: 1.9.9-dev
-- Exported: 3:10am on April 25, 2024 (UTC)
-- database file: ./db/tutorial6.db
----
BEGIN TRANSACTION;

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
-- Data dump for review, a total of 4 rows
----
INSERT INTO "review" ("reviewID","userID","paperID","result") VALUES ('1','4','2','4');
INSERT INTO "review" ("reviewID","userID","paperID","result") VALUES ('2','5','1','2');
INSERT INTO "review" ("reviewID","userID","paperID","result") VALUES ('3','5','3','3');
INSERT INTO "review" ("reviewID","userID","paperID","result") VALUES ('4','4','1','1');
COMMIT;
