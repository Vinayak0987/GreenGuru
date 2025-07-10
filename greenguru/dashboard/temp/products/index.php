<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<div class="d-flex">
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content flex-grow-1 p-4">
        <div class="container">
            <h2 class="text-center">All Products</h2>
            <a href="add.php" class="btn btn-success mb-3">➕ Add Product</a>

            <div class="card shadow p-3">
                <?php
                $result = $conn->query("SELECT * FROM products");
                ?>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th><th>Name</th><th>Price</th><th>Rating</th><th>Score</th><th>Image</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['product_index_no']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>₹<?php echo number_format($row['price'], 2); ?></td>
                            <td><?php echo $row['rating']; ?> ⭐</td>
                            <td><?php echo $row['sustainability_score']; ?></td>
                            <td><img src="<?php echo $row['image']; ?>" width="50"></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['product_index_no']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <a href="delete.php?id=<?php echo $row['product_index_no']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑 Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<?php include '../includes/footer.php'; ?>
