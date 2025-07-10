<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<div class="d-flex">
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content flex-grow-1 p-4">
        <div class="container">
            <h2 class="text-center">All Orders</h2>

            <div class="card shadow p-3">
                <?php
                $orders = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
                ?>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>User Info</th>
                            <th>Shipping Info</th>
                            <th>Total</th>
                            <th>Products</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($order = $orders->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $order['order_id']; ?></td>
                            <td>
                                <strong><?php echo $order['full_name']; ?></strong><br>
                                <?php echo $order['email']; ?>
                            </td>
                            <td>
                                <?php echo $order['address']; ?><br>
                                <?php echo $order['city'] . ', ' . $order['country'] . ' - ' . $order['postal_code']; ?>
                            </td>
                            <td>₹<?php echo number_format($order['total'], 2); ?></td>
                            <td>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $order_id = $order['order_id'];
                                        $products = $conn->query("
                                            SELECT p.name, p.image, oi.quantity
                                            FROM order_items oi
                                            JOIN products p ON p.product_index_no = oi.product_index_no
                                            WHERE oi.order_id = $order_id
                                        ");
                                        while ($item = $products->fetch_assoc()):
                                        ?>
                                            <tr>
                                                <td><img src="../Product Page/<?php echo $item['image']; ?>" width="60" height="60" style="object-fit:cover;"></td>
                                                <td><?php echo $item['name']; ?></td>
                                                <td><?php echo $item['quantity']; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </td>
                            <td><?php echo $order['order_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<?php include '../includes/footer.php'; ?>
