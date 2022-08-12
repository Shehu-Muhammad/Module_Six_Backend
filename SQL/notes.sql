-- CREATE DATABASE
Create DATABASE movies_database;

-- CREATE TABLES
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE genre (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE ratings (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    rating VARCHAR(255) NOT NULL
);

CREATE TABLE movies (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL
);

CREATE TABLE details (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    movie_id INT,
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    genre_id VARCHAR(255),
    FOREIGN KEY (genre_id) REFERENCES genre(id),
    rating_id INT,
    FOREIGN KEY (rating_id) REFERENCES ratings(id),
    release_year INT NOT NULL,
    run_time INT NOT NULL
);

CREATE TABLE reviews (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    movie_id INT,
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    score float NOT NULL
)

-- STORE genre id with commas
-- Explode() to split string by commas

-- INSERT INTO
INSERT INTO genre (name) VALUES ('horror');

/*Horror
Sci-Fi
Action
Comedy
Drama
Thriller
Fantasy
Adventure
Psychological Thriller
War
Mystery
Anime
Documentary
Western
Crime
Superhero
Musical
Suspense
Coming of Age
History
Family
Romance
Biography
Dark Comedy
Gangster*/



