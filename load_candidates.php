<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, symbol, image FROM candidates";
$result = $conn->query($sql);

$candidates = array();
while ($row = $result->fetch_assoc()) {
    $candidates[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($candidates);
?>
