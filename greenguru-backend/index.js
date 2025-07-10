const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
const PORT = process.env.PORT || 3000;

app.use(cors());
app.use(bodyParser.json());

// Sample product data
const products = [
    {
        id: 1,
        name: "Eco-Friendly Bamboo Toothbrush",
        price: 5.99,
        description: "Our bamboo toothbrush is the perfect eco-friendly alternative to plastic toothbrushes. Made from sustainably sourced bamboo, this toothbrush is biodegradable and comes with soft bristles for gentle yet effective cleaning.",
        images: ["/placeholder.svg", "/placeholder.svg", "/placeholder.svg"],
        sustainabilityScore: 9
    },
    // Add more products if needed
];

// Define a root route
app.get('/', (req, res) => {
    res.send('Welcome to the GreenGuru API!');
});

// Endpoint to get product details
app.get('/api/products/:id', (req, res) => {
    const productId = parseInt(req.params.id);
    const product = products.find(p => p.id === productId);
    if (product) {
        res.json(product);
    } else {
        res.status(404).json({ message: 'Product not found' });
    }
});

// Endpoint to add to cart
app.post('/api/cart', (req, res) => {
    const { productId, quantity } = req.body;
    // Logic to add product to cart (e.g., store in a database)
    res.json({ message: `Added ${quantity} of product ID ${productId} to cart` });
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});

