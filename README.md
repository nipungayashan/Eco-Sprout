**EcoSprout**

EcoSprout is a web-based plant and gardening management platform designed to provide users with a convenient way to explore plants, purchase products, access gardening services, and manage their interactions through a structured web application.

The project includes customer-facing features as well as dedicated staff and administrator sections for managing different parts of the system.

**Features**

Customer Features :
- User registration and authentication
- Customer dashboard
- Browse and search for plants
- View detailed plant information
- Shopping cart functionality
- Checkout and order confirmation
- View gardening services
- Explore gardening tools
- Browse workshops
- Read articles and blog content
- Contact and service-related pages

Administrative Features:
- Administrator dashboard
- Manage plants and plant information
- Add and update plant records
- Manage customer orders
- Manage services
- Manage gardening tools
- Generate and view reports

Staff Features:
- Staff dashboard
- Manage orders
- Manage plants
- Add and update plant information
- Manage services
- Manage workshops
- Manage gardening tools

**Technology Stack**

Frontend:
- HTML5
- CSS3
- JavaScript

Backend:
- PHP

**Database**
- MySQL
- phpMyAdmin

Development Environment
- WAMP Server

**Project Structure**

```text
EcoSprout/
│
├── Frontend/
│   ├── admin/              # Administrator functionality
│   ├── assets/
│   │   ├── css/            # Stylesheets
│   │   ├── images/         # Project images
│   │   └── js/             # JavaScript functionality
│   ├── auth/               # User authentication
│   ├── customer/           # Customer dashboard and features
│   ├── includes/           # Reusable PHP components
│   ├── staff/              # Staff management functionality
│   │
│   ├── index.php           # Main application page
│   ├── catalogue.php       # Plant catalogue
│   ├── plant.php           # Plant details
│   ├── article.php         # Article page
│   ├── blog.php            # Blog page
│   ├── contact.php         # Contact page
│   ├── services.php        # Gardening services
│   ├── tools.php           # Gardening tools
│   ├── workshops.php       # Workshops
│   ├── checkout.php        # Checkout process
│   └── order-success.php   # Order confirmation
│
├── backend/
│   └── *.sql               # MySQL database export
│
└── README.md
```

**Author**
Nipun Gayashan

 **License**
This project was developed for educational purposes.
