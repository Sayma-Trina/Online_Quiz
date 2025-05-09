<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - QuizMaster</title>
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
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.8rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        /* Settings Grid */
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .settings-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
        }

        .settings-card h2 {
            font-size: 1.2rem;
            color: var(--text-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--background-color);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
            font-family: inherit;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--primary-color);
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .save-btn {
            padding: 0.8rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Color Theme Preview */
        .color-preview {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .color-box {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 2px solid #ddd;
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

            .settings-form-container {
                padding: 1rem;
            }

            .form-group {
                flex-direction: column;
                gap: 0.5rem;
            }

            .form-group label {
                width: 100%;
            }

            .form-group input, 
            .form-group select {
                width: 100%;
                padding: 0.75rem;
            }

            .form-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .save-btn, 
            .cancel-btn {
                width: 100%;
                padding: 0.8rem;
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
                <li><a href="reports.html"><i class="fas fa-chart-bar"></i> Reports</a></li>
                <li><a href="settings.html" class="active"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Settings</h1>
                <p>Manage your application settings and preferences</p>
            </div>

            <div class="settings-grid">
                <!-- General Settings -->
                <div class="settings-card">
                    <h2>General Settings</h2>
                    <div class="form-group">
                        <label for="site-name">Site Name</label>
                        <input type="text" id="site-name" value="QuizMaster">
                    </div>
                    <div class="form-group">
                        <label for="site-description">Site Description</label>
                        <textarea id="site-description">An interactive platform for creating and taking quizzes</textarea>
                    </div>
                    <div class="form-group">
                        <label for="timezone">Timezone</label>
                        <select id="timezone">
                            <option value="UTC">UTC</option>
                            <option value="EST">Eastern Time</option>
                            <option value="PST">Pacific Time</option>
                            <option value="GMT">GMT</option>
                        </select>
                    </div>
                </div>

                <!-- Appearance Settings -->
                <div class="settings-card">
                    <h2>Appearance</h2>
                    <div class="form-group">
                        <label for="theme">Color Theme</label>
                        <select id="theme">
                            <option value="light">Light</option>
                            <option value="dark">Dark</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Theme Preview</label>
                        <div class="color-preview">
                            <div class="color-box" style="background: var(--primary-color);"></div>
                            <div class="color-box" style="background: var(--text-color);"></div>
                            <div class="color-box" style="background: var(--background-color);"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                            <span>Enable Animations</span>
                        </div>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div class="settings-card">
                    <h2>Notifications</h2>
                    <div class="form-group">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                            <span>Email Notifications</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                            <span>Quiz Completion Alerts</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                            <span>Marketing Updates</span>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="settings-card">
                    <h2>Security</h2>
                    <div class="form-group">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                            <span>Two-Factor Authentication</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="session-timeout">Session Timeout (minutes)</label>
                        <input type="number" id="session-timeout" value="30" min="5" max="120">
                    </div>
                    <div class="form-group">
                        <div class="toggle-switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                            <span>Login Activity Notifications</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem;">
                <button class="save-btn">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </div>
        </main>
    </div>

    <script src="../Assets/JS/main.js"></script>
    <script src="../../Assets/JS/admin.js"></script>
</body>
</html>