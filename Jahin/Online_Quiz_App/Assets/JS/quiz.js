 // Quiz Interaction Logic
        document.querySelectorAll('.option-item').forEach(option => {
            option.addEventListener('click', () => {
                // Remove selected class from all options
                document.querySelectorAll('.option-item').forEach(item => {
                    item.classList.remove('selected');
                });
                // Add selected class to clicked option
                option.classList.add('selected');
            });
        });

        // Timer Logic
        let timeLeft = 15 * 60; // 15 minutes in seconds
        const timerDisplay = document.getElementById('time-remaining');

        const updateTimer = () => {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft > 0) {
                timeLeft--;
            } else {
                clearInterval(timerInterval);
                alert('Time is up!');
            }
        };

        const timerInterval = setInterval(updateTimer, 1000);

        // Navigation Logic
        document.querySelector('.next-button').addEventListener('click', () => {
            // Placeholder for navigation logic
            console.log('Next question');
        });

        document.querySelector('.prev-button').addEventListener('click', () => {
            // Placeholder for navigation logic
            console.log('Previous question');
        });