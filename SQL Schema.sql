CREATE DATABASE waf_dashboard;

USE waf_dashboard;

CREATE TABLE firewall_rules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rule_name VARCHAR(255) NOT NULL,
    rule_description TEXT,
    action ENUM('allow', 'block') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rule_id INT,
    request_url VARCHAR(255),
    request_ip VARCHAR(45),
    status ENUM('blocked', 'allowed') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (rule_id) REFERENCES firewall_rules(id)
);
