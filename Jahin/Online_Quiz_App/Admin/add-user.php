<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - QuizMaster</title>
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

        /* Form Styles */
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
        }

        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--background-color);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .section-title {
            font-size: 1.2rem;
            color: var(--text-color);
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 10px;
            background: var(--background-color);
            box-shadow: inset 3px 3px 5px var(--shadow-color),
                      inset -3px -3px 5px rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            box-shadow: inset 4px 4px 6px var(--shadow-color),
                      inset -4px -4px 6px rgba(255, 255, 255, 0.5);
        }

        .profile-picture-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-picture-preview {
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            background: var(--background-color);
            box-shadow: 3px 3px 5px var(--shadow-color),
                       -3px -3px 5px rgba(255, 255, 255, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: var(--primary-color);
        }

        .upload-btn {
            position: relative;
            display: inline-block;
            cursor: pointer;
            padding: 0.8rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
        }

        .upload-btn:hover {
            transform: translateY(-2px);
        }

        .upload-btn input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 10px;
            background: var(--primary-color);
            color: white;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 5px 5px 10px var(--shadow-color),
                       -5px -5px 10px rgba(255, 255, 255, 0.5);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: var(--background-color);
            color: var(--text-color);
        }

        .form-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
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
                <h1 class="page-title">Add New User</h1>
            </div>

            <form class="form-container" id="addUserForm" enctype="multipart/form-data">
                <!-- User Details Section -->
                <div class="form-section">
                    <h2 class="section-title">User Details</h2>
                    <div class="profile-picture-container">
                        <div class="profile-picture-preview">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <label for="profilePicture" class="upload-btn">
                            <input type="file" id="profilePicture" name="profilePicture" accept="image/*" onchange="previewImage(this)">
                            <span>Upload Profile Picture</span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-buttons">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn">Add User</button>
                </div>
            </form>
        </main>
    </div>

              
        
    </style>
    <script>
        function previewImage(input) {
            const preview = document.querySelector('.profile-picture-preview');
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.innerHTML = '';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.borderRadius = '50%';
                img.style.objectFit = 'cover';
                preview.appendChild(img);
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>