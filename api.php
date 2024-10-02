<?php
require 'config.php';

// Fetch all rules
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'fetch_rules') {
    $stmt = $pdo->query('SELECT * FROM firewall_rules');
    $rules = $stmt->fetchAll();
    echo json_encode($rules);
}

// Add new rule
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_rule') {
    $stmt = $pdo->prepare('INSERT INTO firewall_rules (rule_name, rule_description, action) VALUES (?, ?, ?)');
    $stmt->execute([$_POST['rule_name'], $_POST['rule_description'], $_POST['action']]);
    echo json_encode(['status' => 'success']);
}

// Log a request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'log_request') {
    $stmt = $pdo->prepare('INSERT INTO logs (rule_id, request_url, request_ip, status) VALUES (?, ?, ?, ?)');
    $stmt->execute([$_POST['rule_id'], $_POST['request_url'], $_POST['request_ip'], $_POST['status']]);
    echo json_encode(['status' => 'success']);
}
?>
