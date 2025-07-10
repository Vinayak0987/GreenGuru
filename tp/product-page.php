<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - GreenGuru Store</title>
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #45a049;
            --text-color: #333;
            --background-color: #f4f4f4;
            --white: #ffffff;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .product-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .main-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-info h1 {
            margin-top: 0;
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }

        .description {
            margin-top: 20px;
            line-height: 1.6;
        }

        .add-to-cart-btn {
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .add-to-cart-btn:hover {
            background-color: var(--secondary-color);
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Database connection
        $host = 'localhost'; // Replace with your database host
        $username = 'root'; // Replace with your database username
        $password = ''; // Replace with your database password
        $dbname = 'project'; // Replace with your database name
        $port='3307'

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname,$port);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch product ID from URL
        $productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Fetch product data
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            echo "<div class='product-details'>";
            echo "    <div class='product-images'>";
            echo "        <img src='" . htmlspecialchars($product['image']) . "' alt='" . htmlspecialchars($product['name']) . "' class='main-image'>";
            echo "    </div>";
            echo "    <div class='product-info'>";
            echo "        <h1>" . htmlspecialchars($product['name']) . "</h1>";
            echo "        <p class='price'>$" . number_format($product['price'], 2) . "</p>";
            echo "        <p class='description'>" . htmlspecialchars($product['description']) . "</p>";
            echo "        <button class='add-to-cart-btn' onclick='addToCart(" . $product['id'] . ")'>Add to Cart</button>";
            echo "    </div>";
            echo "</div>";
        } else {
            echo "<p>Product not found.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>

    <script>
        function addToCart(productId) {
            // Example: Save to localStorage or make an API call to handle cart functionality
            alert('Product ' + productId + ' added to cart!');
        }
    </script>
</body>

</html>
