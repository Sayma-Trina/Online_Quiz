<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - QuizMaster</title>
    <link rel="stylesheet" href="../Assets/CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .add-user-btn {
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
            text-decoration: none;
        }

        .add-user-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Table Styles */
        .users-table-container {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th,
        .users-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--background-color);
        }

        .users-table th {
            font-weight: 600;
            color: var(--primary-color);
        }

        .user-status {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.9rem;
        }

        .status-active {
            background: #e1f7e1;
            color: #2d862d;
        }

        .status-inactive {
            background: #ffe6e6;
            color: #cc0000;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: #e1f7e1;
            color: #2d862d;
        }

        .delete-btn {
            background: #ffe6e6;
            color: #cc0000;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .sidebar {
                display: none;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .users-table-container {
                padding: 1rem;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .users-table th,
            .users-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.3rem;
            }

            .action-btn {
                padding: 0.3rem;
                font-size: 0.8rem;
            }

            .user-status {
                padding: 0.2rem 0.5rem;
                font-size: 0.8rem;
            }

            .add-user-btn {
                width: 100%;
                justify-content: center;
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
                <li><a href="users.html" class="active"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="quizzes.html"><i class="fas fa-question-circle"></i> Quizzes</a></li>
                <li><a href="reports.html"><i class="fas fa-chart-bar"></i> Reports</a></li>
                <li><a href="settings.html"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">User Management</h1>
                <a href="add-user.html" class="add-user-btn">
                    <i class="fas fa-plus"></i> Add New User
                </a>
            </div>

            <div class="users-table-container">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#001</td>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>Student</td>
                            <td><span class="user-status status-active">Active</span></td>
                            <td>2024-01-20 10:30 AM</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#002</td>
                            <td>Jane Smith</td>
                            <td>jane.smith@example.com</td>
                            <td>Teacher</td>
                            <td><span class="user-status status-active">Active</span></td>
                            <td>2024-01-19 03:45 PM</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#003</td>
                            <td>Mike Johnson</td>
                            <td>mike.j@example.com</td>
                            <td>Student</td>
                            <td><span class="user-status status-inactive">Inactive</span></td>
                            <td>2024-01-15 09:15 AM</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="../Assets/JS/main.js"></script>
<script src="../../Assets/JS/admin.js"></script>
</body>
</html>