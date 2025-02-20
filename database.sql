
CREATE DATABASE IF NOT EXISTS stock_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE stock_db;

-- Table sejours
DROP TABLE IF EXISTS sejours;
CREATE TABLE sejours (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE DEFAULT NULL
);

-- Table products
DROP TABLE IF EXISTS products;
CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  category VARCHAR(100) DEFAULT NULL,
  quantity INT NOT NULL DEFAULT 0,
  threshold_alert INT NOT NULL DEFAULT 0,
  price DECIMAL(10,2) NOT NULL DEFAULT 0,
  unit VARCHAR(50) DEFAULT 'pièce',
  sejour_id INT DEFAULT NULL,
  FOREIGN KEY (sejour_id) REFERENCES sejours(id) ON DELETE SET NULL
);

-- Table suppliers
DROP TABLE IF EXISTS suppliers;
CREATE TABLE suppliers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  contact_name VARCHAR(255) DEFAULT NULL,
  phone VARCHAR(50) DEFAULT NULL,
  email VARCHAR(255) DEFAULT NULL,
  address VARCHAR(255) DEFAULT NULL
);

-- Table expenses (budget)
DROP TABLE IF EXISTS expenses;
CREATE TABLE expenses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sejour_id INT DEFAULT NULL,
  category VARCHAR(100) NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  date DATE NOT NULL,
  notes TEXT,
  FOREIGN KEY (sejour_id) REFERENCES sejours(id) ON DELETE SET NULL
);

