/*DROP TABLE user IF EXISTS;*/

CREATE TABLE user(id INTEGER AUTO_INCREMENT, username CHAR(30) NOT NULL, password CHAR(30), aboutyou TEXT, goal TEXT, nickname CHAR(20), birthday CHAR(10), gender CHAR(1), address TEXT, email CHAR(30), phone CHAR(15), status CHAR(2), PRIMARY KEY(id));

/*DROP TABLE quiz IF EXISTS;*/

CREATE TABLE quiz(id INTEGER AUTO_INCREMENT, title TEXT, subject TEXT, noquestion INTEGER, datecreation DATETIME, timelimit REAL, PRIMARY KEY(id));

/*DROP TABLE question IF EXISTS;*/

CREATE TABLE question(id INTEGER AUTO_INCREMENT, quizid INTEGER, problem TEXT, subject TEXT, A TEXT, B TEXT, C TEXT, D TEXT, E TEXT, answer INTEGER, explanation TEXT, PRIMARY KEY(id));

/*DROP TABLE history IF EXISTS;*/

CREATE TABLE history(userid integer, quizid integer, problemid integer, answer integer);