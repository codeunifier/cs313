DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS conferences CASCADE;
DROP TABLE IF EXISTS session CASCADE;
DROP TABLE IF EXISTS speakers CASCADE;
DROP TABLE IF EXISTS talks CASCADE;
DROP TABLE IF EXISTS notes CASCADE;

CREATE TABLE users (
  user_id serial NOT NULL,
  username VARCHAR(30) NOT NULL,
  password_hash VARCHAR(30) NOT NULL,
  CONSTRAINT pk_user_id PRIMARY KEY (user_id)
);

CREATE TABLE conferences (
  conference_id serial NOT NULL,
  session_year INT NOT NULL,
  session_month VARCHAR(3) NOT NULL,
  CONSTRAINT pk_conference_id PRIMARY KEY (conference_id)
);

CREATE TABLE session (
  session_id serial NOT NULL,
  session_name VARCHAR(10),
  CONSTRAINT pk_session_id PRIMARY KEY (session_id)
);

-- create speakers table

CREATE TABLE speakers (
  speaker_id serial NOT NULL,
  speaker_name VARCHAR(30) NOT NULL,
  CONSTRAINT pk_speaker_id PRIMARY KEY (speaker_id)
);

-- create talks table

CREATE TABLE talks (
  talk_id serial NOT NULL,
  conference_id INT NOT NULL,
  session_id INT NOT NULL,
  speaker_id INT NOT NULL,
  talk_title VARCHAR(30) NOT NULL,
  CONSTRAINT pk_talk_id PRIMARY KEY (talk_id),
  CONSTRAINT fk_talk_speaker_id FOREIGN KEY (speaker_id) REFERENCES speakers(speaker_id),
  CONSTRAINT fk_talk_conference_id FOREIGN KEY (conference_id) REFERENCES conferences(conference_id),
  CONSTRAINT fk_talk_session_id FOREIGN KEY (session_id) REFERENCES session(session_id)
);

CREATE TABLE notes (
  note_id serial NOT NULL,
  talk_id INT NOT NULL,
  user_id INT NOT NULL,
  date_created TIMESTAMP NOT NULL,
  text TEXT,
  CONSTRAINT pk_note_id PRIMARY KEY (note_id),
  CONSTRAINT fk_note_user_id FOREIGN KEY (user_id) REFERENCES users(user_id),
  CONSTRAINT fk_note_talk_id FOREIGN KEY (talk_id) REFERENCES talks(talk_id)
);

INSERT INTO users (username, password_hash)
VALUES ('john', 'pass23413');


INSERT INTO conferences (session_year, session_month)
VALUES (2018, 'APR');


INSERT INTO speakers (speaker_name) 
VALUES ('Neil L. Andersen');


INSERT INTO speakers (speaker_name) 
VALUES ('Dallin H. Oaks');


INSERT INTO speakers (speaker_name) 
VALUES ('David A. Bednar');


INSERT INTO session (session_name)
 VALUES ('SAT_AM');


INSERT INTO session (session_name)
 VALUES ('SAT_PM');


INSERT INTO session (session_name)
 VALUES ('PRIESTHOOD');


INSERT INTO talks (conference_id, session_id, speaker_id, talk_title)
VALUES (1, 1, 1, 'The Prophet of God');


INSERT INTO talks (conference_id, session_id, speaker_id, talk_title)
VALUES (1, 3, 2, 'The Powers of the Priesthood');


INSERT INTO talks (conference_id, session_id, speaker_id, talk_title)
VALUES (1, 2, 3, 'Meek and Lowly of Heart');


INSERT INTO notes (talk_id, user_id, date_created, text)
VALUES (1, 1, current_timestamp, 'Some randome note for talk 1...');


INSERT INTO notes (talk_id, user_id, date_created, text)
VALUES (1, 1, current_timestamp, 'Some randome note for talk 1... again...');


INSERT INTO notes (talk_id, user_id, date_created, text)
VALUES (2, 1, current_timestamp, 'Some randome note for talk 2...');


INSERT INTO notes (talk_id, user_id, date_created, text)
VALUES (2, 1, current_timestamp, 'Some randome note for talk 2... again...');


INSERT INTO notes (talk_id, user_id, date_created, text)
VALUES (3, 1, current_timestamp, 'Some randome note for talk 3...');


INSERT INTO notes (talk_id, user_id, date_created, text)
VALUES (3, 1, current_timestamp, 'Some randome note for talk 3... again...');