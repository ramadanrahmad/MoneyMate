<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoneyMate</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body>

    <!-- Preloader -->
<div id="preloader">
    <div class="spinner"></div>
    <p>Hi Mates, Please Wait...</p>
</div>

<!-- Konten utama -->
<div id="mainContent" class="fade-in-down" style="display: none;"

<!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <div class="logo-icon"><i class="fas fa-coins"></i></div>
                <div class="logo-text">MoneyMate</div>
            </div>
            <nav>
                <ul>
                    <li><a href="#layanan">Service</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn-primary">Masuk</a></li>
                        <li><a href="{{ route('register') }}" class="btn-secondary">Daftar</a></li>
                    @endauth
                    <li>
                        <button id="themeToggle" class="btn-secondary" style="padding: 0.75rem 1rem; border-radius: 50%;" title="Toggle Theme">
                            <i class="fas fa-moon"></i>
                        </button>
                    </li>
                </ul>
            </nav>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                
                <h1>Manage your money like a <span class="highlight">financial pro</span></h1>
                
                <p>Simple money management solutions, helping you track expenses, set budgets, and achieve financial goals with ease. Take control of your financial future today.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section  -->
    <section id="layanan" class="services">
        <div class="container">
            <div class="section-header">
                <h2>More Reason to Love MoneyMate</h2>
                <p class="subtitle">Experience the ease of managing finances with our best features.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="card-bg"></div>
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Financial Analysis</h3>
                    <p>Get a visualization of your financial performance with interactive charts.</p>
                    <div class="wave-shape">
                        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"></path>
                        </svg>
                    </div>
                </div>
                <div class="service-card">
                    <div class="card-bg"></div>
                    <div class="service-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Data Security</h3>
                    <p>Your financial data is always safe.</p>
                    <div class="wave-shape">
                        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"></path>
                        </svg>
                    </div>
                </div>
                <div class="service-card">
                    <div class="card-bg"></div>
                    <div class="service-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3>Budget Management</h3>
                    <p>Create and manage a budget according to your needs to avoid overspending.</p>
                    <div class="wave-shape">
                        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                            <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <!-- Floating decorative elements -->
        <div class="decor-circle decor-circle-1"></div>
        <div class="decor-circle decor-circle-2"></div>
        <div class="decor-circle decor-circle-3"></div>
        <div class="decor-blob decor-blob-1"></div>
        <div class="decor-blob decor-blob-2"></div>
        
        <div class="container">
            <div class="about-content">
                <h2 class="about-title">About <span class="title-highlight">MoneyMate</span></h2>
                
                <div class="about-text">
                    <p class="lead-paragraph">
                        <strong>MoneyMate</strong> is here as an innovative solution to empower individuals to manage their finances in a smart and modern way.
                    </p>
                    
                    <div class="feature-highlight right-aligned">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <p>
                            Our platform is designed to provide an effective solution to help you easily record your income, expenses, and savings. 
                            With intuitively designed features, you can access real-time financial reports, analyze your spending habits, and manage your budget better. 
                            With MoneyMate, your financial future is in your own hands.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq">
    <div class="container">
        <div class="section-header">
            <h2>General Questions</h2>
            <p>Find Answer to Frequently Asked Questions</p>
        </div>
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Is my financial data safe with MoneyMate?</h3>
                    <span class="faq-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Yes, security is our top priority. MoneyMate implements two-factor authentication</p>
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Is there a category for each grouping of income and expenses based on type?</h3>
                    <span class="faq-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Yes, grouping income and expenses based on type, such as basic needs, entertainment, or education.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-wave"></div>
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Take Control of Your <span>Finances</span> Now</h2>
                <p class="cta-subtitle">Join <strong>users</strong> who transformed their finance management</p>
                <a href="{{ route('dashboard') }}" class="cta-button">
                    Start Your Financial Journey
                    </svg>
                </a>
            </div>
        </div>
        <div class="cta-dots"></div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-col">
                    <div class="footer-logo">
                        <div class="logo-icon"><i class="fas fa-coins"></i></div>
                        <div class="logo-text">MoneyMate</div>
                    </div>
                    <p class="footer-description">Simple money management solutions, helping you manage your finances well with various interesting features.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4 class="footer-title">Explore</h4>
                    <ul class="footer-links">
                        <li><a href="#layanan">Service</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 class="footer-title">Contact Us</h4>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> Indralaya</li>
                        <li><i class="fas fa-phone-alt"></i> (021) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@moneymate.id</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="copyright">&copy; 2025 MoneyMate. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        
        // Menu Toggle
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('nav ul').classList.toggle('active');
        });

        // FAQ Toggles
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            item.querySelector('.faq-question').addEventListener('click', () => {
                item.classList.toggle('active');
                
                // Update icon
                const icon = item.querySelector('.faq-icon i');
                if (item.classList.contains('active')) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                } else {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                }
            });
        });

        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('themeToggle');
        const themeIcon = themeToggleBtn.querySelector('i');
        
        // Initial Icon state based on current theme
        if (document.documentElement.classList.contains('dark')) {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }

        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            }
        });

    // Setelah halaman dimuat
    window.addEventListener('load', function () {
    const preloader = document.getElementById('preloader');
    const mainContent = document.getElementById('mainContent');

    // Sembunyikan preloader setelah 1 detik
    setTimeout(() => {
        preloader.style.display = 'none';
        mainContent.style.display = 'block';
        mainContent.classList.add('fade-in-down');
      }, 1000); // bisa diubah sesuai durasi preloader
    });

    </script>

</body>
</html>