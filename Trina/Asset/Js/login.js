 // Tab switching functionality
        const tabs = document.querySelectorAll('.auth-tab');
        const forms = document.querySelectorAll('.auth-form');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetForm = tab.dataset.tab;

                tabs.forEach(t => t.classList.remove('active'));
                forms.forEach(f => f.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById(`${targetForm}Form`).classList.add('active');
            });
        });

        // Check URL hash for direct navigation to register form
        if (window.location.hash === '#register') {
            document.querySelector('[data-tab="register"]').click();
        }

        // Password strength meter
        function checkPasswordStrength(password) {
            const meter = document.querySelector('#registerForm .strength-meter div');
            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
            if (password.match(/\d/)) strength++;
            if (password.match(/[^a-zA-Z\d]/)) strength++;

            meter.className = '';
            if (strength >= 4) {
                meter.classList.add('strong');
                meter.style.width = '100%';
            } else if (strength >= 2) {
                meter.classList.add('medium');
                meter.style.width = '66%';
            } else if (strength >= 1) {
                meter.classList.add('weak');
                meter.style.width = '33%';
            } else {
                meter.style.width = '0';
            }

            return strength;
        }

        document.getElementById('registerPassword').addEventListener('input', (e) => {
            checkPasswordStrength(e.target.value);
        });

        // Form validation
        function showError(input, message) {
            const errorDiv = input.nextElementSibling;
            if (errorDiv && errorDiv.classList.contains('error-message')) {
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
            }
        }

        function clearError(input) {
            const errorDiv = input.nextElementSibling;
            if (errorDiv && errorDiv.classList.contains('error-message')) {
                errorDiv.style.display = 'none';
            }
        }

        document.getElementById('loginForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('loginEmail');
            const password = document.getElementById('loginPassword');
            let isValid = true;

            if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            } else {
                clearError(email);
            }

            if (password.value.length < 8) {
                showError(password, 'Password must be at least 8 characters long');
                isValid = false;
            } else {
                clearError(password);
            }

            if (isValid) {
                // Placeholder for future backend integration
                console.log('Login form submitted successfully');
                alert('Login functionality will be integrated with backend soon!');
            }
        });

        document.getElementById('registerForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const name = document.getElementById('registerName');
            const email = document.getElementById('registerEmail');
            const password = document.getElementById('registerPassword');
            const confirmPassword = document.getElementById('confirmPassword');
            let isValid = true;

            if (name.value.length < 2) {
                showError(name, 'Name must be at least 2 characters long');
                isValid = false;
            } else {
                clearError(name);
            }

            if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                showError(email, 'Please enter a valid email address');
                isValid = false;
            } else {
                clearError(email);
            }

            if (checkPasswordStrength(password.value) < 2) {
                showError(password, 'Password is too weak');
                isValid = false;
            } else {
                clearError(password);
            }

            if (password.value !== confirmPassword.value) {
                showError(confirmPassword, 'Passwords do not match');
                isValid = false;
            } else {
                clearError(confirmPassword);
            }

            if (isValid) {
                // Placeholder for future backend integration
                console.log('Registration form submitted successfully');
                alert('Registration functionality will be integrated with backend soon!');
            }
        });