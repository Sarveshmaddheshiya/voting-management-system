<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $image = $_FILES['image']['name'];
    $symbol = $_FILES['symbol']['name'];

    $imageTarget = "images/" . basename($image);
    $symbolTarget = "images/" . basename($symbol);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $imageTarget) && move_uploaded_file($_FILES['symbol']['tmp_name'], $symbolTarget)) {
        $sql = "INSERT INTO candidates (name, image, symbol, votes) VALUES ('$name', '$imageTarget', '$symbolTarget', 0)";
        if ($conn->query($sql) === TRUE) {
            header("Location: admin_panel.html"); // Redirect to the admin panel
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload image or symbol";
    }
}

$conn->close();
?>
