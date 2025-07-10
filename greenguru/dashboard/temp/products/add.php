<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<div class="d-flex">
    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content flex-grow-1 p-4">
        <div class="container">
            <h2 class="text-center">Add New Product</h2>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $rating = $_POST['rating'];
                $score = $_POST['score'];
                $image = $_POST['image'];

                $stmt = $conn->prepare("INSERT INTO products (name, price, rating, sustainability_score, image) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sdiis", $name, $price, $rating, $score, $image);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Product added successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error adding product.</div>";
                }
            }
            ?>

            <form method="post" class="card p-4 shadow">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" required>

                <label>Price:</label>
                <input type="number" step="0.01" name="price" class="form-control" required>

                <label>Rating:</label>
                <input type="number" step="0.1" name="rating" class="form-control" required>

                <label>Sustainability Score:</label>
                <input type="number" name="score" class="form-control" required>

                <label>Image URL:</label>
                <input type="text" name="image" class="form-control" required>

                <button type="submit" class="btn btn-primary mt-3">Add Product</button>
            </form>
        </div>
    </main>
</div>

<?php include '../includes/footer.php'; ?>
