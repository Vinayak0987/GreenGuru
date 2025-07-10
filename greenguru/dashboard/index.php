<?php
require_once 'includes/db.php';

// Get counts
$userCount = getUserCount();
$productCount = getProductCount();
$cartItemCount = getCartItemCount();
$recentProducts = getRecentProducts();

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-download"></i> Download
            </button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle text-muted">Total Users</h6>
                            <h2 class="mt-2 mb-0"><?php echo $userCount; ?></h2>
                            <p class="text-muted small">Registered accounts</p>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                    <a href="/admin-dashboard/users" class="btn btn-outline-secondary btn-sm w-100 mt-3">View All Users</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle text-muted">Total Products</h6>
                            <h2 class="mt-2 mb-0"><?php echo $productCount; ?></h2>
                            <p class="text-muted small">Products in database</p>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                    <a href="/admin-dashboard/products" class="btn btn-outline-secondary btn-sm w-100 mt-3">View All Products</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle text-muted">Cart Items</h6>
                            <h2 class="mt-2 mb-0"><?php echo $cartItemCount; ?></h2>
                            <p class="text-muted small">Items in user carts</p>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-cart"></i>
                        </div>
                    </div>
                    <a href="/admin-dashboard/cart" class="btn btn-outline-secondary btn-sm w-100 mt-3">View All Cart Items</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Overview</h5>
                </div>
                <div class="card-body">
                    <canvas id="overviewChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Products</h5>
                </div>
                <div class="card-body">
                    <?php if (count($recentProducts) > 0): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($recentProducts as $product): ?>
                                <li class="list-group-item px-0">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="me-3">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0"><?php echo htmlspecialchars($product['name']); ?></h6>
                                            <small class="text-muted">
                                                Rating: <?php echo $product['rating']; ?> | 
                                                Sustainability: <?php echo $product['sustainability_score']; ?>
                                            </small>
                                        </div>
                                        <div class="fw-bold">$<?php echo number_format($product['price'], 2); ?></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-center text-muted">No products found</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

