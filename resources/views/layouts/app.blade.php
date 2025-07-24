<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FentiBot - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo-section">
            <div class="logo-icon">+</div>
            <span class="logo-text">FentiBot</span>
        </div>
        
        <button class="mobile-menu-btn">☰</button>
        
        <nav class="nav-menu">
            <a href="/dashboard" class="nav-item active">🏠 Dashboard</a>
            <a href="/markets" class="nav-item">📊 Markets</a>
            <a href="#" class="nav-item">⚡ Spot Trading</a>
            <a href="#" class="nav-item">⏰ Futures</a>
            <a href="/bots" class="nav-item">🤖 Bots</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="nav-item" onclick="event.preventDefault(); confirmLogout();">🚪 Logout</a>
        </nav>
        
        <div class="user-section">
            <div class="balance">💰 $0.00</div>
            <div class="user-menu">🔧 Accounts ▼</div>
            <div class="user-avatar">👤</div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#" class="nav-item active">🏠 Dashboard</a>
        <a href="/markets" class="nav-item">📊 Markets</a>
        <a href="#" class="nav-item">⚡ Spot Trading</a>
        <a href="#" class="nav-item">⏰ Futures</a>
        <a href="/bots" class="nav-item">🤖 Bots</a>
        <div class="nav-item balance">💰 $0.00</div>
        <div class="nav-item">🔧 Accounts</div>
        <a href="#" class="nav-item" onclick="event.preventDefault(); confirmLogout();">🚪 Logout</a>
    </div>

    <!-- Main Content -->
    @yield('content')

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be logged out of your account!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show success message before logout
                    Swal.fire({
                        title: 'Logging out...',
                        text: 'See you soon!',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        document.getElementById('logout-form').submit();
                    });
                }
            });
        }
    </script>       
  
    <script>
        // Add enhanced interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const mobileMenu = document.getElementById('mobileMenu');
            
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('active');
                this.textContent = mobileMenu.classList.contains('active') ? '✕' : '☰';
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileMenu.contains(e.target) && e.target !== mobileMenuBtn) {
                    mobileMenu.classList.remove('active');
                    mobileMenuBtn.textContent = '☰';
                }
            });

            // Animate cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('.crypto-card, .watchlist-item, .feature-box').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                observer.observe(el);
            });

            // Enhanced hover effects for cards
            document.querySelectorAll('.crypto-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.boxShadow = '0 20px 60px rgba(74, 222, 128, 0.2)';
                    this.style.transition = 'all 0.3s ease';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = 'none';
                });
            });

            // Button click effects (excluding logout buttons to avoid conflicts)
            document.querySelectorAll('button:not(.mobile-menu-btn)').forEach(button => {
                button.addEventListener('click', function(e) {
                    // Skip if this is a logout-related button
                    if (this.onclick && this.onclick.toString().includes('confirmLogout')) {
                        return;
                    }
                    
                    e.preventDefault();
                    
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.style.position = 'absolute';
                    ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                    ripple.style.borderRadius = '50%';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.pointerEvents = 'none';
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    // Remove ripple after animation
                    setTimeout(() => {
                        if (ripple.parentNode === this) {
                            this.removeChild(ripple);
                        }
                    }, 600);
                });
            });

            // Floating sidebar interactions
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.2) rotate(5deg)';
                    this.style.transition = 'transform 0.3s ease';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) rotate(0deg)';
                });
            });

            // Add keyboard navigation support
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    document.querySelectorAll('button, a, input').forEach(el => {
                        el.style.transition = 'box-shadow 0.2s ease';
                    });
                }
            });

            // Add focus styles for accessibility
            document.querySelectorAll('button, a, input').forEach(el => {
                el.addEventListener('focus', function() {
                    this.style.outline = '2px solid rgba(74, 222, 128, 0.8)';
                    this.style.outlineOffset = '2px';
                });
                
                el.addEventListener('blur', function() {
                    this.style.outline = 'none';
                });
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>