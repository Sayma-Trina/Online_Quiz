// Form Validation Utilities
const ValidationUtils = {
    patterns: {
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        password: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
        username: /^[a-zA-Z0-9_]{3,20}$/,
        name: /^[a-zA-Z\s]{2,50}$/,
        phone: /^\+?[1-9][0-9]{7,14}$/
    },

    messages: {
        required: 'This field is required',
        email: 'Please enter a valid email address',
        password: 'Password must be at least 8 characters with letters and numbers',
        username: 'Username must be 3-20 characters (letters, numbers, underscore)',
        name: 'Please enter a valid name (2-50 characters)',
        phone: 'Please enter a valid phone number',
        match: 'Passwords do not match'
    },

    showError: function(input, message) {
        const formGroup = input.closest('.form-group');
        const errorElement = formGroup.querySelector('.error-message') || 
            (() => {
                const error = document.createElement('div');
                error.className = 'error-message';
                formGroup.appendChild(error);
                return error;
            })();
        
        input.classList.add('error');
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    },

    clearError: function(input) {
        const formGroup = input.closest('.form-group');
        const errorElement = formGroup.querySelector('.error-message');
        input.classList.remove('error');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    },

    validateField: function(input) {
        const value = input.value.trim();
        const type = input.dataset.validate;

        // Required field check
        if (input.required && !value) {
            this.showError(input, this.messages.required);
            return false;
        }

        // Pattern validation
        if (type && this.patterns[type]) {
            if (!this.patterns[type].test(value)) {
                this.showError(input, this.messages[type]);
                return false;
            }
        }

        // Password confirmation check
        if (type === 'password-confirm') {
            const password = document.querySelector('input[data-validate="password"]');
            if (password && value !== password.value) {
                this.showError(input, this.messages.match);
                return false;
            }
        }

        this.clearError(input);
        return true;
    },

    validateForm: function(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('input[required], input[data-validate]');

        inputs.forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });

        return isValid;
    },

    setupFormValidation: function(formSelector, onSubmit) {
        const form = document.querySelector(formSelector);
        if (!form) return;

        const inputs = form.querySelectorAll('input[required], input[data-validate]');
        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('input', () => this.validateField(input));
        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            if (this.validateForm(form)) {
                if (typeof onSubmit === 'function') {
                    onSubmit(form);
                }
            }
        });
    }
};

// Export the validation utilities
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ValidationUtils;
} else {
    window.ValidationUtils = ValidationUtils;
}