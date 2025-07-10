<?php
require_once '../includes/db.php';

$errorMessage = '';
$formData = [
    'username' => '',
    'email' => ''
];

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validate form data
    if (empty($username) || empty($email) || empty($password)) {
        $errorMessage = 'All fields are required';
        $formData['username'] = $username;
        $formData['email'] = $email;
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user into database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            // Set success message and redirect
            $_SESSION['success_message'] = 'User created successfully';
            header('Location: /admin-dashboard/users/');
            exit;
        } else {
            $errorMessage = 'Error creating user: ' . $conn->error;
        }
        
        $stmt->close();
    }
}

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add New User</h1>
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
            <p class="card-text text-muted">Enter the details for the new user.</p>
        </div>
        <div class="card-body">
            <form action="/admin-dashboard/users/add.php" method="POST" class="form-container needs-validation" novalidate>
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
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="invalid-feedback">
                        Please provide a password.
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="/admin-dashboard/users/" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

