CREATE TABLE users (
                       id SERIAL PRIMARY KEY,
                       name VARCHAR(255) NOT NULL,
                       email VARCHAR(255) UNIQUE NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       created_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE movies (
                        id SERIAL PRIMARY KEY,
                        title VARCHAR(255) NOT NULL,
                        year INT NOT NULL,
                        genre VARCHAR(100) NOT NULL,
                        created_at TIMESTAMP DEFAULT NOW()
);
