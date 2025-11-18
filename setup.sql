-- SQL Script to create the contacts table
-- Run this script in your Azure MySQL database
-- Note: In Azure, you typically create the database through Azure Portal first
-- If database 'new' already exists, you can skip the CREATE DATABASE line

-- CREATE DATABASE IF NOT EXISTS new;
USE new;

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Optional: Create an index on email for faster searches
CREATE INDEX IX_contacts_email ON contacts(email);

-- Optional: Create an index on created_at for faster sorting
CREATE INDEX IX_contacts_created_at ON contacts(created_at DESC);

