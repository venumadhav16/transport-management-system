<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db_connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Management System</title>
    <style>
        /* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background-color: #f1f1f1;
}

header {
    background: #333;
    color: #fff;
    padding: 1rem 0;
    width: 100%;
}

header nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

header nav .logo h1 {
    font-size: 1.5rem;
}

header nav ul {
    list-style: none;
    display: flex;
}

header nav ul li {
    margin-left: 2rem;
}

header nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 1rem;
    transition: color 0.3s;
}

header nav ul li a:hover,
header nav ul li a.logout-btn {
    color: #f39c12;
}

.main-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem 0;
}

/* Hero section */
.hero {
    background: url('images/hero-bg.jpg') no-repeat center center/cover;
    color: #fff;
    min-width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    position: relative;
    flex-shrink: 0;
    padding: 4rem 0;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
}

.hero .hero-content {
    position: relative;
    z-index: 1;
    max-width: 600px;
    margin: 0 2rem;
}

.hero .hero-content h2 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    animation: slide-in 1s ease-out;
}

.hero .hero-content p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    animation: fade-in 2s ease-in;
}

.hero .cta-btn {
    background: #f39c12;
    color: #fff;
    padding: 0.8rem 2rem;
    text-decoration: none;
    font-size: 1rem;
    border-radius: 5px;
    transition: background 0.3s;
}

.hero .cta-btn:hover {
    background: #e67e22;
}

/* Services section */
.services {
    background-color: #fff;
    text-align: center;
    padding: 4rem 2rem;
}

.services h2 {
    font-size: 2rem;
    margin-bottom: 2rem;
}

.service-cards {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.service-cards .card {
    background: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    max-width: 300px;
    margin: 1rem;
    overflow: hidden;
    transition: transform 0.3s;
}

.service-cards .card:hover {
    transform: translateY(-10px);
}

.service-cards .card img {
    width: 100%;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.service-cards .card h3 {
    font-size: 1.5rem;
    margin: 1rem 0;
}

.service-cards .card p {
    padding: 0 1rem 1rem;
}

/* Achievements section */
.achievements {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 4rem 2rem;
}

.achievements h2 {
    font-size: 2rem;
    margin-bottom: 2rem;
}

.achievement-stats {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.achievement-stats .stat {
    margin: 1rem;
    text-align: center;
}

.achievement-stats .stat h3 {
    font-size: 3rem;
    color: #f39c12;
}

.achievement-stats .stat p {
    font-size: 1.2rem;
}

/* Footer styling */
footer {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 1rem 0;
    width: 100%;
}

footer .social-media {
    margin-bottom: 1rem;
}

footer .social-media a {
    color: #fff;
    margin: 0 0.5rem;
    font-size: 1.5rem;
    transition: color 0.3s;
}

footer .social-media a:hover {
    color: #f39c12;
}

/* Responsive Design */
@media (max-width: 768px) {
    header nav ul {
        flex-direction: column;
        align-items: flex-start;
    }

    header nav ul li {
        margin: 0.5rem 0;
    }

    .hero {
        height: 50vh;
    }

    .service-cards {
        flex-direction: column;
        align-items: center;
    }
    .service-cards .card {
        margin: 1rem 0;
        max-width: 100%;
    }

    .achievement-stats {
        flex-direction: column;
        align-items: center;
    }
}

.logout-btn,
.login-btn,
.signup-btn,
.cta-btn {
    color: #fff;
    text-decoration: none;
    font-size: 1rem;
    transition: color 0.3s;
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
}

.logout-btn:hover,
.login-btn:hover,
.signup-btn:hover,
.cta-btn:hover {
    color: #f39c12;
}

        </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <h1>Transport Management System</h1>
            </div>
            <ul>
                <li><a href="#services">Services</a></li>
                <li><a href="book_vehicle.php">Book Vehicle</a></li>
                <li><a href="dashboard.php">Dashboard</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php" class="logout-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="login-btn">Login</a></li>
                    <li><a href="signup.php" class="signup-btn">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <h2>Welcome to Our Transport Management System</h2>
            <p>Your reliable partner in transportation.</p>
            <a href="#services" class="cta-btn">Explore Services</a>
        </div>
    </section>

    <section id="services" class="services">
        <h2>Our Services</h2>
        <div class="service-cards">
            <div class="card">
                <img src="images/service1.jpg" alt="Service 1">
                <h3>Vehicle Booking</h3>
                <p>Book vehicles easily with our user-friendly platform.</p>
            </div>
            <div class="card">
                <img src="images/service2.jpg" alt="Service 2">
                <h3>Route Management</h3>
                <p>Manage and optimize routes for efficient transportation.</p>
            </div>
            <div class="card">
                <img src="images/service3.jpg" alt="Service 3">
                <h3>Driver Management</h3>
                <p>Keep track of drivers and their schedules seamlessly.</p>
            </div>
        </div>
    </section>

    <section id="achievements" class="achievements">
        <h2>Our Achievements</h2>
        <div class="achievement-stats">
            <div class="stat">
                <h3>500+</h3>
                <p>Vehicles Managed</p>
            </div>
            <div class="stat">
                <h3>1200+</h3>
                <p>Routes Optimized</p>
            </div>
            <div class="stat">
                <h3>1000+</h3>
                <p>Satisfied Clients</p>
            </div>
        </div>
    </section>

    <footer>
        <div class="social-media">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin-in"></a>
        </div>
        <p>&copy; 2024 Transport Management System. All rights reserved.</p>
    </footer>
</body>
</html>
