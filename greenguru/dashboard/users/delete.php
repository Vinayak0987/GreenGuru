<?php
require_once '../includes/db.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = 'User ID is required';
    header('Location: /admin-dashboard/users/');
    exit;
}

$userId = $_GET['id'];

// Delete user from database
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    $_SESSION['success_message'] = 'User deleted successfully';
} else {
    $_SESSION['error_message'] = 'Error deleting user: ' . $conn->error;
}

$stmt->close();

// Redirect back to users page
header('Location: /admin-dashboard/users/');
exit;
?>

