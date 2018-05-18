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
    deck_id int
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

--create formats table
CREATE TABLE formats (
    format_id serial PRIMARY KEY NOT NULL,
    format_name VARCHAR(30) NOT NULL,
    rules_url TEXT NOT NULL
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
ALTER TABLE decks
ADD FOREIGN KEY (format_id) REFERENCES formats(format_id);
ALTER TABLE multiverse_lookup
ADD FOREIGN KEY (deck_id) REFERENCES decks(deck_id);
ALTER TABLE multiverse_lookup
ADD FOREIGN KEY (user_id) REFERENCES users(user_id);
ALTER TABLE deck_color_lookup
ADD FOREIGN KEY (deck_id) REFERENCES decks(deck_id);
ALTER TABLE deck_color_lookup
ADD FOREIGN KEY (color_id) REFERENCES colors(color_id);

