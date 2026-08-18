/* ========================================
   ECOSPROUT NURSERY - MAIN JAVASCRIPT
   ======================================== */

/* ========================================
   MOBILE MENU TOGGLE
   ======================================== */

// Get menu toggle button and navigation menu
var menuToggle = document.getElementById('menuToggle');
var navMenu = document.getElementById('navMenu');

// Function to toggle the mobile menu
function toggleMenu() {
    if (menuToggle && navMenu) {
        menuToggle.classList.toggle('active');
        navMenu.classList.toggle('active');
    }
}

// Add click event listener to menu toggle button
if (menuToggle) {
    menuToggle.addEventListener('click', toggleMenu);
}

// Close menu when a link is clicked
if (navMenu) {
    var navLinks = navMenu.querySelectorAll('.nav-link');
    for (var i = 0; i < navLinks.length; i++) {
        navLinks[i].addEventListener('click', function() {
            menuToggle.classList.remove('active');
            navMenu.classList.remove('active');
        });
    }
}

/* ========================================
   FORM VALIDATION
   ======================================== */

// Login Form Validation
function validateLoginForm() {
    var form = document.getElementById('loginForm');
    if (!form) return;
    
    form.addEventListener('submit', function(event) {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var isValid = true;
        
        // Clear previous error messages
        var errorMessages = document.querySelectorAll('.error-message');
        for (var i = 0; i < errorMessages.length; i++) {
            errorMessages[i].innerHTML = '';
        }
        
        // Email validation
        if (email === '') {
            document.getElementById('emailError').innerHTML = 'Email is required.';
            isValid = false;
        } else if (!isValidEmail(email)) {
            document.getElementById('emailError').innerHTML = 'Please enter a valid email.';
            isValid = false;
        }
        
        // Password validation
        if (password === '') {
            document.getElementById('passwordError').innerHTML = 'Password is required.';
            isValid = false;
        } else if (password.length < 6) {
            document.getElementById('passwordError').innerHTML = 'Password must be at least 6 characters.';
            isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
}

// Register Form Validation
function validateRegisterForm() {
    var form = document.getElementById('registerForm');
    if (!form) return;
    
    form.addEventListener('submit', function(event) {
        var fullname = document.getElementById('fullname').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirmPassword').value;
        var terms = document.getElementById('terms').checked;
        var isValid = true;
        
        // Clear previous errors
        var errorMessages = document.querySelectorAll('.error-message');
        for (var i = 0; i < errorMessages.length; i++) {
            errorMessages[i].innerHTML = '';
        }
        
        // Full name validation
        if (fullname === '') {
            document.getElementById('fullnameError').innerHTML = 'Full name is required.';
            isValid = false;
        } else if (fullname.length < 2) {
            document.getElementById('fullnameError').innerHTML = 'Name must be at least 2 characters.';
            isValid = false;
        }
        
        // Email validation
        if (email === '') {
            document.getElementById('emailError').innerHTML = 'Email is required.';
            isValid = false;
        } else if (!isValidEmail(email)) {
            document.getElementById('emailError').innerHTML = 'Please enter a valid email.';
            isValid = false;
        }
        
        // Password validation
        if (password === '') {
            document.getElementById('passwordError').innerHTML = 'Password is required.';
            isValid = false;
        } else if (password.length < 8) {
            document.getElementById('passwordError').innerHTML = 'Password must be at least 8 characters.';
            isValid = false;
        }
        
        // Confirm password validation
        if (confirmPassword === '') {
            document.getElementById('confirmPasswordError').innerHTML = 'Please confirm your password.';
            isValid = false;
        } else if (password !== confirmPassword) {
            document.getElementById('confirmPasswordError').innerHTML = 'Passwords do not match.';
            isValid = false;
        }
        
        // Terms validation
        if (!terms) {
            document.getElementById('termsError').innerHTML = 'You must agree to the terms and conditions.';
            isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
}

// Forgot Password Form Validation
function validateForgotForm() {
    var form = document.getElementById('forgotForm');
    if (!form) return;
    
    form.addEventListener('submit', function(event) {
        var email = document.getElementById('email').value;
        var isValid = true;
        
        // Clear previous error
        document.getElementById('emailError').innerHTML = '';
        
        // Email validation
        if (email === '') {
            document.getElementById('emailError').innerHTML = 'Email is required.';
            isValid = false;
        } else if (!isValidEmail(email)) {
            document.getElementById('emailError').innerHTML = 'Please enter a valid email.';
            isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
}

// Contact Form Validation
function validateContactForm() {
    var form = document.getElementById('contactForm');
    if (!form) return;
    
    form.addEventListener('submit', function(event) {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var message = document.getElementById('message').value;
        var isValid = true;
        
        // Clear previous error messages
        var errorMessages = document.querySelectorAll('.error-message');
        for (var i = 0; i < errorMessages.length; i++) {
            errorMessages[i].innerHTML = '';
        }
        
        // Name validation
        if (name === '') {
            document.getElementById('nameError').innerHTML = 'Name is required.';
            isValid = false;
        } else if (name.length < 2) {
            document.getElementById('nameError').innerHTML = 'Name must be at least 2 characters.';
            isValid = false;
        }
        
        // Email validation
        if (email === '') {
            document.getElementById('emailError').innerHTML = 'Email is required.';
            isValid = false;
        } else if (!isValidEmail(email)) {
            document.getElementById('emailError').innerHTML = 'Please enter a valid email.';
            isValid = false;
        }
        
        // Message validation
        if (message === '') {
            document.getElementById('messageError').innerHTML = 'Message is required.';
            isValid = false;
        } else if (message.length < 10) {
            document.getElementById('messageError').innerHTML = 'Message must be at least 10 characters.';
            isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
}

// Newsletter Form Validation
function validateNewsletterForm() {
    var form = document.getElementById('newsletterForm');
    if (!form) return;
    
    form.addEventListener('submit', function(event) {
        var email = document.getElementById('newsletterEmail').value;
        var isValid = true;
        
        // Clear previous error message
        var errorMessage = document.getElementById('newsletterError');
        if (errorMessage) {
            errorMessage.innerHTML = '';
        }
        
        // Email validation
        if (email === '') {
            if (errorMessage) {
                errorMessage.innerHTML = 'Email is required.';
            }
            isValid = false;
        } else if (!isValidEmail(email)) {
            if (errorMessage) {
                errorMessage.innerHTML = 'Please enter a valid email.';
            }
            isValid = false;
        }
        
        if (!isValid) {
            event.preventDefault();
        }
    });
}

/* ========================================
   UTILITY FUNCTIONS
   ======================================== */

// Email validation helper function
function isValidEmail(email) {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

// Initialize all forms on page load
document.addEventListener('DOMContentLoaded', function() {
    validateLoginForm();
    validateRegisterForm();
    validateForgotForm();
    validateContactForm();
    validateNewsletterForm();
});

/* ========================================
   FILTER FUNCTIONALITY
   ======================================== */

// Filter products based on category
function filterByCategory(category) {
    var products = document.querySelectorAll('.product-item');
    
    for (var i = 0; i < products.length; i++) {
        var productCategory = products[i].getAttribute('data-category');
        
        if (category === 'all' || productCategory === category) {
            products[i].style.display = 'block';
        } else {
            products[i].style.display = 'none';
        }
    }
}

/* ========================================
   SIMPLE SEARCH FUNCTION
   ======================================== */

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    if (!searchInput) return;

    const products = document.querySelectorAll('.product-item');

    function filterProducts() {
        const filter = searchInput.value.toLowerCase();

        products.forEach(product => {
            const titleEl = product.querySelector('.card-title');
            const title = titleEl ? titleEl.textContent.toLowerCase() : '';

            if (title.includes(filter)) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterProducts);
});

/* ========================================
   QUANTITY CONTROLS
   ======================================== */

function increaseQuantity(elementId) {
    var input = document.getElementById(elementId);
    if (input) {
        var currentValue = parseInt(input.value);
        input.value = currentValue + 1;
    }
}

function decreaseQuantity(elementId) {
    var input = document.getElementById(elementId);
    if (input) {
        var currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }
}

/* ========================================
   SMOOTH SCROLLING
   ======================================== */

// Handle smooth scroll for anchor links
var links = document.querySelectorAll('a[href^="#"]');
for (var i = 0; i < links.length; i++) {
    links[i].addEventListener('click', function(event) {
        var targetId = this.getAttribute('href').substring(1);
        var targetElement = document.getElementById(targetId);
        
        if (targetElement) {
            event.preventDefault();
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
}

/* Cart functions are in assets/js/cart.js */
