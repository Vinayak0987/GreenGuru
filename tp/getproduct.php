<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$port="3307";

$conn = new mysqli($host, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product by ID
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    $sql = "SELECT * FROM products1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode($product);
    } else {
        echo json_encode(["error" => "Product not found"]);
    }

    $stmt->close();
}

$conn->close();
?>
