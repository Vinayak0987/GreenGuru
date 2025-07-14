# GreenGuru E-Commerce Platform Documentation

## Table of Contents
1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Database Schema](#database-schema)
4. [Project Structure](#project-structure)
5. [Features](#features)
6. [Installation & Setup](#installation--setup)
7. [API Endpoints](#api-endpoints)
8. [User Roles & Permissions](#user-roles--permissions)
9. [Security Features](#security-features)
10. [Troubleshooting](#troubleshooting)
11. [Future Enhancements](#future-enhancements)

---

## Project Overview

**GreenGuru** is a sustainable e-commerce platform focused on eco-friendly products. The platform promotes environmental consciousness by featuring products with sustainability scores and eco-friendly alternatives to everyday items.

### Mission
To provide consumers with sustainable shopping options while promoting environmental awareness through a user-friendly e-commerce experience.

### Key Features
- Sustainable product catalog with eco-ratings
- User authentication and profile management
- Shopping cart and checkout system
- Order management and tracking
- Admin dashboard for product and user management
- Responsive design for mobile and desktop

---

## Technology Stack

### Frontend
- **HTML5** - Semantic markup and structure
- **CSS3** - Styling and responsive design
- **JavaScript (ES6+)** - Client-side interactivity
- **Responsive Design** - Mobile-first approach

### Backend
- **PHP 7.4+** - Server-side scripting
- **MySQL 8.0+** - Relational database management
- **Apache/Nginx** - Web server

### Development Tools
- **phpMyAdmin** - Database administration
- **Git** - Version control
- **XAMPP/WAMP** - Local development environment

### Additional Libraries
- **Font Awesome** - Icons
- **Custom CSS Framework** - Styling system

---

## Database Schema

The application uses a MySQL database named `project` with the following tables:

### 1. Users Table
\`\`\`sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
\`\`\`

**Purpose**: Stores user account information with encrypted passwords.

### 2. Products Table
\`\`\`sql
CREATE TABLE products (
    product_index_no INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    rating DECIMAL(2,1) DEFAULT 0,
    sustainability_score INT DEFAULT 0,
    image VARCHAR(255),
    DESCRIPTION TEXT
);
\`\`\`

**Purpose**: Contains product catalog with sustainability metrics.

### 3. Cart Table
\`\`\`sql
CREATE TABLE cart (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_index_no INT NOT NULL,
    quantity INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_index_no) REFERENCES products(product_index_no)
);
\`\`\`

**Purpose**: Manages user shopping cart items.

### 4. Orders Table
\`\`\`sql
CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    postal_code VARCHAR(20) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    tax DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    payment_id VARCHAR(100),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
\`\`\`

**Purpose**: Stores completed order information and billing details.

### 5. Order Items Table
\`\`\`sql
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_index_no INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_index_no) REFERENCES products(product_index_no)
);
\`\`\`

**Purpose**: Links products to orders with quantities (many-to-many relationship).

---

## Project Structure

\`\`\`
project/
├── About page/
│   ├── about.html          # About us page
│   ├── about.css           # About page styles
│   └── photos/             # About page images
├── Home page/
│   ├── index.html          # Homepage
│   ├── index.php           # Homepage with PHP
│   ├── styles.css          # Homepage styles
│   ├── index.js            # Homepage JavaScript
│   └── scroll-img/         # Homepage carousel images
│   └── trusted/            # Partner brand logos
├── Login page/
│   ├── login.html          # Login form
│   ├── login.php           # Login processing
│   ├── login.css           # Login styles
│   ├── register.html       # Registration form
│   ├── register.php        # Registration processing
│   └── products/           # Product images
├── Product Page/
│   ├── product-interface.html  # Product listing page
│   ├── product-interface.php   # Product data processing
│   ├── getProducts.php         # Product API endpoint
│   └── products/               # Product images
├── Cart Page/
│   ├── cart.html           # Shopping cart interface
│   ├── cart.php            # Cart processing
│   ├── save_cart.php       # Add to cart functionality
│   ├── get_cart.php        # Retrieve cart items
│   ├── update_cart_quantity.php # Update item quantities
│   └── remove_cart_item.php     # Remove cart items
├── Billing page/
│   ├── billing-page.html   # Checkout form
│   └── store_order.php     # Order processing
├── dashboard/
│   ├── index.php           # Admin dashboard home
│   ├── includes/           # Common PHP includes
│   │   ├── db.php          # Database connection
│   │   ├── header.php      # Admin header
│   │   ├── sidebar.php     # Admin navigation
│   │   └── footer.php      # Admin footer
│   ├── products/           # Product management
│   │   ├── index.php       # Product listing
│   │   ├── add.php         # Add new product
│   │   ├── edit.php        # Edit product
│   │   └── delete.php      # Delete product
│   ├── users/              # User management
│   │   ├── index.php       # User listing
│   │   ├── add.php         # Add new user
│   │   ├── edit.php        # Edit user
│   │   └── delete.php      # Delete user
│   ├── orders/             # Order management
│   │   └── index.php       # Order listing
│   └── settings/           # System settings
│       └── index.php       # Settings page
├── common/
│   └── header.php          # Common header component
└── user-profile.php        # User profile management
\`\`\`

---

## Features

### Customer Features
1. **User Registration & Authentication**
   - Secure account creation
   - Login/logout functionality
   - Password encryption
   - Session management

2. **Product Browsing**
   - Product catalog with images
   - Sustainability scoring system
   - Product ratings and reviews
   - Search and filter capabilities

3. **Shopping Cart**
   - Add/remove products
   - Update quantities
   - Persistent cart across sessions
   - Cart total calculations

4. **Checkout Process**
   - Billing information collection
   - Order summary
   - Payment processing integration
   - Order confirmation

5. **Order Management**
   - Order history
   - Order tracking
   - Order details view

### Admin Features
1. **Dashboard Overview**
   - Sales analytics
   - User statistics
   - Product performance metrics

2. **Product Management**
   - Add new products
   - Edit product details
   - Update sustainability scores
   - Manage product images
   - Delete products

3. **User Management**
   - View user accounts
   - Edit user information
   - User activity monitoring
   - Account management

4. **Order Management**
   - View all orders
   - Order status updates
   - Order fulfillment tracking
   - Customer communication

---

## Installation & Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 8.0 or higher
- Apache/Nginx web server
- phpMyAdmin (recommended)

### Step 1: Environment Setup
1. Install XAMPP/WAMP/MAMP for local development
2. Start Apache and MySQL services
3. Access phpMyAdmin at `http://localhost/phpmyadmin`

### Step 2: Database Setup
1. Create a new database named `project`
2. Import the database schema:
\`\`\`sql
-- Run the SQL commands from the Database Schema section
-- Or import from provided SQL dump file
\`\`\`

### Step 3: Project Installation
1. Clone/download the project files
2. Place files in your web server directory (htdocs for XAMPP)
3. Configure database connection in `dashboard/includes/db.php`:
\`\`\`php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
\`\`\`

### Step 4: File Permissions
Ensure proper file permissions for image uploads and session management:
\`\`\`bash
chmod 755 /path/to/project
chmod 644 /path/to/project/images/*
\`\`\`

### Step 5: Testing
1. Access the homepage: `http://localhost/project/Home%20page/index.html`
2. Test user registration and login
3. Verify admin dashboard access
4. Test product browsing and cart functionality

---

## API Endpoints

### Authentication
- `POST /Login page/login.php` - User login
- `POST /Login page/register.php` - User registration

### Products
- `GET /Product Page/getProducts.php` - Retrieve product list
- `POST /dashboard/products/add.php` - Add new product (Admin)
- `PUT /dashboard/products/edit.php` - Update product (Admin)
- `DELETE /dashboard/products/delete.php` - Delete product (Admin)

### Cart Management
- `POST /Cart Page/save_cart.php` - Add item to cart
- `GET /Cart Page/get_cart.php` - Retrieve cart items
- `PUT /Cart Page/update_cart_quantity.php` - Update item quantity
- `DELETE /Cart Page/remove_cart_item.php` - Remove cart item

### Orders
- `POST /Billing page/store_order.php` - Create new order
- `GET /get_order_items.php` - Retrieve order details

### User Management
- `GET /dashboard/users/index.php` - List users (Admin)
- `POST /dashboard/users/add.php` - Add user (Admin)
- `PUT /dashboard/users/edit.php` - Update user (Admin)
- `DELETE /dashboard/users/delete.php` - Delete user (Admin)

---

## User Roles & Permissions

### Customer Role
- Browse products
- Manage personal cart
- Place orders
- View order history
- Update profile information

### Admin Role
- All customer permissions
- Access admin dashboard
- Manage products (CRUD operations)
- Manage users
- View all orders
- System configuration

### Security Levels
1. **Public Access**: Homepage, product browsing, registration
2. **Authenticated Users**: Cart, checkout, profile, order history
3. **Admin Only**: Dashboard, user management, product management

---

## Security Features

### Authentication Security
- Password hashing using PHP's `password_hash()`
- Session-based authentication
- CSRF protection on forms
- Input validation and sanitization

### Database Security
- Prepared statements to prevent SQL injection
- Input validation on all user inputs
- Secure database connection handling

### File Security
- Restricted file upload types
- File size limitations
- Secure file naming conventions

### Session Security
- Secure session configuration
- Session timeout handling
- Session regeneration on login

---

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check MySQL service is running
   - Verify database credentials in `db.php`
   - Ensure database `project` exists

2. **Login Issues**
   - Clear browser cookies and sessions
   - Check user exists in database
   - Verify password hashing implementation

3. **Image Upload Problems**
   - Check file permissions on upload directories
   - Verify file size limits in PHP configuration
   - Ensure supported file types

4. **Cart Not Persisting**
   - Check session configuration
   - Verify database cart table structure
   - Clear browser cache

### Debug Mode
Enable PHP error reporting for development:
\`\`\`php
error_reporting(E_ALL);
ini_set('display_errors', 1);
\`\`\`

---

## Future Enhancements

### Planned Features
1. **Payment Integration**
   - PayPal integration
   - Stripe payment processing
   - Multiple payment methods

2. **Enhanced Sustainability**
   - Carbon footprint calculator
   - Eco-impact tracking
   - Sustainability badges

3. **User Experience**
   - Wishlist functionality
   - Product recommendations
   - Advanced search filters
   - Mobile app development

4. **Analytics & Reporting**
   - Sales analytics dashboard
   - User behavior tracking
   - Inventory management
   - Automated reporting

5. **Marketing Features**
   - Discount codes and coupons
   - Email marketing integration
   - Social media sharing
   - Loyalty program

### Technical Improvements
1. **Performance Optimization**
   - Database query optimization
   - Image compression and CDN
   - Caching implementation
   - Code minification

2. **Security Enhancements**
   - Two-factor authentication
   - Advanced fraud detection
   - Regular security audits
   - HTTPS enforcement

3. **Scalability**
   - Microservices architecture
   - Load balancing
   - Database sharding
   - Cloud deployment

---

## Support & Maintenance

### Regular Maintenance Tasks
- Database backup and optimization
- Security updates and patches
- Performance monitoring
- Log file management

### Support Contacts
- Technical Support: [technical@greenguru.com]
- Admin Support: [admin@greenguru.com]
- General Inquiries: [info@greenguru.com]

---

## Version History

- **v1.0.0** - Initial release with core e-commerce functionality
- **v1.1.0** - Added sustainability scoring system
- **v1.2.0** - Enhanced admin dashboard
- **v1.3.0** - Improved user experience and mobile responsiveness

---

*Last Updated: January 2025*
*Documentation Version: 1.0*
