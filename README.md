# Nova Eco-Packaging Website

A modern, professional website for a sustainable packaging business. This project showcases eco-friendly packaging products with features for browsing, shopping cart functionality, and customer contact/order management.

## Overview

Nova Eco-Packaging is a complete e-commerce website designed to help a packaging business:
- **Showcase Products** - Display eco-friendly packaging solutions with detailed specifications
- **Accept Orders** - Integrated shopping cart system with order summary
- **Handle Customer Inquiries** - Contact form with email notifications
- **Build Trust** - Client logos and professional branding

## Features

### 🛍️ Product Catalog
- 6+ product categories (boxes, mailers, containers, materials, labels, bags)
- Product images, descriptions, and specifications
- Pricing with discount display
- Quick "Add to Cart" functionality

### 🛒 Shopping Cart
- Persistent cart storage using localStorage
- Update quantities with +/- buttons
- Remove items from cart
- Automatic price calculations with:
  - Subtotal
  - Tax calculation (8%)
  - Shipping estimation (free over $100)
  - Grand total

### 📧 Contact & Order System
- Contact form with validation
- Email notifications to business and customer
- Order submission through contact form
- Professional email templates

### 🎨 Design Features
- Responsive design (mobile, tablet, desktop)
- Professional green color scheme (#2ecc71)
- Smooth animations and transitions
- Modern typography
- Sticky navigation bar
- Social media links
- Client logos section

### ⚡ Performance
- Fast loading with optimized CSS
- Minimal JavaScript dependencies
- Local storage for cart persistence
- SEO-friendly HTML structure

## Project Structure

```
Nova_Eco-Packaging/
├── index.html           # Main landing page with products
├── cart.html            # Shopping cart and checkout page
├── styles.css           # Global styles and responsive design
├── app.js               # JavaScript functionality
├── send_email.php       # Email handler for contact forms
├── contact_log.txt      # Log of contact submissions
├── README.md            # Project documentation
└── images/
    ├── Landing/         # Hero images
    ├── Products/        # Product images
    └── Clients/         # Client logos
```

## Setup Instructions

### Prerequisites
- Web server with PHP support (Apache, Nginx, etc.)
- Modern web browser

### Installation

1. **Clone/Copy Project**
   ```bash
   # Copy the project to your web server directory
   cp -r Nova_Eco-Packaging /var/www/html/
   ```

2. **Configure Web Server**
   - Ensure PHP is enabled
   - Set proper file permissions:
   ```bash
   chmod 755 Nova_Eco-Packaging
   chmod 644 Nova_Eco-Packaging/*.html
   chmod 644 Nova_Eco-Packaging/*.css
   chmod 644 Nova_Eco-Packaging/*.js
   chmod 644 Nova_Eco-Packaging/*.php
   ```

3. **Add Images**
   - Place product images in `images/Products/`
   - Place client logos in `images/Clients/`
   - Place hero image in `images/Landing/`
   - Create a logo: `images/Landing/logo.png`

4. **Configure Email Settings**
   Edit `send_email.php` and update:
   ```php
   $business_email = 'your-email@yourdomain.com';
   ```

5. **Test the Site**
   - Open in browser: `http://localhost/Nova_Eco-Packaging/`