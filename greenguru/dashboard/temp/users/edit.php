<?php
require_once '../includes/db.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = 'User ID is required';
    header('Location: /admin-dashboard/users/');
    exit;
}

$userId = $_GET['id'];
$errorMessage = '';
$formData = [];

// Get user data
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error_message'] = 'User not found';
    header('Location: /admin-dashboard/users/');
    exit;
}

$formData = $result->fetch_assoc();
$stmt->close();

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate form data
    if (empty($username) || empty($email)) {
        $errorMessage = 'Username and email are required';
        $formData['username'] = $username;
        $formData['email'] = $email;
    } else {
        // Update user in database
        if (!empty($password)) {
            // Update with new password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $username, $email, $hashedPassword, $userId);
        } else {
            // Update without changing password
            $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $username, $email, $userId);
        }
        
        if ($stmt->execute()) {
            // Set success message and redirect
            $_SESSION['success_message'] = 'User updated successfully';
            header('Location: /admin-dashboard/users/');
            exit;
        } else {
            $errorMessage = 'Error updating user: ' . $conn->error;
        }
        
        $stmt->close();
    }
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
    </div>
    
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $errorMessage; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">User Information</h5>
            <p class="card-text text-muted">Update the user details.</p>
        </div>
        <div class="card-body">
            <form action="/admin-dashboard/users/edit.php?id=<?php echo $userId; ?>" method="POST" class="form-container needs-validation" novalidate>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($formData['username']); ?>" required>
                    <div class="invalid-feedback">
                        Please provide a username.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($formData['email']); ?>" required>
                    <div class="invalid-feedback">
                        Please provide a valid email.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password (leave blank to keep current)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="invalid-feedback">
                        Please provide a password.
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="/admin-dashboard/users/" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

