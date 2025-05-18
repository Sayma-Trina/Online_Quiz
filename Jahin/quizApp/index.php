<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the router for handling routes
require_once __DIR__ . '/router.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizMaster - Interactive Learning Platform</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="./Assets/css/styles.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        
    </head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <a href="index.html">QuizMaster</a>
        </div>
        <div class="nav-toggle">
            <i class="fas fa-bars"></i>
        </div>
        <div class="nav-overlay"></div>
        <div class="nav-menu">
            <ul>
                <li style="--i:1"><a href="#features">Features</a></li>
                
                <li style="--i:3"><a href="/quizApp/login" class="btn-login">Login</a></li>
                <li style="--i:4"><a href="/quizApp/register" class="btn-register">Register</a></li>
            </ul>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-content">
            <h1>Elevate Your Learning</h1>
            <p>Join our interactive quiz platform and unlock your potential</p>
            <a href="/quizApp/login" class="cta-button">Start Your Journey</a>
        </div>
    </header>

    <main>
        <section id="features" class="features">
            <h2>Why Choose QuizMaster?</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <i class="fas fa-brain"></i>
                    <h3>Smart Learning</h3>
                    <p>Adaptive quizzes that grow with your knowledge</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-line"></i>
                    <h3>Track Progress</h3>
                    <p>Detailed analytics to monitor your improvement</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-trophy"></i>
                    <h3>Earn Rewards</h3>
                    <p>Get certified and showcase your achievements</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-users"></i>
                    <h3>Global Community</h3>
                    <p>Connect with learners worldwide</p>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="about-content">
                <div class="about-text">
                    <h2>About QuizMaster</h2>
                    <p>QuizMaster is a revolutionary online learning platform designed to make education engaging, interactive, and accessible to everyone. Our mission is to transform the way people learn through innovative quiz-based learning experiences.</p>
                    <p>Founded in 2023, we've grown from a small startup to a trusted educational platform used by students, professionals, and organizations worldwide.</p>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number">50K+</div>
                            <div class="stat-label">Active Users</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">1000+</div>
                            <div class="stat-label">Quizzes Created</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">95%</div>
                            <div class="stat-label">Success Rate</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Support</div>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="Assets/images/about-illustration.svg" alt="About QuizMaster" style="width: 100%; max-width: 500px;">
                </div>
            </div>
        </section>

        <section class="team-section">
            <h2>Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-card">
                    <img src="Assets/images/team-1.svg" alt="Sarah Johnson">
                    <h3>Sarah Johnson</h3>
                    <p>Founder & CEO</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="team-card">
                    <img src="Assets/images/team-2.svg" alt="Michael Chen">
                    <h3>Michael Chen</h3>
                    <p>Head of Education</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="team-card">
                    <img src="Assets/images/team-3.svg" alt="Emily Rodriguez">
                    <h3>Emily Rodriguez</h3>
                    <p>Lead Developer</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <h2>Ready to Challenge Yourself?</h2>
            <p>Join thousands of learners and start your journey today</p>
            <a href="/quizApp/register" class="cta-button">Get Started Free</a>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>QuizMaster</h3>
                <p>Empowering learning through interactive quizzes</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 QuizMaster. All rights reserved.</p>
        </div>
    </footer>

    <script src="Assets/JS/main.js"></script>
</body>
</html>