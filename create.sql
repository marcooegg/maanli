CREATE TABLE country
(
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(10) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE city
(
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    postal_code VARCHAR(20),
    country_id INT FOREIGN KEY REFERENCES country(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE dependency
(
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE partner
(
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    postal_code VARCHAR(20),
    nip VARCHAR(20),
    city_id INT FOREIGN KEY REFERENCES city(id),
    country_id INT FOREIGN KEY REFERENCES country(id),
    dependency_id INT FOREIGN KEY REFERENCES dependency(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE users
(
    id INT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,
    partner_id INT FOREIGN KEY REFERENCES partner(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE groups
(
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_group
(
    user_id INT FOREIGN KEY REFERENCES users(id),
    group_id INT FOREIGN KEY REFERENCES groups(id),
    PRIMARY KEY (user_id, group_id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE case_type
(
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE case
(
    id INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status VARCHAR(50) NOT NULL,
    case_type_id INT FOREIGN KEY REFERENCES case_type(id),
    sponsored_partner_id INT FOREIGN KEY REFERENCES partner(id),
    accuser_partner_id INT FOREIGN KEY REFERENCES partner(id),
    assigned_user_id INT FOREIGN KEY REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    partner_id INT FOREIGN KEY REFERENCES partner(id)
);


CREATE TABLE appointment
(
    id INT PRIMARY KEY,
    case_id INT FOREIGN KEY REFERENCES case(id),
    user_id INT FOREIGN KEY REFERENCES users(id),
    partner_id INT FOREIGN KEY REFERENCES partner(id),
    location VARCHAR(255) NOT NULL,
    appointment_date TIMESTAMP NOT NULL,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE notes
(
    id INT PRIMARY KEY,
    case_id INT FOREIGN KEY REFERENCES case(id),
    user_id INT FOREIGN KEY REFERENCES users(id),
    content TEXT NOT NULL,
    appointment_id INT FOREIGN KEY REFERENCES appointment(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE attachment
(
    id INT PRIMARY KEY,
    table_name VARCHAR(50) NOT NULL,
    res_id INT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
