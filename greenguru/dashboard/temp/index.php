<?php
require_once 'includes/db.php';


// Get counts from database
$userCount = getUserCount();
$productCount = getProductCount();
$orderCount = getOrderCount();
$recentProducts = getRecentProducts(5);

// Get sales data (only amounts)
$salesData = [];
$result = $conn->query("SELECT total FROM orders ORDER BY order_id DESC LIMIT 15");
while ($row = $result->fetch_assoc()) {
    $salesData[] = $row['total'];
}
$salesData = array_reverse($salesData); // For proper chronological order

// Calculate total sales
$totalSales = array_sum($salesData);

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <!-- Dashboard Header -->
    <div class="dashboard-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4">
        <h1 class="h2 mb-0">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button id="exportBtn" class="btn btn-primary">
                <i class="bi bi-download me-1"></i> Export Data
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row stats-row">
        <!-- Users Card -->
        <div class="col-md-4 mb-4">
            <div class="card stat-card users-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-subtitle">Total Users</h6>
                            <h2 class="card-title"><?php echo number_format($userCount); ?></h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <a href="users/index.php" class="btn btn-stat">
                        View Users <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Products Card -->
        <div class="col-md-4 mb-4">
            <div class="card stat-card products-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-subtitle">Total Products</h6>
                            <h2 class="card-title"><?php echo number_format($productCount); ?></h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                    </div>
                    <a href="products/index.php" class="btn btn-stat">
                        View Products <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sales Card -->
        <div class="col-md-4 mb-4">
            <div class="card stat-card sales-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-subtitle">Total Sales</h6>
                            <h2 class="card-title">₹<?php echo number_format($totalSales, 2); ?></h2>
                        </div>
                        <div class="stat-icon">
                            <i class="bi bi-currency-rupee"></i>
                        </div>
                    </div>
                    <a href="orders/index.php" class="btn btn-stat">
                        View Orders <i class="bi bi-chevron-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card chart-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-bar-chart-line me-2"></i>Recent Sales
                    </h5>
                    <div class="chart-actions">
                        <button class="btn btn-chart-type active" data-type="bar">
                            <i class="bi bi-bar-chart"></i> Bars
                        </button>
                        <button class="btn btn-chart-type" data-type="line">
                            <i class="bi bi-graph-up"></i> Line
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="salesChart" height="300"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Recent Products -->
        <div class="col-lg-4 mb-4">
            <div class="card recent-products-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-box-seam me-2"></i>Recent Products
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (count($recentProducts) > 0): ?>
                        <div class="product-list">
                            <?php foreach ($recentProducts as $product): ?>
                                <div class="product-item">
                                    <img src="<?php echo htmlspecialchars($product['image'] ?? 'assets/default-product.png'); ?>" 
                                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                                         class="product-image">
                                    <div class="product-details">
                                        <h6><?php echo htmlspecialchars($product['name']); ?></h6>
                                        <div class="product-meta">
                                            <span class="price">₹<?php echo number_format($product['price'], 2); ?></span>
                                            <span class="badge stock-badge <?php echo $product['stock'] > 0 ? 'in-stock' : 'out-of-stock'; ?>">
                                                <?php echo $product['stock']; ?> in stock
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="products/index.php" class="btn btn-view-all">
                            View All Products <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    <?php else: ?>
                        <div class="no-products">
                            <i class="bi bi-box"></i>
                            <p>No products found</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<style>
/* Main Layout */
.main-content {
    padding-top: 1.5rem;
    padding-bottom: 2rem;
}

.dashboard-header {
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
}

/* Stats Cards */
.stat-card {
    border: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.users-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.products-card {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
}

.sales-card {
    background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
    color: white;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    background-color: rgba(255,255,255,0.15);
}

.card-subtitle {
    font-size: 0.875rem;
    opacity: 0.8;
    margin-bottom: 0.5rem;
}

.card-title {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0;
}

.btn-stat {
    background-color: rgba(255,255,255,0.15);
    border: none;
    color: white;
    margin-top: 1rem;
    width: 100%;
    transition: all 0.2s;
}

.btn-stat:hover {
    background-color: rgba(255,255,255,0.25);
}

/* Chart Card */
.chart-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.chart-card .card-header {
    background: white;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chart-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-chart-type {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
}

.btn-chart-type.active {
    background: #e9ecef;
    border-color: #adb5bd;
}

/* Recent Products */
.recent-products-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.product-list {
    margin-bottom: 1.5rem;
}

.product-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f1f1f1;
}

.product-item:last-child {
    border-bottom: none;
}

.product-image {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 1rem;
}

.product-details {
    flex: 1;
}

.product-details h6 {
    margin-bottom: 0.25rem;
    font-size: 0.95rem;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.price {
    font-weight: 600;
    color: #2b2b2b;
}

.stock-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
}

.in-stock {
    background-color: #d1fae5;
    color: #065f46;
}

.out-of-stock {
    background-color: #fee2e2;
    color: #b91c1c;
}

.btn-view-all {
    width: 100%;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
}

.no-products {
    text-align: center;
    padding: 2rem 0;
    color: #6c757d;
}

.no-products i {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    display: block;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .stats-row {
        flex-direction: column;
    }
    
    .stat-card {
        margin-bottom: 1rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Chart
    const ctx = document.getElementById('salesChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode(array_map(function($i) { return 'Sale ' . ($i + 1); }, range(0, count($salesData) - 1))); ?>,
            datasets: [{
                label: 'Order Amount (₹)',
                data: <?php echo json_encode($salesData); ?>,
                backgroundColor: '#4e73df',
                borderColor: '#2e59d9',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return '₹' + context.raw.toLocaleString('en-IN');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₹' + value.toLocaleString('en-IN');
                        }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Chart Type Toggle
    document.querySelectorAll('.btn-chart-type').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.btn-chart-type').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            chart.config.type = this.dataset.type;
            chart.update();
        });
    });

    // Export Data Functionality
    document.getElementById('exportBtn').addEventListener('click', function() {
        // Create CSV content
        let csv = 'Order Number,Amount (₹)\n';
        <?php echo json_encode($salesData); ?>.forEach((amount, index) => {
            csv += Sale ${index+1},${amount}\n;
        });
        
        // Create download link
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'sales_data_<?php echo date('Y-m-d'); ?>.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    });
});
</script>