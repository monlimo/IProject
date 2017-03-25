CREATE TABLE customers
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  firstname VARCHAR(32),
  secondname VARCHAR(50),
  adress VARCHAR(256),
  telephone VARCHAR(20)
);
CREATE INDEX ixName ON customers (firstname);
CREATE TABLE `order`
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  product_id INT(11),
  customer_id INT(11)
);
CREATE TABLE product
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  short_description VARCHAR(255),
  description TEXT,
  price FLOAT,
  customer_id INT(11)
);
CREATE TABLE sessions
(
  sid VARCHAR(32) PRIMARY KEY NOT NULL,
  user_id INT(11) NOT NULL,
  last_update TIMESTAMP DEFAULT 'CURRENT_TIMESTAMP' NOT NULL
);
CREATE UNIQUE INDEX session_session_id_uindex ON sessions (sid);
CREATE TABLE users
(
  id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  login VARCHAR(255),
  password VARCHAR(255)
);