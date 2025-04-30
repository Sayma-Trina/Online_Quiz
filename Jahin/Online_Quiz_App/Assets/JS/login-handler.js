// Login Form Handler
document.addEventListener('DOMContentLoaded', () => {
    // Setup login form validation
    ValidationUtils.setupFormValidation('#loginForm', async (form) => {
        const formData = new FormData(form);
        try {
            const response = await fetch('/Controllers/auth.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();
            if (data.error) {
                // Show error message
                const errorDiv = document.querySelector('.auth-error') || 
                    (() => {
                        const div = document.createElement('div');
                        div.className = 'auth-error';
                        form.insertBefore(div, form.firstChild);
                        return div;
                    })();
                errorDiv.textContent = typeof data.error === 'string' ? data.error : 'Login failed';
                errorDiv.style.display = 'block';
            } else if (data.data && data.data.redirect) {
                window.location.href = data.data.redirect;
            }
        } catch (error) {
            console.error('Login error:', error);
        }
    });

    // Setup registration form validation
    ValidationUtils.setupFormValidation('#registerForm', async (form) => {
        const formData = new FormData(form);
        try {
            const response = await fetch('/Controllers/register.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();
            if (data.error) {
                // Show validation errors
                if (typeof data.error === 'object') {
                    Object.entries(data.error).forEach(([field, message]) => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (input) {
                            ValidationUtils.showError(input, message);
                        }
                    });
                } else {
                    const errorDiv = document.querySelector('.auth-error') || 
                        (() => {
                            const div = document.createElement('div');
                            div.className = 'auth-error';
                            form.insertBefore(div, form.firstChild);
                            return div;
                        })();
                    errorDiv.textContent = data.error;
                    errorDiv.style.display = 'block';
                }
            } else if (data.data && data.data.redirect) {
                window.location.href = data.data.redirect;
            }
        } catch (error) {
            console.error('Registration error:', error);
        }
    });
});