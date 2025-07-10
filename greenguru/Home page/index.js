document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    lucide.createIcons();

    // Hero image rotation
    const heroImage = document.getElementById('hero-image');
    const heroImages = [
        "/placeholder.svg?height=300&width=600&text=Eco-Friendly+Product+1",
        "/placeholder.svg?height=300&width=600&text=Eco-Friendly+Product+2",
        "/placeholder.svg?height=300&width=600&text=Eco-Friendly+Product+3",
    ];
    let currentImageIndex = 0;

    setInterval(() => {
        currentImageIndex = (currentImageIndex + 1) % heroImages.length;
        heroImage.src = heroImages[currentImageIndex];
    }, 5000);

    // Featured products data
    const featuredProducts = [
        { id: 1, name: "Bamboo Toothbrush", price: 5.99, image: "../Product Page/products/product1.jpg", description: "Made of Neem Tree" },
        { id: 2, name: "Family Toothbrush Set", price: 15.99, image: "../Product Page/products/product2.jpg", description: "Made of three different materials" },
        { id: 3, name: "Eco bag", price: 9.99, image: "../Product Page/products/product4.jpg", description: "Eco-friendly cover for bottles" },
    ];

    // Render featured products
    const productGrid = document.getElementById('featured-products');
    featuredProducts.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'product-card';
        productCard.innerHTML = `
            <img src="${product.image}" alt="${product.name}" class="product-image">
            <div class="product-content">
                <h3 class="product-title">${product.name}</h3>
                <p class="product-description">${product.description}</p>
            </div>
            <div class="product-footer">
                <span class="product-price">₹${product.price.toFixed(2)}</span>
                <button class="btn btn-outline">View Details</button>
            </div>
        `;
        productGrid.appendChild(productCard);
    });

    // Business listings data
    const businessListings = [
        { name: "EcoHome Solutions", description: "Sustainable home improvement productst focuses on solutions that reduce energy consumption, minimize waste, and encourage eco-friendly living. This can include using renewable energy sources like solar panels, improving insulation to reduce heating and cooling costs, adopting water-saving technologies, and incorporating sustainable materials in home construction and decor.", rating: 4.5 },
        { name: "GreenBeauty Co.", description: "Organic and cruelty-free it is a brand or concept focused on sustainable and eco-friendly beauty products. It emphasizes the use of natural, organic, and cruelty-free ingredients while minimizing environmental impact. The brand promotes skincare, haircare, and cosmetic products that are free from harmful chemicals, ensuring they are safe for both users and the planet.", rating: 4.8 },
        { name: "EarthWear Apparel", description: "Eco-friendly fashion for all it is a sustainable fashion brand dedicated to creating eco-friendly clothing with minimal environmental impact. It focuses on using organic, recycled, and ethically sourced materials, such as organic cotton, bamboo fabric, and hemp, to promote sustainable fashion practices. The brand prioritizes ethical manufacturing, ensuring fair wages and safe working conditions for its workers.", rating: 4.2 },
    ];

    // Render business listings
    const businessGrid = document.getElementById('eco-businesses');
    businessListings.forEach(business => {
        const businessCard = document.createElement('div');
        businessCard.className = 'business-card';
        businessCard.innerHTML = `
            <h3 class="business-name">${business.name}</h3>
            <p class="business-description">${business.description}</p>

            <div class="business-rating">
                <span class="star-icon">★</span>
                <span>${business.rating.toFixed(1)}</span>
            </div>
        `;
        businessGrid.appendChild(businessCard);
    });

  // Blog articles data
const blogArticles = [
    { title: "10 Easy Ways to Reduce Your Carbon Footprint", image: "./scroll-img.jpg", category: "Lifestyle" },
    { title: "The Rise of Sustainable Fashion: Trends to Watch", image: "../Product Page/products/product16.jpg", category: "Fashion" },
    { title: "How to Create an Eco-Friendly Home Office", image: "../Product Page/products/product19.jpg", category: "Home" },
];

// Render blog articles
document.addEventListener("DOMContentLoaded", () => {
    const articleGrid = document.getElementById("blog-articles");

    blogArticles.forEach(article => {
        const articleCard = document.createElement("div");
        articleCard.classList.add("article-card");

        // Ensure images load properly
        const image = document.createElement("img");
        image.src = article.image;
        image.alt = article.title;
        image.classList.add("article-image");

        // Article content
        const articleContent = document.createElement("div");
        articleContent.classList.add("article-content");

        const category = document.createElement("span");
        category.classList.add("article-category");
        category.textContent = article.category;

        const title = document.createElement("h3");
        title.classList.add("article-title");
        title.textContent = article.title;

        const readMore = document.createElement("a");
        readMore.href = "#";
        readMore.classList.add("btn", "btn-outline");
        readMore.textContent = "Read More";

        // Append elements
        articleContent.appendChild(category);
        articleContent.appendChild(title);
        articleContent.appendChild(readMore);
        articleCard.appendChild(image);
        articleCard.appendChild(articleContent);
        articleGrid.appendChild(articleCard);
    });
});


    // Handle newsletter form submission
    const newsletterForm = document.getElementById('newsletter-form');
    newsletterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = e.target.querySelector('input[type="email"]').value;
        alert(`Thank you for subscribing with email: ${email}`);
        e.target.reset();
    });
    // script.js
document.addEventListener("DOMContentLoaded", function() {
    const images = document.querySelectorAll('.carousel-image');
    let currentImageIndex = 0;
    const totalImages = images.length;

    function showNextImage() {
        images[currentImageIndex].classList.remove('active');
        currentImageIndex = (currentImageIndex + 1) % totalImages;
        images[currentImageIndex].classList.add('active');
    }

    // Change image every 3 seconds
    setInterval(showNextImage, 3000);
});

});