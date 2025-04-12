<?php
$mysqli = new mysqli("localhost", "root", "");

$mysqli->query("CREATE DATABASE IF NOT EXISTS production_planner");
$mysqli->select_db("production_planner");

$mysqli->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)");

$mysqli->query("CREATE TABLE IF NOT EXISTS production_schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    status ENUM('Pending', 'In Progress', 'Completed') DEFAULT 'Pending',
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)");

echo "Database and tables created successfully!";
?>
