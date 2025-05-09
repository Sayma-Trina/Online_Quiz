// Function to generate a unique certificate ID
        function generateCertificateId() {
            const timestamp = Date.now().toString(36);
            const random = Math.random().toString(36).substr(2, 5);
            return `QM-${timestamp}-${random}`.toUpperCase();
        }

        // Function to download certificate as PDF
        function downloadCertificate() {
            window.print();
        }

        // Function to share certificate
        function shareCertificate() {
            if (navigator.share) {
                navigator.share({
                    title: 'My QuizMaster Certificate',
                    text: `I completed a quiz on QuizMaster! Check out my certificate!`,
                    url: window.location.href
                }).catch(console.error);
            } else {
                alert('Sharing is not supported on this browser');
            }
        }

        // Function to update certificate with actual data
        function updateCertificate(data) {
            document.getElementById('recipientName').textContent = data.name;
            document.getElementById('quizScore').textContent = `Score: ${data.score}%`;
            document.getElementById('completionDate').textContent = `Completed on: ${new Date().toLocaleDateString()}`;
            document.getElementById('certificateId').textContent = `Certificate ID: ${generateCertificateId()}`;
        }

        // Example usage (replace with actual data)
        updateCertificate({
            name: 'Jahin',
            score: 100
        });