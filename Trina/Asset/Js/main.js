// DOM Elements
const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('.nav-menu');
const navOverlay = document.querySelector('.nav-overlay');
const notificationBell = document.querySelector('.notification-bell');
const notificationDropdown = document.querySelector('.notification-dropdown');

// Mobile Menu Toggle
// Mobile menu functionality
function toggleMenu() {
    navToggle.classList.toggle('active');
    navMenu.classList.toggle('active');
    navOverlay.classList.toggle('active');
    document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
}

navToggle.addEventListener('click', toggleMenu);
navOverlay.addEventListener('click', toggleMenu);

// Close menu when clicking menu items
const menuItems = document.querySelectorAll('.nav-menu a');
menuItems.forEach(item => {
    item.addEventListener('click', () => {
        if (navMenu.classList.contains('active')) {
            toggleMenu();
        }
    });
});

// Close menu on window resize (if open)
window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && navMenu.classList.contains('active')) {
        toggleMenu();
    }
});

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
    if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
        navMenu.classList.remove('active');
    }
});

// Notification System
if (notificationBell && notificationDropdown) {
    notificationBell.addEventListener('click', (e) => {
        e.stopPropagation();
        notificationDropdown.classList.toggle('active');
    });

    // Close notification dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!notificationBell.contains(e.target)) {
            notificationDropdown.classList.remove('active');
        }
    });
}

// Smooth Scroll for Navigation Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            // Close mobile menu after clicking a link
            navMenu.classList.remove('active');
        }
    });
});

// Add animation class to elements when they come into view
const animateOnScroll = () => {
    const elements = document.querySelectorAll('.feature-card, .cta-section, .footer-section');
    
    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const elementBottom = element.getBoundingClientRect().bottom;
        
        if (elementTop < window.innerHeight && elementBottom > 0) {
            element.classList.add('animate-fade-in');
        }
    });
};

// Initial check for elements in view
document.addEventListener('DOMContentLoaded', animateOnScroll);

// Check for elements in view on scroll
window.addEventListener('scroll', animateOnScroll);

// Form Validation
const validateForm = (form) => {
    const inputs = form.querySelectorAll('input[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('error');
        } else {
            input.classList.remove('error');
        }
    });

    return isValid;
};

// Export Data Function (Placeholder)
const exportData = (format) => {
    // This is a placeholder function for future backend integration
    console.log(`Exporting data in ${format} format...`);
    alert(`Data export in ${format} format will be available soon!`);
};

// Search and Filter Function (Placeholder)
const searchAndFilter = (searchTerm, filter) => {
    // This is a placeholder function for future backend integration
    console.log(`Searching for: ${searchTerm} with filter: ${filter}`);
};