----
-- phpLiteAdmin database dump (https://bitbucket.org/phpliteadmin/public)
-- phpLiteAdmin version: 1.9.6
-- Exported: 8:19pm on January 12, 2022 (UTC)
-- database file: /usr/share/nginx/databases/database.sqlite
----
BEGIN TRANSACTION;

----
-- Table structure for User
----
CREATE TABLE 'User' ('idUser' INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,'username' TEXT NOT NULL, 'password' TEXT NOT NULL, 'isValid' BOOLEAN NOT NULL, 'isAdmin' BOOLEAN NOT NULL);

----
-- Data dump for User, a total of 4 rows
----
INSERT INTO "User" ("idUser","username","password","isValid","isAdmin") VALUES ('1','dylan','$2y$10$ZhZQVJhC3mJTxsFI2hWNUuwDFg/rGjNKEE5RtAO/JofvxvNKt.a3O','1','1');
INSERT INTO "User" ("idUser","username","password","isValid","isAdmin") VALUES ('2','chris','$2y$10$ZhZQVJhC3mJTxsFI2hWNUuwDFg/rGjNKEE5RtAO/JofvxvNKt.a3O','1','0');
INSERT INTO "User" ("idUser","username","password","isValid","isAdmin") VALUES ('3','abraham','$2y$10$ZhZQVJhC3mJTxsFI2hWNUuwDFg/rGjNKEE5RtAO/JofvxvNKt.a3O','0','1');
INSERT INTO "User" ("idUser","username","password","isValid","isAdmin") VALUES ('4','steph','$2y$10$ZhZQVJhC3mJTxsFI2hWNUuwDFg/rGjNKEE5RtAO/JofvxvNKt.a3O','1','0');

----
-- Table structure for Message
----
CREATE TABLE 'Message' ('idMessage' INTEGER PRIMARY KEY NOT NULL, 'dateReception'  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP  , 'sender' TEXT NOT NULL DEFAULT '', 'receiver' TEXT NOT NULL DEFAULT '', 'subject' TEXT, 'text' TEXT);

----
-- Data dump for Message, a total of 5 rows
----
INSERT INTO "Message" ("idMessage","dateReception","sender","receiver","subject","text") VALUES ('1','2021-10-07 19:53:06','dylan','chris','STI projet','On doit finir le projet avant jeudi prochain !');
INSERT INTO "Message" ("idMessage","dateReception","sender","receiver","subject","text") VALUES ('2','2021-10-07 19:53:47','dylan','chris','Raclette','Je vais faire une raclette le 28 octobre, tu es le bienvenu !');
INSERT INTO "Message" ("idMessage","dateReception","sender","receiver","subject","text") VALUES ('3','2021-10-07 19:53:48','dylan','abraham','Raclette','Je vais faire une raclette le 28 octobre, tu es le bienvenu !');
INSERT INTO "Message" ("idMessage","dateReception","sender","receiver","subject","text") VALUES ('4','2021-10-07 19:54:40','dylan','steph','Raclette','Je vais faire une raclette le 28 octobre, tu es le bienvenu !');
INSERT INTO "Message" ("idMessage","dateReception","sender","receiver","subject","text") VALUES ('5','2021-10-07 19:55:24','chris','dylan','RE: STI projet','Je suis sur le coup !
------------------------------------------------------------
De : dylan
Envoyé le : 2021-10-07 19:53:06
Sujet : STI projet
Message : On doit finir le projet avant jeudi prochain !');
COMMIT;
