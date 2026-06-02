# EcoSprout Nursery - Frontend Project Structure

## 📁 Project Structure

```
Frontend/
├── includes/
│   ├── header.php          ← Navigation and page header template
│   └── footer.php          ← Footer and scripts template
├── auth/
│   └── login.php           ← User login page
├── assets/
│   ├── css/
│   │   └── style.css       ← Complete custom stylesheet
│   ├── js/
│   │   └── main.js         ← Basic JavaScript for interactions
│   └── images/             ← Store product and blog images here
├── index.php               ← Home page with hero section
├── catalogue.php           ← Plant catalogue with sidebar filters
├── plant.php               ← Individual plant detail page
├── tools.php               ← Tools & accessories listing
├── services.php            ← Services offerings
├── workshops.php           ← Workshops & events
├── blog.php                ← Blog posts listing
├── article.php             ← Individual blog article page
├── about.php               ← About us page
├── contact.php             ← Contact form & information
└── README.md               ← This file
```

---

## 🎨 Design System

### Color Palette
- **Primary**: `#2D6A4F` (Forest Green)
- **Secondary**: `#52B788` (Light Green)
- **Dark**: `#1B4332` (Dark Green)
- **Background**: `#F9F6F0` (Warm off-white)
- **Text**: `#1A2E1A` (Dark)
- **Surface**: `#FFFFFF` (White)
- **Accent**: `#D4A574` (Tan/Gold)

### Typography
- **Headings**: Playfair Display (serif) - 700 weight
- **Body**: Poppins (sans-serif) - 300, 400, 500, 600 weights

### Border Radius
- Standard cards: `8px`
- Large elements: `12px`

---

## 📄 Page Descriptions

### Public Pages

| Page | Purpose | Key Features |
|------|---------|--------------|
| **index.php** | Home page | Hero section, featured plants grid (4 items), services showcase, newsletter signup |
| **catalogue.php** | Product listing | Grid layout with sidebar filters (category, price, difficulty), search functionality |
| **plant.php** | Product details | Product image, description, care guide, quantity selector, related products |
| **tools.php** | Tools & accessories | Grid of 6 gardening tools and equipment |
| **services.php** | Service offerings | 6 service cards with booking options, benefits section |
| **workshops.php** | Events listing | 6 upcoming workshops with registration buttons |
| **blog.php** | Blog posts | 6 blog post cards with category badges |
| **article.php** | Article detail | Full article content, related posts section |
| **about.php** | Company info | Company story, mission/vision/values, team profiles, sustainability commitment |
| **contact.php** | Contact page | Contact form with validation, contact info, FAQ section |

### Authentication Pages

| Page | Purpose | Key Features |
|------|---------|--------------|
| **auth/login.php** | User login | Email/password form, remember me, forgot password link, social login options |

---

## ✨ Key Features

### HTML & Semantics
- Clean, semantic HTML structure
- Beginner-friendly code organization
- Clear component separation (header, footer includes)
- Accessible form labels and inputs

### CSS (style.css)
- **CSS Variables**: Root-level color and spacing variables for easy customization
- **Responsive Design**: Mobile-first approach with breakpoints at 768px and 480px
- **Components**: 
  - Navbar with mobile toggle
  - Buttons (primary, secondary, outline, auth)
  - Cards with hover effects
  - Forms with focus states
  - Hero sections
  - Grids
  - Footer
- **Utilities**: Spacing, text alignment, flex utilities, badges, ratings

### JavaScript (main.js)
- **Basic, beginner-level code**
- No frameworks, libraries, or complex patterns
- Simple functions only:
  - Mobile menu toggle
  - Form validation (login, contact, newsletter)
  - Product filtering
  - Search functionality
  - Quantity controls
  - Simple local storage cart

---

## 🔧 Bootstrap Usage

**ONLY used for:**
1. **Grid System** (container, row, col classes)
2. **Modal System** (Bootstrap modals for future use)

**NOT used for:** Buttons, navbars, cards, typography, colors, or styling

---

## 📝 File Integration

### Links in Header
```php
<?php
$pageTitle = 'Page Title - EcoSprout Nursery';
$cssPath = 'assets/css/style.css';  // or '../assets/css/style.css' for nested pages
$jsPath = 'assets/js/main.js';      // or '../assets/js/main.js' for nested pages
include 'includes/header.php';
?>
```

### Footer Include
```php
<?php include 'includes/footer.php'; ?>
```

---

## 🎯 JavaScript Functions

| Function | Purpose | Usage |
|----------|---------|-------|
| `toggleMenu()` | Mobile menu toggle | Called on menu button click |
| `validateLoginForm()` | Email/password validation | Auto-runs on page load |
| `validateContactForm()` | Contact form validation | Auto-runs on page load |
| `validateNewsletterForm()` | Email validation | Auto-runs on page load |
| `isValidEmail(email)` | Email regex check | Helper function |
| `filterByCategory(category)` | Filter products | Called on checkbox change |
| `searchProducts()` | Search products | Called on input keyup |
| `increaseQuantity(id)` | Increase item quantity | Called on button click |
| `decreaseQuantity(id)` | Decrease item quantity | Called on button click |
| `addToCart(id, name, price)` | Add to local storage | Called on button click |
| `removeFromCart(id)` | Remove from cart | Cart management |

---

## 🖼️ Image Placeholders

All image references use placeholder paths. Replace with actual images:
- `assets/images/plant-1.jpg` through `plant-8.jpg`
- `assets/images/tool-1.jpg` through `tool-6.jpg`
- `assets/images/blog-1.jpg` through `blog-6.jpg`
- `assets/images/about-1.jpg`
- `assets/images/plant-detail.jpg`

---

## 📱 Responsive Breakpoints

- **Desktop**: 1200px+ (full layout)
- **Tablet**: 768px - 1199px (2-column grid)
- **Mobile**: Below 768px (1-column grid, mobile menu)
- **Small Phone**: Below 480px (adjusted fonts, full-width buttons)

---

## 🚀 Getting Started

### 1. Set Up Placeholder Images
Create or add images to the `assets/images/` folder matching the filenames in the code.

### 2. Customize Colors (Optional)
Edit CSS variables in `assets/css/style.css` `:root` section to change brand colors.

### 3. Update Company Information
Edit contact information in:
- `includes/footer.php`
- `contact.php`
- `about.php`

### 4. Link to Backend (Future)
When ready to integrate with PHP backend:
- Update form `action` attributes in `contact.php` and `auth/login.php`
- Add database connection logic to header/footer
- Implement user authentication

---

## 💡 Code Quality Notes

- **Beginner-Friendly**: Written as if by a junior developer
- **No External Dependencies**: Only Bootstrap 5 CDN for grid (as required)
- **Clean Functions**: Simple, readable logic
- **Comments**: Strategic comments on Bootstrap usage
- **Semantic HTML**: Proper heading hierarchy, form labels, accessible structure

---

## 📞 Support

For questions about the design system or code structure, refer to:
- CSS variables at top of `style.css`
- Function documentation in `main.js`
- Page-specific comments in individual PHP files

---

## ✅ Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

---

**Project Created**: 2026
**EcoSprout Nursery - Frontend UI Ready for Development**
