<div class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu" style="background: linear-gradient(180deg, #2c3e50 0%, #1a2533 100%);">
    <div class="position-sticky pt-3 vh-100">
        <!-- Brand Logo/Header -->
        <div class="text-center mb-4 px-3">
            <a href="/admin-dashboard" class="d-flex align-items-center justify-content-center text-decoration-none">
                <div class="sidebar-logo bg-primary rounded-circle p-2 me-2">
                    <i class="bi bi-shop text-white fs-4"></i>
                </div>
                <span class="fs-5 fw-bold text-white">GreenGuru</span>
            </a>
        </div>

        <!-- Navigation Menu -->
<ul class="nav flex-column px-2">
    <li class="nav-item mb-1">
        <a class="nav-link text-white <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' && strpos($_SERVER['PHP_SELF'], 'admin_dashboard_cleaned') !== false) ? 'active' : ''; ?>" href="index.php">
            <div class="d-flex align-items-center">
                <div class="sidebar-icon">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <span class="ms-2">Dashboard</span>
            </div>
        </a>
    </li>
    
    <li class="nav-item mb-1">
        <a class="nav-link text-white <?php echo (strpos($_SERVER['PHP_SELF'], 'users/index.php') !== false) ? 'active' : ''; ?>" href="users/index.php">
            <div class="d-flex align-items-center">
                <div class="sidebar-icon">
                    <i class="bi bi-people"></i>
                </div>
                <span class="ms-2">Users</span>
            </div>
        </a>
    </li>
    
    <li class="nav-item mb-1">
        <a class="nav-link text-white <?php echo (strpos($_SERVER['PHP_SELF'], 'products/index.php') !== false) ? 'active' : ''; ?>" href="products/index.php">
            <div class="d-flex align-items-center">
                <div class="sidebar-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <span class="ms-2">Products</span>
            </div>
        </a>
    </li>
    
    <li class="nav-item mb-1">
        <a class="nav-link text-white <?php echo (strpos($_SERVER['PHP_SELF'], 'orders/index.php') !== false) ? 'active' : ''; ?>" href="orders/index.php">
            <div class="d-flex align-items-center">
                <div class="sidebar-icon">
                    <i class="bi bi-cart"></i>
                </div>
                <span class="ms-2">Orders</span>
                <span class="badge bg-danger ms-auto">5</span>
            </div>
        </a>
    </li>
    
    <?php
$current_page = basename($_SERVER['SCRIPT_NAME']);
$active_class = ($current_page == 'index.php') ? 'active' : '';
?>

<li class="nav-item mb-1">
    <a class="nav-link text-white <?php echo ($current_page == 'index.php' ? 'active' : ''); ?>" href="settings/index.php">
        <div class="d-flex align-items-center">
            <div class="sidebar-icon">
                <i class="bi bi-gear"></i>
            </div>
            <span class="ms-2">Settings</span>
        </div>
    </a>
</li>

        <!-- Bottom Section -->
        <div class="position-absolute bottom-0 start-0 end-0 p-3">
            <div class="border-top border-secondary pt-3">
                <div class="d-flex align-items-center text-white mb-3 px-2">
                    <div class="position-relative me-2">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" 
                             class="rounded-circle" width="40" height="40" alt="Admin">
                        <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width: 10px; height: 10px;"></span>
                    </div>
                    <div>
                        <div class="fw-bold">Admin User</div>
                        <small class="text-white-50">Administrator</small>
                    </div>
                </div>
                <a href="../../../draft/Login page/login.html" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Sidebar Styles */
.sidebar {
    transition: all 0.3s ease;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
}

.sidebar-logo {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-link {
    border-radius: 6px;
    padding: 0.6rem 1rem;
    margin-bottom: 0.25rem;
    transition: all 0.2s ease;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.nav-link.active {
    background-color: #4e73df;
    font-weight: 500;
}

.nav-link.active:hover {
    background-color: #3b5bbd;
}

.sidebar-icon {
    width: 24px;
    text-align: center;
}

/* Badge notification */
.badge {
    font-size: 0.65rem;
    padding: 0.25rem 0.4rem;
}

/* User profile */
.user-avatar {
    width: 40px;
    height: 40px;
}

/* Responsive adjustments */
@media (max-width: 767.98px) {
    .sidebar {
        position: fixed;
        top: 56px;
        bottom: 0;
        left: 0;
        z-index: 1000;
    }
}
</style>