<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'project';
$port="3307";

// Create connection
$conn = new mysqli($host, $user, $password, $database,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function getOrderCount() {
    global $conn;
    $result = $conn->query("SELECT COUNT(*) AS count FROM orders");
    $row = $result->fetch_assoc();
    return $row['count'];
}

// Function to get user count
function getUserCount() {
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM users";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

// Function to get product count
function getProductCount() {
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM products";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

// Function to get cart item count
function getCartItemCount() {
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM cart";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}

// Function to get recent products
function getRecentProducts() {
    global $conn;
    $sql = "SELECT * FROM products ORDER BY product_index_no DESC LIMIT 5";
    $result = $conn->query($sql);
    $products = [];
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    return $products;
}
?>

