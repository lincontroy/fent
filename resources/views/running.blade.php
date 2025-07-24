<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FentiCoin - MACD Trading Bot</title>
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

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            background: #0f1419;
            border-bottom: 1px solid #1a2332;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: #4ade80;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #0a0f1c;
        }

        .page-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #4ade80;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-item {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            color: #9ca3af;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-item:hover {
            background: #1a2332;
            color: white;
        }

        .nav-item.active {
            background: #4ade80;
            color: #0a0f1c;
            font-weight: 500;
        }

        .accounts-btn {
            background: #4ade80;
            color: #0a0f1c;
            font-weight: 500;
        }

        .balance-display {
            background: #4ade80;
            color: #0a0f1c;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
        }

        .main-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .bot-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .bot-info {
            flex: 1;
        }

        .bot-title {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .bot-details {
            color: #9ca3af;
            font-size: 1rem;
        }

        .status-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .status-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            background: #dc2626;
            color: white;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }

        .insufficient-balance {
            background: #374151;
            color: #9ca3af;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .stop-bot-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .stop-bot-btn:hover {
            background: #b91c1c;
            transform: translateY(-1px);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 400px 1fr;
            gap: 2rem;
        }

        .stats-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .stat-card {
            background: #1a2332;
            border-radius: 16px;
            padding: 1.5rem;
        }

        .stat-card.pnl {
            border-left: 4px solid #4ade80;
        }

        .stat-card.runs {
            border-left: 4px solid #8b5cf6;
        }

        .stat-card.trades {
            border-left: 4px solid #3b82f6;
        }

        .stat-card.winrate {
            border-left: 4px solid #f59e0b;
        }

        .stat-card.balance {
            border-left: 4px solid #06b6d4;
        }

        .stat-label {
            color: #9ca3af;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 300;
        }

        .stat-value.positive {
            color: #4ade80;
        }

        .logs-section {
            background: #1a2332;
            border-radius: 16px;
            padding: 1.5rem;
        }

        .logs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .logs-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .logs-count {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .logs-container {
            background: #0f1419;
            border-radius: 12px;
            padding: 1rem;
            max-height: 500px;
            overflow-y: auto;
            font-family: Monaco, 'Cascadia Code', 'Roboto Mono', monospace;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .log-entry {
            margin-bottom: 0.25rem;
            word-wrap: break-word;
        }

        .log-timestamp {
            color: #6b7280;
        }

        .log-error {
            color: #ef4444;
        }

        .log-success {
            color: #4ade80;
        }

        .log-info {
            color: #60a5fa;
        }

        .log-warning {
            color: #f59e0b;
        }

        /* Scrollbar styling */
        .logs-container::-webkit-scrollbar {
            width: 6px;
        }

        .logs-container::-webkit-scrollbar-track {
            background: #374151;
            border-radius: 3px;
        }

        .logs-container::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 3px;
        }

        .logs-container::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-sidebar {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .bot-header {
                flex-direction: column;
                gap: 1rem;
            }
            
            .status-section {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .nav-links {
                display: none;
            }
            
            .bot-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-left">
            <div class="logo">
                <div class="logo-icon">F</div>
                <span>FentiCoin</span>
            </div>
            <div class="page-title">Bot Running</div>
        </div>
        <div class="nav-links">
            <a href="#" class="nav-item">🏠 Dashboard</a>
            <a href="#" class="nav-item">📊 Markets</a>
            <a href="#" class="nav-item">📈 Spot Trading</a>
            <a href="#" class="nav-item">⏰ Futures</a>
            <a href="#" class="nav-item active">🤖 Bots</a>
            <a href="#" class="nav-item accounts-btn">👤 Accounts</a>
        </div>
        <div class="balance-display">$0.00</div>
    </nav>

    <main class="main-content">
        <div class="bot-header">
            <div class="bot-info">
                <h1 class="bot-title">MACD Trading Bot</h1>
                <div class="bot-details">Bot ID: dca-1 • Investment: $100 • Account: Real</div>
            </div>
            <div class="status-section">
                <div class="status-badge">
                    <div class="status-dot"></div>
                    Stopped (Low Balance)
                </div>
                <div class="insufficient-balance">Insufficient Balance</div>
                <button class="stop-bot-btn">Stop Bot</button>
            </div>
        </div>

        <div class="content-grid">
            <div class="stats-sidebar">
                <div class="stat-card pnl">
                    <div class="stat-label">Total P/L</div>
                    <div class="stat-value positive">+$0.00</div>
                </div>
                
                <div class="stat-card runs">
                    <div class="stat-label">Total Runs</div>
                    <div class="stat-value">0</div>
                </div>
                
                <div class="stat-card trades">
                    <div class="stat-label">Total Trades</div>
                    <div class="stat-value">0</div>
                </div>
                
                <div class="stat-card winrate">
                    <div class="stat-label">Win Rate</div>
                    <div class="stat-value">0.0%</div>
                </div>
                
                <div class="stat-card balance">
                    <div class="stat-label">Balance</div>
                    <div class="stat-value">$0.00</div>
                </div>
            </div>

            <div class="logs-section">
                <div class="logs-header">
                    <h2 class="logs-title">Bot Logs</h2>
                    <div class="logs-count">29 entries</div>
                </div>
                
                <div class="logs-container" id="logsContainer">
                    <div class="log-entry log-error">
                        <span class="log-timestamp">[12:43:03.026]</span> <span class="log-error">Insufficient balance (0.00) for investment amount (100.00)</span>
                    </div>
                    <div class="log-entry log-success">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-success">API connection established successfully</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-info">Establishing connection to exchange APIs...</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-info">MACD bot configuration loaded successfully</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-info">Loading historical data for technical analysis...</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-info">Scanning market for trading opportunities in BTCUSDT, ETHUSDT</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-info">Current real balance: $0.00</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-info">Account type: Real</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-info">Investment amount configured: $100</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.494]</span> <span class="log-info">Bot ID dca-1 started - MACD strategy initialized</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.491]</span> <span class="log-info">Real account detected: Using conservative risk management</span>
                    </div>
                    <div class="log-entry log-success">
                        <span class="log-timestamp">[12:43:02.120]</span> <span class="log-success">API connection established successfully</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.120]</span> <span class="log-info">Establishing connection to exchange APIs...</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.120]</span> <span class="log-info">MACD bot configuration loaded successfully</span>
                    </div>
                    <div class="log-entry log-info">
                        <span class="log-timestamp">[12:43:02.120]</span> <span class="log-info">Loading historical data for technical analysis...</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Auto-scroll logs to bottom
        function scrollLogsToBottom() {
            const logsContainer = document.getElementById('logsContainer');
            logsContainer.scrollTop = logsContainer.scrollHeight;
        }

        // Simulate real-time log updates
        function addLogEntry(timestamp, message, type = 'info') {
            const logsContainer = document.getElementById('logsContainer');
            const logEntry = document.createElement('div');
            logEntry.className = `log-entry log-${type}`;
            logEntry.innerHTML = `<span class="log-timestamp">[${timestamp}]</span> <span class="log-${type}">${message}</span>`;
            
            logsContainer.appendChild(logEntry);
            scrollLogsToBottom();
            
            // Update entry count
            const entriesCount = logsContainer.children.length;
            document.querySelector('.logs-count').textContent = `${entriesCount} entries`;
        }

        // Stop bot functionality
        document.querySelector('.stop-bot-btn').addEventListener('click', function() {
            if (confirm('Are you sure you want to stop the MACD Trading Bot?')) {
                const now = new Date();
                const timestamp = now.toTimeString().split(' ')[0] + '.' + now.getMilliseconds().toString().padStart(3, '0');
                addLogEntry(timestamp, 'Bot stopped by user', 'warning');
                
                // Update status
                const statusBadge = document.querySelector('.status-badge');
                statusBadge.innerHTML = '<div class="status-dot"></div>Stopped';
                this.textContent = 'Start Bot';
                this.style.background = '#4ade80';
            }
        });

        // Initialize logs scroll position
        document.addEventListener('DOMContentLoaded', function() {
            scrollLogsToBottom();
        });

        // Simulate periodic log updates (uncomment to enable)
        /*
        setInterval(() => {
            const now = new Date();
            const timestamp = now.toTimeString().split(' ')[0] + '.' + now.getMilliseconds().toString().padStart(3, '0');
            const messages = [
                'Monitoring market conditions...',
                'MACD indicator analysis in progress',
                'Checking for signal crossovers',
                'Risk management parameters verified'
            ];
            const randomMessage = messages[Math.floor(Math.random() * messages.length)];
            addLogEntry(timestamp, randomMessage, 'info');
        }, 5000);
        */
    </script>
</body>
</html>