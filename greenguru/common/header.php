<?php
session_start();
$user_id = $_SESSION['user_id'] ?? null;
$username = $_SESSION['username'] ?? null;
$email = $_SESSION['email'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenGURU</title>
    <link rel="stylesheet" href="/styles/common.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <header class="bg-primary text-primary-foreground sticky top-0 z-50">
        <div class="container">
            <nav>
                <a href="/" class="logo">
                    <i data-lucide="leaf"></i>
                    GreenGURU
                </a>
                <div class="nav-links">
                    <a href="/index.php">Home</a>
                    <a href="/Product Page/product-interface.php">Products</a>
                    <a href="/About page/about.php">About</a>
                    <?php if ($user_id): ?>
                        <div class="user-circle" id="userCircle">
                            <i data-lucide="user"></i>
                        </div>
                    <?php else: ?>
                        <a href="/Login page/login.php" class="btn btn-secondary">Login</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <div id="userInfo" class="user-info-popup">
        <h3>User Information</h3>
        <p><strong>Username:</strong> <span id="userInfoUsername"></span></p>
        <p><strong>Email:</strong> <span id="userInfoEmail"></span></p>
        <a href="/user-profile.php" class="btn btn-primary">View Profile</a>
        <a href="/logout.php" class="btn btn-secondary">Logout</a>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();

        const userCircle = document.getElementById('userCircle');
        const userInfo = document.getElementById('userInfo');
        const userInfoUsername = document.getElementById('userInfoUsername');
        const userInfoEmail = document.getElementById('userInfoEmail');

        if (userCircle) {
            userCircle.addEventListener('click', () => {
                userInfo.style.display = userInfo.style.display === 'none' ? 'block' : 'none';
                userInfoUsername.textContent = '<?php echo $username; ?>';
                userInfoEmail.textContent = '<?php echo $email; ?>';
            });
        }

        document.addEventListener('click', (event) => {
            if (userCircle && !userCircle.contains(event.target) && !userInfo.contains(event.target)) {
                userInfo.style.display = 'none';
            }
        });
    });
    </script>
