<?php
include '../includes/db.php';

$id = $_GET['id'];

if ($conn->query("DELETE FROM products WHERE product_index_no = $id")) {
    header("Location: index.php");
    exit();
} else {
    echo "Error deleting product.";
}
?>
