 // Export Results Function
        function exportData(format) {
            console.log(`Exporting results in ${format} format...`);
            alert('Export functionality will be implemented with backend integration!');
        }

        // Share Results Function
        document.querySelector('.share-button').addEventListener('click', () => {
            // Placeholder for share functionality
            alert('Share functionality will be implemented soon!');
        });

        // Retry Quiz Function
        document.querySelector('.retry-button').addEventListener('click', () => {
            window.location.href = 'quiz.html';
        });

        // View Certificate Function
        document.querySelector('.certificate-button').addEventListener('click', () => {
            const quizData = {
                name: 'John Doe', // Replace with actual user name
                score: document.querySelector('.score-circle').textContent.replace('%', '')
            };
            sessionStorage.setItem('quizData', JSON.stringify(quizData));
            window.location.href = 'certificate.html';
        });