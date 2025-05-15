document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('verificationForm');
    const certificateInput = document.getElementById('certificateId');
    const result = document.getElementById('verificationResult');

    // Add error message element
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    certificateInput.parentNode.appendChild(errorDiv);

    function validateCertificateId(value) {
        const certIdPattern = /^CERT-\d{4}-\d{3}$/;
        return certIdPattern.test(value);
    }

    function showError(message) {
        certificateInput.parentNode.classList.add('error');
        errorDiv.textContent = message;
    }

    function clearError() {
        certificateInput.parentNode.classList.remove('error');
        errorDiv.textContent = '';
    }

    // Real-time validation
    certificateInput.addEventListener('input', function(e) {
        const value = e.target.value.trim();
        
        if (!value) {
            showError('Certificate ID is required');
        } else if (!validateCertificateId(value)) {
            showError('Please enter a valid certificate ID (e.g., CERT-2023-001)');
        } else {
            clearError();
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const certificateId = certificateInput.value.trim();
        
        if (!certificateId) {
            showError('Certificate ID is required');
            return;
        }

        if (!validateCertificateId(certificateId)) {
            showError('Please enter a valid certificate ID (e.g., CERT-2023-001)');
            return;
        }

        // Clear any existing errors
        clearError();

        // Show loading state
        const submitButton = form.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        submitButton.disabled = true;
        submitButton.textContent = 'Verifying...';

        // Simulate verification process
        setTimeout(() => {
            result.style.display = 'block';
            
            // Update result details
            document.getElementById('resultCertId').textContent = certificateId;
            document.getElementById('resultName').textContent = 'John Doe';
            document.getElementById('resultCourse').textContent = 'Advanced Mathematics';
            document.getElementById('resultDate').textContent = 'October 15, 2023';
            document.getElementById('resultStatus').textContent = 'Valid';

            // Add success class
            result.classList.add('valid');

            // Reset button state
            submitButton.disabled = false;
            submitButton.textContent = originalText;
        }, 1000);
    });
});