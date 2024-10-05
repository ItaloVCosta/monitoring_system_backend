CREATE TABLE servers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  ip_address VARCHAR(255) NOT NULL,
  status TINYINT NOT NULL,
  cpu_usage FLOAT NOT NULL,
  memory_usage FLOAT NOT NULL,
  last_checked DATETIME NOT NULL,
  is_monitored TINYINT NOT NULL
);