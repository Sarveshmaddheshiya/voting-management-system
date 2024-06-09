<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, symbol, votes FROM candidates";
$result = $conn->query($sql);

$results = array();
while ($row = $result->fetch_assoc()) {
    $results[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($results);
?>
