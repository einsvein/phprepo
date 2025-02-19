CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE user_info (
    info_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    stay_abroad BOOLEAN NOT NULL,
    year_abroad INT,
    country_abroad VARCHAR(100),
    date_from DATE,
    days_origin INT,
    days_abroad INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
