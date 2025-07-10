<?php
include '../includes/db.php';
include '../includes/header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE product_index_no = $id");
$product = $result->fetch_assoc();
?>

<div class="d-flex">
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content flex-grow-1 p-4">
        <div class="container">
            <h2 class="text-center">Edit Product</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $rating = $_POST['rating'];
                $score = $_POST['score'];
                $image = $_POST['image'];

                $stmt = $conn->prepare("UPDATE products SET name=?, price=?, rating=?, sustainability_score=?, image=? WHERE product_index_no=?");
                $stmt->bind_param("sdiisi", $name, $price, $rating, $score, $image, $id);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Product updated successfully!</div>";
                    
                } else {
                    echo "<div class='alert alert-danger'>Error updating product.</div>";
                }
                
            }
            ?>

            <form method="post" class="card p-4 shadow">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $product['name']; ?>" class="form-control" required>

                <label>Price:</label>
                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" class="form-control" required>

                <label>Rating:</label>
                <input type="number" step="0.1" name="rating" value="<?php echo $product['rating']; ?>" class="form-control" required>

                <label>Sustainability Score:</label>
                <input type="number" name="score" value="<?php echo $product['sustainability_score']; ?>" class="form-control" required>

                <label>Image URL:</label>
                <input type="text" name="image" value="<?php echo $product['image']; ?>" class="form-control" required>

                <button type="submit" class="btn btn-primary mt-3">Update Product</button>
            </form>
        </div>
    </main>
</div>

<?php include '../includes/footer.php'; ?>
