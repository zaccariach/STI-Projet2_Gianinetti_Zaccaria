----
-- phpLiteAdmin database dump (https://bitbucket.org/phpliteadmin/public)
-- phpLiteAdmin version: 1.9.6
-- Exported: 7:35pm on September 24, 2021 (UTC)
-- database file: /usr/share/nginx/databases/database.sqlite
----
BEGIN TRANSACTION;

----
-- Table structure for Message
----
CREATE TABLE 'Message' ('idMessage' INTEGER PRIMARY KEY NOT NULL, 'dateReception' DATETIME DEFAULT CURRENT_TIMESTAMP, 'sender' TEXT NOT NULL, 'receiver' TEXT NOT NULL, 'subject' TEXT, 'text' TEXT);

----
-- Data dump for Message, a total of 3 rows
----
INSERT INTO "Message" ("idMessage","dateReception","sender","receiver","subject","text") VALUES ('1','2021-09-24 15:21:07','dylan','test','RDV','rendez-vous au bercail');
INSERT INTO "Message" ("idMessage","dateReception","sender","receiver","subject","text") VALUES ('2','2021-09-24 15:21:07','test','dylan','meeting','demain 14h30');
INSERT INTO "Message" ("idMessage","dateReception","sender","receiver","subject","text") VALUES ('3','2021-09-24 15:21:07','dylan','test','voiture','achat de la voiture');

----
-- Table structure for User
----
CREATE TABLE 'User' ('idUser' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,'username' TEXT NOT NULL, 'password' TEXT NOT NULL, 'isValid' BOOLEAN NOT NULL, 'isAdmin' BOOLEAN NOT NULL);

----
-- Data dump for User, a total of 2 rows
----
INSERT INTO "User" ("idUser","username","password","isValid","isAdmin") VALUES ('1','test','test','1','0');
INSERT INTO "User" ("idUser","username","password","isValid","isAdmin") VALUES ('2','dylan','1234','0','1');
COMMIT;
