@extends('layouts.app')
@section('content')
    <style>
         * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: #0a0f1c;
        color: white;
        min-height: 100vh;
    }
       

       

       

        /* Main Content */
        .main-content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hero-left {
            flex: 1;
        }

        .hero-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            margin-bottom: 30px;
        }

        .hero-stats {
            display: flex;
            gap: 60px;
        }

        .stat {
            text-align: left;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .weekly-return {
            color: #4ade80;
            font-size: 24px;
            font-weight: 700;
        }

        .create-bot-btn {
            background: white;
            color: #1e3a8a;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .create-bot-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.2);
        }

        /* Layout */
        .dashboard-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
        }

        /* Sidebar */
        .sidebar {
            background: #1a1a20;
            border-radius: 12px;
            padding: 20px 0;
            height: fit-content;
        }

        .sidebar-section {
            margin-bottom: 30px;
        }

        .sidebar-title {
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 0 20px;
            margin-bottom: 15px;
        }

        .sidebar-item {
            padding: 12px 20px;
            color: #888;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .sidebar-item.active {
            background: #4ade80;
            color: #000;
            font-weight: 600;
            border-left-color: #22c55e;
        }

        .performance-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            font-size: 14px;
        }

        .performance-value {
            color: #4ade80;
            font-weight: 600;
        }

        /* Main Dashboard */
        .dashboard-main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .section-subtitle {
            color: #888;
            font-size: 14px;
        }

        .create-dca-btn {
            background: #4ade80;
            color: #000;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            margin-left: auto;
        }

        /* Bot Cards */
        .bot-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
        }

        .bot-card {
            background: #1a1a20;
            border-radius: 12px;
            padding: 24px;
            border: 1px solid #2a2a30;
            transition: all 0.3s ease;
        }

        .bot-card:hover {
            border-color: #4ade80;
            transform: translateY(-2px);
        }

        .bot-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .bot-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .bot-frequency {
            color: #888;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .bot-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: #4ade80;
            color: #000;
        }

        .status-inactive {
            background: #374151;
            color: #9ca3af;
        }

        .status-configured {
            background: #3b82f6;
            color: white;
        }

        .bot-description {
            color: #ccc;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .bot-metrics {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .metric {
            text-align: left;
        }

        .metric-label {
            color: #888;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .metric-value {
            font-weight: 600;
            font-size: 14px;
        }

        .metric-value.positive {
            color: #4ade80;
        }

        .bot-actions {
            display: flex;
            gap: 12px;
        }

        .btn-secondary {
            background: #374151;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .btn-primary {
            background: #4ade80;
            color: #000;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #22c55e;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }
            
            .hero-stats {
                gap: 40px;
            }
            
            .bot-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }
            
            .hero-section {
                padding: 30px 20px;
            }
            
            .hero-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .hero-stats {
                gap: 30px;
            }
        }
    </style>

<body>
    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-left">
                    <h1 class="hero-title">Automated Trading</h1>
                    <p class="hero-subtitle">Create and manage algorithmic trading strategies</p>
                    <div class="hero-stats">
                        <div class="stat">
                            <div class="stat-number">4</div>
                            <div class="stat-label">Total Bots</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">2</div>
                            <div class="stat-label">Active</div>
                        </div>
                        <div class="stat">
                            <div class="weekly-return">+4.8%</div>
                            <div class="stat-label">Weekly Return</div>
                        </div>
                    </div>
                </div>
                <button class="create-bot-btn">
                    Create New Bot →
                </button>
            </div>
        </section>

        <!-- Dashboard Layout -->
        <div class="dashboard-layout">
         
           

            <!-- Main Dashboard -->
            <div class="dashboard-main">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Dollar-Cost Averaging Bots</h2>
                        <p class="section-subtitle">Regular purchases of assets regardless of price</p>
                    </div>
                    <button class="create-dca-btn">Create DCA Bot</button>
                </div>

                <!-- Bot Grid -->
                <div class="bot-grid">
                    <!-- Bitcoin Accumulation Bot -->
                    <div class="bot-card">
                        <div class="bot-header">
                            <div>
                                <h3 class="bot-title">Bitcoin Accumulation</h3>
                                <div class="bot-frequency">Weekly • DCA</div>
                            </div>
                            <span class="bot-status status-active">Active</span>
                        </div>
                        <p class="bot-description">Dollar-cost averaging into Bitcoin on a weekly basis</p>
                        <div class="bot-metrics">
                            <div class="metric">
                                <div class="metric-label">Risk:</div>
                                <div class="metric-value">Low</div>
                            </div>
                            <div class="metric">
                                <div class="metric-label">Performance:</div>
                                <div class="metric-value positive">+2.4%</div>
                            </div>
                        </div>
                        <div class="bot-actions">
                            <button class="btn-secondary">Configure</button>
                          
                                <a href="/bt-1" class="btn-primary" style="text-decoration: none;text-align: center;">Start BA Bot</a>
                           


                        </div>
                    </div>

                    <!-- ETH DCA Pro Bot -->
                    <div class="bot-card">
                        <div class="bot-header">
                            <div>
                                <h3 class="bot-title">ETH DCA Pro</h3>
                                <div class="bot-frequency">Daily • DCA</div>
                            </div>
                            <span class="bot-status status-active">Active</span>
                        </div>
                        <p class="bot-description">Dynamic DCA based on RSI and volume indicators</p>
                        <div class="bot-metrics">
                            <div class="metric">
                                <div class="metric-label">Risk:</div>
                                <div class="metric-value">Medium</div>
                            </div>
                            <div class="metric">
                                <div class="metric-label">Performance:</div>
                                <div class="metric-value positive">+3.7%</div>
                            </div>
                        </div>
                        <div class="bot-actions">
                            <button class="btn-secondary">Configure</button>
                            <a href="/bt-2" class="btn-primary" style="text-decoration: none;text-align: center;">Start DCA pro</a>
                        </div>
                    </div>

                    <!-- Multi-Coin DCA Bot -->
                    <div class="bot-card">
                        <div class="bot-header">
                            <div>
                                <h3 class="bot-title">Multi-Coin DCA</h3>
                                <div class="bot-frequency">Monthly • DCA</div>
                            </div>

                            <span class="bot-status status-inactive">InActive</span>
                        </div>
                        <p class="bot-description">DCA into top 5 cryptocurrencies by market cap</p>
                        <div class="bot-metrics">
                            <div class="metric">
                                <div class="metric-label">Risk:</div>
                                <div class="metric-value">Medium</div>
                            </div>
                            <div class="metric">
                                <div class="metric-label">Performance:</div>
                                <div class="metric-value">--</div>
                            </div>
                        </div>
                        <div class="bot-actions">
                            <button class="btn-secondary">Configure</button>
                            <button type="button" class="btn-primary" disabled>Start Bot</button>

                        </div>
                    </div>

                    <!-- Cycle-Based Accumulation Bot -->
                    <div class="bot-card">
                        <div class="bot-header">
                            <div>
                                <h3 class="bot-title">Cycle-Based Accumulation</h3>
                                <div class="bot-frequency">Weekly • DCA</div>
                            </div>
                            <span class="bot-status status-inactive">Inactive</span>
                        </div>
                        <p class="bot-description">DCA more during market dips, less during highs</p>
                        <div class="bot-metrics">
                            <div class="metric">
                                <div class="metric-label">Risk:</div>
                                <div class="metric-value">Low</div>
                            </div>
                            <div class="metric">
                                <div class="metric-label">Performance:</div>
                                <div class="metric-value">--</div>
                            </div>
                        </div>
                        <div class="bot-actions">
                            <button class="btn-secondary">Configure</button>
                            <button type="button" class="btn-primary" disabled>Start Bot</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Add interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar navigation
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(item => {
                item.addEventListener('click', function() {
                    sidebarItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Bot card hover effects
            const botCards = document.querySelectorAll('.bot-card');
            botCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                    this.style.boxShadow = '0 12px 40px rgba(74, 222, 128, 0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });

            // Button interactions
            const buttons = document.querySelectorAll('button');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Add click animation
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });
        });
    </script>
    </body>
@endsection