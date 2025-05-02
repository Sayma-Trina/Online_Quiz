document.addEventListener('DOMContentLoaded', () => {
    // Navigation functionality
    const navItems = document.querySelectorAll('.nav-item');
    const sections = document.querySelectorAll('.dashboard-section');

    navItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const targetSection = item.dataset.section;

            // Update active states
            navItems.forEach(nav => nav.classList.remove('active'));
            item.classList.add('active');

            sections.forEach(section => {
                section.classList.remove('active');
                if (section.id === targetSection) {
                    section.classList.add('active');
                }
            });
        });
    });

    // Progress Chart
    const progressCtx = document.getElementById('progressChart').getContext('2d');
    const progressChart = new Chart(progressCtx, {
        type: 'line',
        data: {
            labels: ['0%', '25%', '50%', '75%', '100%'],
            datasets: [{
                label: 'Class Progress',
                data: [0, 15, 18, 12, 5],
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                borderColor: 'rgba(52, 152, 219, 1)',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Students'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Progress Completion'
                    }
                }
            }
        }
    });

    // Heat Map
    const heatmapCtx = document.getElementById('difficultyHeatmap').getContext('2d');
    const heatmapData = {
        labels: ['Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9', 'Q10'],
        datasets: [{
            label: 'Difficulty Level',
            data: [85, 45, 65, 90, 30, 75, 55, 80, 40, 70],
            backgroundColor: function(context) {
                const value = context.dataset.data[context.dataIndex];
                const alpha = value / 100;
                return `rgba(231, 76, 60, ${alpha})`;
            },
            borderColor: 'rgba(231, 76, 60, 1)',
            borderWidth: 1
        }]
    };

    const heatmap = new Chart(heatmapCtx, {
        type: 'bar',
        data: heatmapData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    title: {
                        display: true,
                        text: 'Difficulty Level (%)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Questions'
                    }
                }
            }
        }
    });

    // Simulate real-time updates
    setInterval(() => {
        // Update random student count
        const onlineStudents = document.querySelector('.stat-number');
        const currentCount = parseInt(onlineStudents.textContent);
        onlineStudents.textContent = Math.max(20, Math.min(30, currentCount + Math.floor(Math.random() * 3) - 1));

        // Update progress chart with random data
        progressChart.data.datasets[0].data = progressChart.data.datasets[0].data.map(
            () => Math.floor(Math.random() * 20)
        );
        progressChart.update();

        // Update heatmap with random difficulty levels
        heatmap.data.datasets[0].data = heatmap.data.datasets[0].data.map(
            () => Math.floor(Math.random() * 100)
        );
        heatmap.update();
    }, 5000);

    // Handle alert actions
    const contactButtons = document.querySelectorAll('.btn-contact');
    const viewButtons = document.querySelectorAll('.btn-view');

    contactButtons.forEach(button => {
        button.addEventListener('click', () => {
            const studentName = button.closest('.alert-card').querySelector('h3').textContent;
            alert(`Contacting ${studentName}...`);
        });
    });

    viewButtons.forEach(button => {
        button.addEventListener('click', () => {
            const studentName = button.closest('.alert-card').querySelector('h3').textContent;
            alert(`Viewing details for ${studentName}...`);
        });
    });
});