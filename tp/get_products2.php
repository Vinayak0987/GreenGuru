<?php
$host = 'localhost';
$dbname = 'project';
$username = 'root';
$password = '';
$port='3307'

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,$port);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);

    try {
        $stmt = $pdo->prepare("SELECT * FROM Products2 WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            echo json_encode([
                'success' => true,
                'product' => $product
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Product not found.'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching product: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Product ID not provided.'
    ]);
}
?>
