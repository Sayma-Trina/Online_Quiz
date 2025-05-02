document.addEventListener('DOMContentLoaded', function() {
    // Navigation handling
    const navItems = document.querySelectorAll('.nav-item');
    const sections = document.querySelectorAll('.dashboard-section');

    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const targetSection = this.getAttribute('data-section');
            
            // Update active states
            navItems.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
            
            sections.forEach(section => {
                section.classList.remove('active');
                if (section.id === targetSection) {
                    section.classList.add('active');
                }
            });
        });
    });

    // Form validation
    const validateForm = (formElement) => {
        let isValid = true;
        const inputs = formElement.querySelectorAll('select, input');
        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value) {
                isValid = false;
                input.classList.add('invalid');
                // Show error message
                let errorMsg = input.nextElementSibling;
                if (!errorMsg || !errorMsg.classList.contains('error-message')) {
                    errorMsg = document.createElement('div');
                    errorMsg.classList.add('error-message');
                    input.parentNode.insertBefore(errorMsg, input.nextSibling);
                }
                errorMsg.textContent = 'This field is required';
            } else {
                input.classList.remove('invalid');
                const errorMsg = input.nextElementSibling;
                if (errorMsg && errorMsg.classList.contains('error-message')) {
                    errorMsg.remove();
                }
            }
        });
        return isValid;
    };

    // Skill Matrix Chart
    const setupSkillMatrix = () => {
        const ctx = document.getElementById('skillMatrixChart').getContext('2d');
        const skillMatrix = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: ['Problem Solving', 'Critical Thinking', 'Concept Application', 'Analysis', 'Memory Recall'],
                datasets: [{
                    label: 'Current Level',
                    data: [65, 75, 70, 80, 60],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    };

    // Progress Tracking Chart
    const setupProgressChart = () => {
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Performance Score',
                    data: [65, 70, 75, 80],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    };

    // Initialize charts
    setupSkillMatrix();
    setupProgressChart();

    // Subject selection handling
    const subjectSelect = document.getElementById('subjectSelect');
    const topicSelect = document.getElementById('topicSelect');

    const topics = {
        math: ['Algebra', 'Geometry', 'Calculus', 'Statistics'],
        science: ['Physics', 'Chemistry', 'Biology', 'Earth Science'],
        english: ['Grammar', 'Literature', 'Writing', 'Comprehension']
    };

    subjectSelect.addEventListener('change', function() {
        topicSelect.innerHTML = '<option value="">Select Topic</option>';
        if (this.value) {
            topics[this.value].forEach(topic => {
                const option = document.createElement('option');
                option.value = topic.toLowerCase();
                option.textContent = topic;
                topicSelect.appendChild(option);
            });
        }
    });

    // Report generation handling
    const generateReportBtn = document.getElementById('generateReport');
    generateReportBtn.addEventListener('click', function() {
        const startDate = document.getElementById('startDate');
        const endDate = document.getElementById('endDate');

        if (validateForm(document.querySelector('.report-filters'))) {
            // Here you would typically make an API call to fetch the report data
            console.log('Generating report for period:', startDate.value, 'to', endDate.value);
        }
    });

    // Progress tracking filters handling
    const studentSelect = document.getElementById('studentSelect');
    const timeRange = document.getElementById('timeRange');

    [studentSelect, timeRange].forEach(select => {
        select.addEventListener('change', function() {
            if (validateForm(document.querySelector('.tracking-filters'))) {
                // Here you would typically make an API call to update the progress chart
                console.log('Updating progress chart for:', studentSelect.value, 'over', timeRange.value);
            }
        });
    });
});