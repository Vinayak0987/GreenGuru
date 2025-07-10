<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$port = 3307;  // Specify the custom port

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch products from the database
$sql = "SELECT product_index_no, name, price, rating, sustainability_score, image,DESCRIPTION FROM products";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

// Output products as JSON
echo json_encode($products);
?>
