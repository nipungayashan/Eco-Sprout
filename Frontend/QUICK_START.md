# EcoSprout Nursery - Quick Reference Guide

## 🚀 Quick Start Checklist

- [ ] Add product images to `assets/images/`
- [ ] Update company contact info in footer and contact page
- [ ] Customize colors by editing CSS variables in `style.css`
- [ ] Test responsive design on mobile devices
- [ ] Replace placeholder links with actual backend endpoints
- [ ] Add form submission handlers

---

## 🎨 Customization Examples

### Change Primary Color
Edit `assets/css/style.css` `:root` section:
```css
:root {
    --primary-color: #2D6A4F;  /* Change this hex code */
    /* ... rest of variables */
}
```

### Update Company Name
**In header.php:**
```php
<a href="index.php" class="logo">EcoSprout</a>
```

**In footer.php:**
```html
<h4 class="footer-title">EcoSprout</h4>
```

### Add New Navigation Link
In `includes/header.php`, add to `.nav-menu` list:
```html
<li><a href="new-page.php" class="nav-link">New Page</a></li>
```

---

## 📋 Form Validation Examples

### Contact Form Validation
Already implemented in `contact.php` and `main.js`:
```javascript
// Validation triggers automatically on form submit
// Checks:
// - Name: 2+ characters
// - Email: Valid email format
// - Message: 10+ characters
```

### Login Form Validation
Already implemented in `auth/login.php` and `main.js`:
```javascript
// Validation checks:
// - Email: Valid email format
// - Password: 6+ characters
```

---

## 🛒 Add to Cart Implementation

**Current Implementation:**
- Stores items in browser's localStorage
- Functions in `main.js`:
  - `addToCart(productId, productName, productPrice)`
  - `removeFromCart(productId)`
  - `getCart()`

**To enable persistence:**
Replace localStorage with backend API calls.

---

## 📐 Grid System Examples

### 2-Column Grid
```html
<div class="row">
    <div class="col-md-6">Content</div>
    <div class="col-md-6">Content</div>
</div>
```

### 3-Column Grid
```html
<div class="row">
    <div class="col-md-6 col-lg-4">Content</div>
    <div class="col-md-6 col-lg-4">Content</div>
    <div class="col-md-6 col-lg-4">Content</div>
</div>
```

### 4-Column Grid
```html
<div class="row">
    <div class="col-md-6 col-lg-3">Content</div>
    <div class="col-md-6 col-lg-3">Content</div>
    <div class="col-md-6 col-lg-3">Content</div>
    <div class="col-md-6 col-lg-3">Content</div>
</div>
```

---

## 🎯 Component Library

### Buttons
```html
<!-- Primary Button -->
<button class="btn-primary">Click Me</button>

<!-- Secondary Button -->
<button class="btn-secondary">Click Me</button>

<!-- Outline Button -->
<button class="btn-outline">Click Me</button>

<!-- Small Button -->
<button class="btn-primary btn-small">Small Button</button>
```

### Cards
```html
<div class="card">
    <img src="image.jpg" alt="Description" class="card-image">
    <h3 class="card-title">Card Title</h3>
    <p class="card-text">Card description...</p>
    <p class="card-price">$29.99</p>
    <div class="card-footer">
        <button class="btn-primary">Action</button>
    </div>
</div>
```

### Badges
```html
<span class="badge">Default</span>
<span class="badge badge-success">Success</span>
<span class="badge badge-warning">Warning</span>
```

### Rating
```html
<div class="rating">★★★★★ (45 reviews)</div>
```

---

## 📱 Responsive Utilities

### Spacing Utilities
```html
<!-- Margin Top -->
<div class="mt-1">Extra small margin</div>
<div class="mt-2">Small margin</div>
<div class="mt-3">Medium margin</div>
<div class="mt-4">Large margin</div>

<!-- Margin Bottom -->
<div class="mb-1">Extra small margin</div>
<div class="mb-2">Small margin</div>
<!-- ... -->

<!-- Padding -->
<div class="p-1">Extra small padding</div>
<div class="p-2">Small padding</div>
<!-- ... -->
```

### Text Utilities
```html
<div class="text-center">Centered text</div>
<div class="text-left">Left-aligned text</div>
<div class="text-right">Right-aligned text</div>
<div class="text-primary">Primary color text</div>
<div class="text-muted">Muted gray text</div>
```

### Flex Utilities
```html
<div class="flex">Flex container</div>
<div class="flex-center">Centered flex</div>
<div class="flex-between">Space-between flex</div>
<div class="gap-1">Gap 8px</div>
<div class="gap-2">Gap 16px</div>
<div class="gap-3">Gap 24px</div>
```

---

## 🔗 Navigation Structure

**Main Navigation Links:**
- Home: `index.php`
- Plants: `catalogue.php`
- Tools: `tools.php`
- Services: `services.php`
- Workshops: `workshops.php`
- Blog: `blog.php`
- About: `about.php`
- Contact: `contact.php`
- Login: `auth/login.php`

---

## 📝 Form Input Examples

```html
<div class="form-group">
    <label for="fieldId">Field Label</label>
    <input type="text" id="fieldId" name="fieldName" placeholder="Placeholder...">
    <div id="fieldError" class="error-message"></div>
</div>

<div class="form-group">
    <label for="emailId">Email</label>
    <input type="email" id="emailId" name="email">
    <div id="emailError" class="error-message"></div>
</div>

<div class="form-group">
    <label for="messageId">Message</label>
    <textarea id="messageId" name="message"></textarea>
</div>

<div class="form-group">
    <label for="selectId">Select Option</label>
    <select id="selectId" name="option">
        <option value="">Choose...</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
    </select>
</div>
```

---

## 🎯 Mobile Menu Toggle

The mobile menu automatically shows on screens below 768px.

**To manually test:**
1. Open DevTools (F12)
2. Click device toolbar (Ctrl+Shift+M)
3. Menu button appears on small screens

---

## 🔐 Security Notes (Important for Future Development)

When connecting to backend:
1. **Sanitize all user inputs** on the server side
2. **Use HTTPS** for all connections
3. **Validate forms server-side**, not just client-side
4. **Protect sensitive pages** with authentication
5. **Use CSRF tokens** for form submissions
6. **Hash passwords** before storing

---

## 🐛 Troubleshooting

### Images Not Showing
- Verify file paths in code match actual file locations
- Check file names are correct (case-sensitive)
- Ensure images exist in `assets/images/`

### CSS Not Loading
- Verify path: `assets/css/style.css` (relative to current page)
- For nested pages, use: `../assets/css/style.css`
- Check browser DevTools (F12) for 404 errors

### JavaScript Not Working
- Check browser console for errors (F12)
- Verify path: `assets/js/main.js` (relative to current page)
- For nested pages, use: `../assets/js/main.js`
- Ensure IDs in HTML match JavaScript selectors

### Mobile Menu Not Working
- Check that `.menu-toggle` button exists in header
- Verify JavaScript file is loading properly
- Test on actual mobile device or use DevTools

---

## 📞 Common Tasks

### Add New Product
1. Create entry in `catalogue.php` using card component
2. Create new `plant-*.php` for detail page
3. Add images to `assets/images/`

### Add New Blog Post
1. Create entry in `blog.php` using card component
2. Create article content in new `article-*.php`
3. Add thumbnail to `assets/images/`

### Update Footer Links
Edit `includes/footer.php` footer-links lists

### Change Bootstrap Colors
**Note:** Bootstrap is ONLY used for grid. To change colors, edit CSS variables in `style.css`

---

## 📊 CSS Variables Reference

All values can be customized in `style.css`:

```css
:root {
    --primary-color: #2D6A4F;
    --background-color: #F9F6F0;
    --text-color: #1A2E1A;
    --surface-color: #FFFFFF;
    --light-green: #52B788;
    --dark-green: #1B4332;
    --accent-color: #D4A574;
    --light-gray: #E8E3DB;
    --border-color: #D5CEBD;
    
    --spacing-xs: 4px;
    --spacing-sm: 8px;
    --spacing-md: 16px;
    --spacing-lg: 24px;
    --spacing-xl: 32px;
    --spacing-xxl: 48px;
    
    --border-radius: 8px;
    --border-radius-lg: 12px;
}
```

---

## ✅ Pre-Launch Checklist

- [ ] All images added
- [ ] All links working
- [ ] Mobile responsiveness tested
- [ ] Form validation working
- [ ] No console errors (F12)
- [ ] Navigation complete
- [ ] Footer information accurate
- [ ] Social links configured (if applicable)
- [ ] Performance optimized
- [ ] Accessibility checked (headings, labels, alt text)

---

**Happy coding! 🌱**
