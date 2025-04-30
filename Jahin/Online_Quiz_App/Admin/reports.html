<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics - QuizMaster</title>
    <link rel="stylesheet" href="../Assets/CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            background: white;
            padding: 2rem;
            box-shadow: 2px 0 10px var(--shadow-color);
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 1rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-color);
            text-decoration: none;
            padding: 0.8rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--primary-color);
            color: white;
        }

        /* Main Content Styles */
        .main-content {
            padding: 2rem;
            background: var(--background-color);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.8rem;
            color: var(--text-color);
        }

        /* Date Range Selector */
        .date-range {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .date-input {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* Charts Grid */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .chart-title {
            font-size: 1.2rem;
            color: var(--text-color);
            font-weight: 600;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
            text-align: center;
        }

        .stat-card h3 {
            color: var(--text-color);
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        /* Table Styles */
        .performance-table-container {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
            overflow-x: auto;
        }

        .performance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .performance-table th,
        .performance-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--background-color);
        }

        .performance-table th {
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Export Button */
        .export-btn {
            padding: 0.8rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }

            .date-range {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-brand">QuizMaster</div>
            <ul class="sidebar-menu">
                <li><a href="dashboard.html"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="users.html"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="quizzes.html"><i class="fas fa-question-circle"></i> Quizzes</a></li>
                <li><a href="reports.html" class="active"><i class="fas fa-chart-bar"></i> Reports</a></li>
                <li><a href="settings.html"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Reports & Analytics</h1>
                <div class="date-range">
                    <input type="date" class="date-input" id="start-date">
                    <input type="date" class="date-input" id="end-date">
                    <button class="export-btn">
                        <i class="fas fa-download"></i> Export Report
                    </button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Quizzes Taken</h3>
                    <div class="number">1,234</div>
                </div>
                <div class="stat-card">
                    <h3>Average Score</h3>
                    <div class="number">76%</div>
                </div>
                <div class="stat-card">
                    <h3>Active Users</h3>
                    <div class="number">892</div>
                </div>
                <div class="stat-card">
                    <h3>Completion Rate</h3>
                    <div class="number">85%</div>
                </div>
            </div>

            <!-- Charts Grid -->
            <div class="charts-grid">
                <div class="chart-card">
                    <div class="chart-header">
                        <h2 class="chart-title">Quiz Performance Trends</h2>
                    </div>
                    <div class="chart-container">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <div class="chart-header">
                        <h2 class="chart-title">User Engagement</h2>
                    </div>
                    <div class="chart-container">
                        <canvas id="engagementChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Performance Table -->
            <div class="performance-table-container">
                <table class="performance-table">
                    <thead>
                        <tr>
                            <th>Quiz Title</th>
                            <th>Participants</th>
                            <th>Avg. Score</th>
                            <th>Completion Rate</th>
                            <th>Difficulty Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Basic Mathematics</td>
                            <td>150</td>
                            <td>82%</td>
                            <td>95%</td>
                            <td>3.5/5</td>
                        </tr>
                        <tr>
                            <td>World History Quiz</td>
                            <td>98</td>
                            <td>75%</td>
                            <td>88%</td>
                            <td>4.2/5</td>
                        </tr>
                        <tr>
                            <td>Advanced Physics</td>
                            <td>45</td>
                            <td>68%</td>
                            <td>72%</td>
                            <td>4.8/5</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="../Assets/JS/main.js"></script>
    <script src="../../Assets/JS/admin.js"></script>
    <script>
        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Average Score',
                    data: [65, 70, 75, 72, 78, 76],
                    borderColor: '#4CAF50',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Engagement Chart
        const engagementCtx = document.getElementById('engagementChart').getContext('2d');
        new Chart(engagementCtx, {
            type: 'bar',
            data: {
                labels: ['Mathematics', 'Science', 'History', 'Language', 'Literature'],
                datasets: [{
                    label: 'Number of Participants',
                    data: [320, 250, 180, 200, 150],
                    backgroundColor: '#2196F3'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>