--Drop conditions
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS multiverse_lookup CASCADE;
DROP TABLE IF EXISTS decks CASCADE;
DROP TABLE IF EXISTS formats CASCADE;
DROP TABLE IF EXISTS colors CASCADE;
DROP TABLE IF EXISTS deck_color_lookup CASCADE;

--create users table
CREATE TABLE users (
    user_id serial PRIMARY KEY NOT NULL,
    username VARCHAR(30) NOT NULL,
    password_hash text NOT NULL,
    date_created DATE NOT NULL,
    date_deleted DATE
);

--create multiverse lookup table
CREATE TABLE multiverse_lookup (
    multiverse_lookup_id serial PRIMARY KEY NOT NULL,
    multiverse_id int NOT NULL,
    user_id int NOT NULL,
    deck_id int,
    date_created DATE NOT NULL,
    date_deleted DATE
);

--create decks table
CREATE TABLE decks (
    deck_id serial PRIMARY KEY NOT NULL,
    deck_name VARCHAR(30),
    user_id int NOT NULL,
    format_id int NOT NULL,
    date_created DATE NOT NULL,
    date_deleted DATE
);

--create colors table
CREATE TABLE colors (
    color_id serial PRIMARY KEY NOT NULL,
    color_name VARCHAR(10) NOT NULL
);

--create deck color lookup table
CREATE TABLE deck_color_lookup (
    deck_color_lookup_id serial PRIMARY KEY NOT NULL,
    deck_id int NOT NULL,
    color_id int NOT NULL
);

--add foreign key constraints
ALTER TABLE decks
ADD FOREIGN KEY (user_id) REFERENCES users(user_id);
ALTER TABLE multiverse_lookup
ADD FOREIGN KEY (deck_id) REFERENCES decks(deck_id);
ALTER TABLE multiverse_lookup
ADD FOREIGN KEY (user_id) REFERENCES users(user_id);
ALTER TABLE deck_color_lookup
ADD FOREIGN KEY (deck_id) REFERENCES decks(deck_id);
ALTER TABLE deck_color_lookup
ADD FOREIGN KEY (color_id) REFERENCES colors(color_id);

--insert rows into tables unaffected by users
--colors table
INSERT INTO colors (color_name)
VALUES ('Red');
INSERT INTO colors (color_name)
VALUES ('Blue');
INSERT INTO colors (color_name)
VALUES ('White');
INSERT INTO colors (color_name)
VALUES ('Black');
INSERT INTO colors (color_name)
VALUES ('Green');


--insert test user and test data

--insert testing user into database
INSERT INTO users (username, password_hash, date_created)
VALUES ('testing', '', now());

--testing user creates a Commander deck with Inalla as the Commander
INSERT INTO decks (deck_name, user_id, format_id, date_created)
VALUES ('Wizard EDH', 1, 3, now());
INSERT INTO deck_color_lookup (deck_id, color_id)
VALUES (1, 1);
INSERT INTO deck_color_lookup (deck_id, color_id)
VALUES (1, 2);
INSERT INTO deck_color_lookup (deck_id, color_id)
VALUES (1, 4);
--Inalla
INSERT INTO multiverse_lookup (multiverse_id, user_id, deck_id, date_created)
VALUES (433279, 1, 1, now());
--Jace, Unraveler of Secrets
INSERT INTO multiverse_lookup (multiverse_id, user_id, deck_id, date_created)
VALUES (409812, 1, 1, now());
--Kess, Dissident Mage
INSERT INTO multiverse_lookup (multiverse_id, user_id, deck_id, date_created)
VALUES (433280, 1, 1, now());
--Apprentice Necromancer
INSERT INTO multiverse_lookup (multiverse_id, user_id, deck_id, date_created)
VALUES (433029, 1, 1, now());
--Sea Gate Oracle
INSERT INTO multiverse_lookup (multiverse_id, user_id, deck_id, date_created)
VALUES (433024, 1, 1, now());


