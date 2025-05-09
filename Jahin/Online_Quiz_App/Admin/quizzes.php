<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Management - QuizMaster</title>
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

        .add-quiz-btn {
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

        .add-quiz-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
        }

        /* Table Styles */
        .quizzes-table-container {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
            overflow-x: auto;
        }

        .quizzes-table {
            width: 100%;
            border-collapse: collapse;
        }

        .quizzes-table th,
        .quizzes-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--background-color);
        }

        .quizzes-table th {
            font-weight: 600;
            color: var(--primary-color);
        }

        .quiz-status {
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.9rem;
        }

        .status-published {
            background: #e1f7e1;
            color: #2d862d;
        }

        .status-draft {
            background: #fff3e6;
            color: #cc7700;
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

        .preview-btn {
            background: #e6f3ff;
            color: #0066cc;
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

            .quizzes-table-container {
                padding: 1rem;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .quizzes-table th,
            .quizzes-table td {
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

            .quiz-status {
                padding: 0.2rem 0.5rem;
                font-size: 0.8rem;
            }

            .add-quiz-btn {
                width: 100%;
                justify-content: center;
            }

            .filter-section {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }

            .quizzes-table-container {
                overflow-x: auto;
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
                <li><a href="quizzes.html" class="active"><i class="fas fa-question-circle"></i> Quizzes</a></li>
                <li><a href="reports.html"><i class="fas fa-chart-bar"></i> Reports</a></li>
                <li><a href="settings.html"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Quiz Management</h1>
                <a href="add-quiz.html" class="add-quiz-btn">
                    <i class="fas fa-plus"></i> Create New Quiz
                </a>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-group">
                    <label for="category">Category</label>
                    <select id="category">
                        <option value="all">All Categories</option>
                        <option value="math">Mathematics</option>
                        <option value="science">Science</option>
                        <option value="history">History</option>
                        <option value="language">Language</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="difficulty">Difficulty</label>
                    <select id="difficulty">
                        <option value="all">All Levels</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="status">Status</label>
                    <select id="status">
                        <option value="all">All Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="search">Search</label>
                    <input type="text" id="search" placeholder="Search quizzes...">
                </div>
            </div>

            <div class="quizzes-table-container">
                <table class="quizzes-table">
                    <thead>
                        <tr>
                            <th>Quiz ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Difficulty</th>
                            <th>Questions</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#Q001</td>
                            <td>Basic Mathematics</td>
                            <td>Mathematics</td>
                            <td>Beginner</td>
                            <td>20</td>
                            <td><span class="quiz-status status-published">Published</span></td>
                            <td>2024-01-20</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn preview-btn" title="Preview"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn delete-btn" title="Delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#Q002</td>
                            <td>World History Quiz</td>
                            <td>History</td>
                            <td>Intermediate</td>
                            <td>15</td>
                            <td><span class="quiz-status status-draft">Draft</span></td>
                            <td>2024-01-19</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn preview-btn" title="Preview"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn delete-btn" title="Delete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#Q003</td>
                            <td>Advanced Physics</td>
                            <td>Science</td>
                            <td>Advanced</td>
                            <td>25</td>
                            <td><span class="quiz-status status-published">Published</span></td>
                            <td>2024-01-18</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="action-btn preview-btn" title="Preview"><i class="fas fa-eye"></i></button>
                                    <button class="action-btn delete-btn" title="Delete"><i class="fas fa-trash"></i></button>
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