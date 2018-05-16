CREATE TABLE users (
	user_id serial NOT NULL,
	username VARCHAR(30) NOT NULL,
	password_hash VARCHAR(30) NOT NULL,
	CONSTRAINT pk_user_id PRIMARY KEY (user_id)
);

CREATE TABLE notes (
	note_id serial NOT NULL,
	talk_id INT NOT NULL,
	user_id INT NOT NULL,
	date_created TIMESTAMP NOT NULL,
	text TEXT,
	CONSTRAINT pk_note_id PRIMARY KEY (note_id)
);

CREATE TABLE conferences (
	conference_id serial NOT NULL,
	session_year INT NOT NULL,
	session_month VARCHAR(3) NOT NULL,
	CONSTRAINT pk_conference_id PRIMARY KEY (conference_id)
);

CREATE TABLE speakers (
	speaker_id serial NOT NULL,
	speaker_name VARCHAR(30) NOT NULL,
	CONSTRAINT pk_speaker_id PRIMARY KEY (speaker_id)
);

CREATE TABLE talks (
	talk_id serial NOT NULL,
	conference_id INT NOT NULL,
	speaker_id INT NOT NULL,
	talk_date DATE NOT NULL,
	talk_title VARCHAR(30) NOT NULL,
	CONSTRAINT pk_talk_id PRIMARY KEY (talk_id)
);