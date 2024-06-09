<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$candidateId = $data['candidateId'];

$sql = "UPDATE candidates SET votes = votes + 1 WHERE id = $candidateId";

$response = array('success' => false);

if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['error'] = $conn->error;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
