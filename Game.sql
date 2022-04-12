
CREATE DATABASE game_o_lounge;


CREATE TABLE sign_up (
	Username VARCHAR(50) PRIMARY KEY,
	Email VARCHAR(50),
	Password VARCHAR(20),
	C_Password VARCHAR(20),
	Token INT,
	Profile_Pic VARCHAR(50)
);


CREATE TABLE score (
Username VARCHAR(40),
Game VARCHAR(20),
Score INT
CONSTRAINT pk_score PRIMARY KEY (Username,Game)
);