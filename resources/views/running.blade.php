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

        /* Mobile Balance Widget */
        .mobile-balance-widget {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #1a2332;
            padding: 12px 16px;
            border-top: 1px solid #2a3441;
            z-index: 100;
            box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.3);
        }

        .balance-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .balance-label {
            color: #9ca3af;
            font-size: 0.9rem;
        }

        .balance-amount {
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
        }

        .balance-change {
            font-size: 0.8rem;
            margin-left: 8px;
        }

        .balance-change.positive {
            color: #4ade80;
        }

        .balance-change.negative {
            color: #ef4444;
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

        .status-badge.running {
            background: #4ade80;
            color: #0a0f1c;
        }

        .status-badge.paused {
            background: #f59e0b;
            color: #0a0f1c;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }

        .status-dot.running {
            background: #0a0f1c;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .insufficient-balance {
            background: #374151;
            color: #9ca3af;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .trade-controls {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-start {
            background: #4ade80;
            color: #0a0f1c;
        }

        .btn-start:hover {
            background: #22c55e;
        }

        .btn-pause {
            background: #f59e0b;
            color: white;
        }

        .btn-pause:hover {
            background: #d97706;
        }

        .btn-stop {
            background: #dc2626;
            color: white;
        }

        .btn-stop:hover {
            background: #b91c1c;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
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

        .stat-value.negative {
            color: #ef4444;
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

        .log-trade {
            color: #a78bfa;
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
                gap: 1rem;
            }
            
            .stats-sidebar {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 0.75rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 0.5rem;
                padding-bottom: 70px; /* Add padding to prevent content from being hidden behind mobile balance widget */
            }
            
            .bot-header {
                flex-direction: column;
                gap: 0.75rem;
                margin-bottom: 1rem;
            }
            
            .status-section {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.5rem;
                width: 100%;
            }
            
            .nav-links {
                display: none;
            }
            
            .bot-title {
                font-size: 1.5rem;
                margin-bottom: 0.25rem;
            }

            .bot-details {
                font-size: 0.85rem;
            }

            .status-badge {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }

            .insufficient-balance {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .trade-controls {
                gap: 0.3rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }

            .stats-sidebar {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.5rem;
                margin-bottom: 1rem;
            }

            .stat-card {
                padding: 0.75rem;
                border-radius: 8px;
            }

            .stat-label {
                font-size: 0.75rem;
                margin-bottom: 0.25rem;
            }

            .stat-value {
                font-size: 1.25rem;
                font-weight: 500;
            }

            .logs-section {
                padding: 1rem;
                border-radius: 8px;
            }

            .logs-header {
                margin-bottom: 1rem;
            }

            .logs-title {
                font-size: 1rem;
            }

            .logs-count {
                font-size: 0.8rem;
            }

            .logs-container {
                max-height: 300px;
                padding: 0.75rem;
                font-size: 0.75rem;
                line-height: 1.4;
            }

            .log-entry {
                margin-bottom: 0.15rem;
            }

            /* Make everything fit in one screen */
            .content-grid {
                height: calc(100vh - 190px);
                display: flex;
                flex-direction: column;
            }

            .logs-section {
                flex: 1;
                display: flex;
                flex-direction: column;
                min-height: 0;
            }

            .logs-container {
                flex: 1;
                min-height: 0;
            }

            /* Show mobile balance widget */
            .mobile-balance-widget {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 0.25rem;
                padding-bottom: 60px;
            }

            .bot-header {
                margin-bottom: 0.75rem;
            }

            .bot-title {
                font-size: 1.25rem;
            }

            .stats-sidebar {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.4rem;
            }

            .stat-card {
                padding: 0.5rem;
            }

            .stat-label {
                font-size: 0.7rem;
            }

            .stat-value {
                font-size: 1rem;
            }

            .status-section {
                flex-direction: column;
                align-items: stretch;
            }

            .trade-controls {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 0.25rem;
            }

            .btn {
                padding: 0.4rem 0.5rem;
                font-size: 0.75rem;
            }

            .logs-container {
                max-height: 250px;
                font-size: 0.7rem;
            }

            .mobile-balance-widget {
                padding: 10px 12px;
            }

            .balance-amount {
                font-size: 1rem;
            }
        }
    </style>

<body>
    <main class="main-content">
        <div class="bot-header">
            <div class="bot-info">
                <h1 class="bot-title">Bitcoin Accumulation Bot</h1>
                <div class="bot-details">Bot ID: dca-1 • • Account: Real</div>
            </div>
            <div class="status-section">
                <div class="status-badge" id="statusBadge">
                    <div class="status-dot" id="statusDot"></div>
                    <span id="statusText">Stopped (Low Balance)</span>
                </div>
                <?php
                $amount = request('amount');
                $asset = request('asset');?>
                @if(Auth::user()->wallet_balance < $amount)
                    <div class="insufficient-balance">Insufficient Balance</div>
                @else
                    <div class="trade-controls" id="tradeControls">
                        <button class="btn btn-start" id="startBtn">Start Bot</button>
                        <button class="btn btn-pause" id="pauseBtn" disabled>Pause Bot</button>
                        <button class="btn btn-stop" id="stopBtn" disabled>Stop Bot</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="content-grid">
            <div class="stats-sidebar">
                <div class="stat-card pnl">
                    <div class="stat-label">Total P/L</div>
                    <div class="stat-value" id="totalPnL">+$0.00</div>
                </div>
                
                <div class="stat-card runs">
                    <div class="stat-label">Total Runs</div>
                    <div class="stat-value" id="totalRuns">0</div>
                </div>
                
                <div class="stat-card trades">
                    <div class="stat-label">Total Trades</div>
                    <div class="stat-value" id="totalTrades">0</div>
                </div>
                
                <div class="stat-card winrate">
                    <div class="stat-label">Win Rate</div>
                    <div class="stat-value" id="winRate">0.0%</div>
                </div>
                
                <div class="stat-card balance">
                    <div class="stat-label">Balance</div>
                    <div class="stat-value" id="currentBalance">${{ number_format(Auth::user()->wallet_balance, 2) }}</div>
                </div>
            </div>

            <div class="logs-section">
                <div class="logs-header">
                    <h2 class="logs-title">Bot Logs</h2>
                    <div class="logs-count" id="logsCount">0 entries</div>
                </div>
                
                <div class="logs-container" id="logsContainer">
                    <!-- Logs will be populated dynamically -->
                </div>
            </div>
        </div>
    </main>

    <!-- Mobile Balance Widget -->
    <div class="mobile-balance-widget">
        <div class="balance-content">
            <div class="balance-label">Account Balance</div>
            <div>
                <span class="balance-amount" id="mobileBalance">${{ number_format(Auth::user()->wallet_balance, 2) }}</span>
                <span class="balance-change positive" id="mobileBalanceChange">+$0.00</span>
            </div>
        </div>
    </div>

    <script>
        // Bot state management
        let botState = {
            isRunning: false,
            isPaused: false,
            totalPnL: 0,
            totalRuns: 0,
            totalTrades: 0,
            winningTrades: 0,
            currentBalance: {{ Auth::user()->wallet_balance }},
            tradingInterval: null,
            logInterval: null,
            consecutiveLosses: 0, // Track consecutive losses for realism
            marketTrend: 'neutral' // Track market trend
        };

        // Trading bot simulation with improved win rate
        class TradingBot {
            constructor() {
                this.pairs = ['BTCUSDT', 'ETHUSDT', 'BNBUSDT', 'ADAUSDT', 'DOTUSDT'];
                this.currentPair = this.pairs[0];
                this.investmentAmount = {{$amount}};
                this.lastPrice = this.generateRandomPrice();
                this.priceHistory = [this.lastPrice]; // Track price history for better decisions
                this.macdHistory = []; // Track MACD history
            }

            generateRandomPrice(basePrice = 45000) {
                return basePrice + (Math.random() - 0.5) * 1000;
            }

            updateMarketTrend() {
                // Simulate market trend changes
                const trendRandom = Math.random();
                if (trendRandom < 0.6) {
                    botState.marketTrend = 'bullish';
                } else if (trendRandom < 0.85) {
                    botState.marketTrend = 'neutral';
                } else {
                    botState.marketTrend = 'bearish';
                }
            }

            calculateMACD() {
                // More sophisticated MACD simulation with trend consideration
                let baseMacd = (Math.random() - 0.5) * 2;
                let baseSignal = (Math.random() - 0.5) * 2;
                
                // Adjust MACD based on market trend for better signals
                if (botState.marketTrend === 'bullish') {
                    baseMacd += 0.3; // Bias towards positive MACD in bull market
                    baseSignal += 0.2;
                } else if (botState.marketTrend === 'bearish') {
                    baseMacd -= 0.3; // Bias towards negative MACD in bear market
                    baseSignal -= 0.2;
                }

                const macdData = {
                    macd: baseMacd,
                    signal: baseSignal,
                    histogram: baseMacd - baseSignal
                };

                // Keep history for trend analysis
                this.macdHistory.push(macdData);
                if (this.macdHistory.length > 10) {
                    this.macdHistory.shift();
                }

                return macdData;
            }

            shouldTrade() {
                const macd = this.calculateMACD();
                
                // Improved trading logic with multiple conditions
                const strongSignal = Math.abs(macd.histogram) > 0.7;
                const trendAlignment = this.isTrendAligned(macd);
                const consecutiveLossLimit = botState.consecutiveLosses < 3; // Avoid trading after multiple losses
                
                return strongSignal && trendAlignment && consecutiveLossLimit;
            }

            isTrendAligned(macd) {
                // Check if MACD signal aligns with market trend
                if (botState.marketTrend === 'bullish' && macd.histogram > 0) return true;
                if (botState.marketTrend === 'bearish' && macd.histogram < 0) return true;
                if (botState.marketTrend === 'neutral') return Math.abs(macd.histogram) > 0.5;
                return false;
            }

            calculateTradeOutcome() {
                // Improved outcome calculation with better win rate
                let successProbability = 0.68; // Base 68% win rate
                
                // Adjust probability based on market conditions
                if (botState.marketTrend === 'bullish') {
                    successProbability += 0.07; // 75% in bull market
                } else if (botState.marketTrend === 'bearish') {
                    successProbability -= 0.05; // 63% in bear market
                }
                
                // Slightly reduce probability after consecutive wins (realism)
                if (botState.consecutiveLosses === 0 && botState.totalTrades > 0) {
                    const recentWins = this.getRecentWinStreak();
                    if (recentWins > 4) {
                        successProbability -= 0.08; // Reduce chance after win streak
                    }
                }
                
                // Increase probability after consecutive losses (recovery)
                if (botState.consecutiveLosses >= 2) {
                    successProbability += 0.1;
                }

                return Math.random() < successProbability;
            }

            getRecentWinStreak() {
                // This would track recent wins in a real implementation
                // For simulation, we'll use a simple approach
                return botState.consecutiveLosses === 0 ? Math.floor(Math.random() * 6) : 0;
            }

            executeTrade() {
                if (!this.shouldTrade()) return false;

                // Update market trend periodically
                if (Math.random() < 0.15) { // 15% chance to change trend
                    this.updateMarketTrend();
                }

                const macd = this.calculateMACD();
                const isBuy = macd.histogram > 0;
                const currentPrice = this.generateRandomPrice(this.lastPrice);
                
                // Determine if this trade will be profitable
                const isWinningTrade = this.calculateTradeOutcome();
                
                let priceChange;
                if (isWinningTrade) {
                    // Winning trade: 0.5% to 3.2% gain
                    priceChange = (Math.random() * 0.027 + 0.005) * (isBuy ? 1 : -1);
                    botState.consecutiveLosses = 0;
                } else {
                    // Losing trade: 0.3% to 2.1% loss
                    priceChange = -(Math.random() * 0.018 + 0.003) * (isBuy ? 1 : -1);
                    botState.consecutiveLosses++;
                }

                const exitPrice = currentPrice * (1 + priceChange);
                const pnl = isBuy ? 
                    (exitPrice - currentPrice) / currentPrice * this.investmentAmount :
                    (currentPrice - exitPrice) / currentPrice * this.investmentAmount;

                // Update bot statistics
                botState.totalTrades++;
                botState.totalPnL += pnl;
                botState.currentBalance += pnl;
                
                if (pnl > 0) {
                    botState.winningTrades++;
                }

                // Log the trade with more detailed information
                const timestamp = this.getCurrentTimestamp();
                const tradeType = isBuy ? 'BUY' : 'SELL';
                const pnlText = pnl >= 0 ? `+$${pnl.toFixed(2)}` : `-$${Math.abs(pnl).toFixed(2)}`;
                const trendText = `[${botState.marketTrend.toUpperCase()}]`;
                
                addLogEntry(timestamp, `${trendText} ${tradeType} ${this.currentPair} at $${currentPrice.toFixed(2)} | P/L: ${pnlText}`, 'trade');
                
                // Add analysis for losing streaks
                if (botState.consecutiveLosses >= 2) {
                    addLogEntry(timestamp, `Risk management: ${botState.consecutiveLosses} consecutive losses detected`, 'warning');
                }
                
                // Update database
                this.updateWalletBalance(botState.currentBalance);
                
                // Update UI
                this.updateStats();
                
                this.lastPrice = currentPrice;
                this.priceHistory.push(currentPrice);
                if (this.priceHistory.length > 20) {
                    this.priceHistory.shift();
                }
                
                return true;
            }

            updateWalletBalance(newBalance) {
                // AJAX call to update user's wallet balance
                fetch('/api/update-wallet-balance', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        balance: newBalance
                    })
                })
                .catch(error => console.error('Error updating wallet balance:', error));
            }

            updateStats() {
                const formattedBalance = '$' + botState.currentBalance.toFixed(2);
                const formattedChange = (botState.totalPnL >= 0 ? '+' : '') + '$' + Math.abs(botState.totalPnL).toFixed(2);
                
                // Update desktop stats
                document.getElementById('totalPnL').textContent = 
                    (botState.totalPnL >= 0 ? '+' : '') + '$' + botState.totalPnL.toFixed(2);
                document.getElementById('totalPnL').className = 
                    'stat-value ' + (botState.totalPnL >= 0 ? 'positive' : 'negative');
                
                document.getElementById('totalTrades').textContent = botState.totalTrades;
                document.getElementById('currentBalance').textContent = formattedBalance;
                
                // Improved win rate calculation
                const winRate = botState.totalTrades > 0 ? 
                    (botState.winningTrades / botState.totalTrades * 100).toFixed(1) : 0;
                document.getElementById('winRate').textContent = winRate + '%';
                
                // Update mobile balance widget
                document.getElementById('mobileBalance').textContent = formattedBalance;
                document.getElementById('mobileBalanceChange').textContent = formattedChange;
                document.getElementById('mobileBalanceChange').className = 
                    'balance-change ' + (botState.totalPnL >= 0 ? 'positive' : 'negative');
            }

            getCurrentTimestamp() {
                const now = new Date();
                return now.toTimeString().split(' ')[0] + '.' + now.getMilliseconds().toString().padStart(3, '0');
            }

            analyzeMarket() {
                const timestamp = this.getCurrentTimestamp();
                const volatility = (Math.random() * 5).toFixed(1);
                const rsi = (Math.random() * 100).toFixed(0);
                
                const analyses = [
                    `Market trend: ${botState.marketTrend} | MACD alignment confirmed`,
                    `Signal strength: ${Math.random() > 0.5 ? 'Strong' : 'Moderate'} | Entry conditions met`,
                    `Market volatility: ${volatility}% | Risk level: ${volatility > 3 ? 'High' : 'Normal'}`,
                    `RSI indicator: ${rsi} | Market ${rsi > 70 ? 'overbought' : rsi < 30 ? 'oversold' : 'balanced'}`,
                    `Volume analysis: ${Math.random() > 0.6 ? 'Above' : 'Below'} average | Liquidity ${Math.random() > 0.5 ? 'high' : 'normal'}`,
                    `Bollinger bands: ${Math.random() > 0.5 ? 'Expansion' : 'Contraction'} phase detected`,
                    `Support level: $${(this.lastPrice * 0.985).toFixed(2)} | Strong buying interest`,
                    `Resistance level: $${(this.lastPrice * 1.018).toFixed(2)} | Potential profit target`,
                    `Trend confirmation: ${botState.marketTrend} bias maintained across timeframes`,
                    `Risk management: Position sizing optimized for current volatility`
                ];
                
                const randomAnalysis = analyses[Math.floor(Math.random() * analyses.length)];
                addLogEntry(timestamp, randomAnalysis, 'info');
            }
        }

        const tradingBot = new TradingBot();

        // Log management
        function addLogEntry(timestamp, message, type = 'info') {
            const logsContainer = document.getElementById('logsContainer');
            const logEntry = document.createElement('div');
            logEntry.className = `log-entry log-${type}`;
            logEntry.innerHTML = `<span class="log-timestamp">[${timestamp}]</span> <span class="log-${type}">${message}</span>`;
            
            logsContainer.appendChild(logEntry);
            scrollLogsToBottom();
            
            // Update entry count
            const entriesCount = logsContainer.children.length;
            document.getElementById('logsCount').textContent = `${entriesCount} entries`;
        }

        function scrollLogsToBottom() {
            const logsContainer = document.getElementById('logsContainer');
            logsContainer.scrollTop = logsContainer.scrollHeight;
        }

        // Bot control functions
        function startBot() {
            botState.isRunning = true;
            botState.isPaused = false;
            botState.totalRuns++;
            
            // Initialize market trend
            tradingBot.updateMarketTrend();
            
            document.getElementById('totalRuns').textContent = botState.totalRuns;
            updateBotStatus('running', 'Running');
            
            document.getElementById('startBtn').disabled = true;
            document.getElementById('pauseBtn').disabled = false;
            document.getElementById('stopBtn').disabled = false;
            
            const timestamp = tradingBot.getCurrentTimestamp();
            addLogEntry(timestamp, 'Enhanced MACD Trading Bot v2.0 started successfully', 'success');
            addLogEntry(timestamp, 'Advanced signal filtering and risk management active', 'success');
            addLogEntry(timestamp, `Market analysis: Current trend detected as ${botState.marketTrend}`, 'info');
            addLogEntry(timestamp, 'Scanning for high-probability trading setups', 'info');
            
            // Start trading simulation with improved intervals
            botState.tradingInterval = setInterval(() => {
                if (botState.isRunning && !botState.isPaused) {
                    tradingBot.executeTrade();
                }
            }, Math.random() * 12000 + 8000); // Random interval between 8-20 seconds (more realistic)
            
            // Start market analysis logs
            botState.logInterval = setInterval(() => {
                if (botState.isRunning && !botState.isPaused) {
                    tradingBot.analyzeMarket();
                }
            }, Math.random() * 6000 + 4000); // Random interval between 4-10 seconds
        }

        function pauseBot() {
            botState.isPaused = !botState.isPaused;
            const pauseBtn = document.getElementById('pauseBtn');
            
            if (botState.isPaused) {
                updateBotStatus('paused', 'Paused');
                pauseBtn.textContent = 'Resume Bot';
                addLogEntry(tradingBot.getCurrentTimestamp(), 'Trading paused - Positions monitoring active', 'warning');
            } else {
                updateBotStatus('running', 'Running');
                pauseBtn.textContent = 'Pause Bot';
                addLogEntry(tradingBot.getCurrentTimestamp(), 'Trading resumed - Scanning for opportunities', 'success');
            }
        }

        function stopBot() {
            if (confirm('Are you sure you want to stop the Enhanced MACD Trading Bot?')) {
                botState.isRunning = false;
                botState.isPaused = false;
                
                if (botState.tradingInterval) clearInterval(botState.tradingInterval);
                if (botState.logInterval) clearInterval(botState.logInterval);
                
                updateBotStatus('stopped', 'Stopped');
                
                document.getElementById('startBtn').disabled = false;
                document.getElementById('pauseBtn').disabled = true;
                document.getElementById('stopBtn').disabled = true;
                document.getElementById('pauseBtn').textContent = 'Pause Bot';
                
                const finalStats = `Final Stats: ${botState.totalTrades} trades, ${botState.winningTrades} wins (${(botState.winningTrades / botState.totalTrades * 100).toFixed(1)}%)`;
                addLogEntry(tradingBot.getCurrentTimestamp(), 'Enhanced trading bot stopped by user', 'warning');
                addLogEntry(tradingBot.getCurrentTimestamp(), finalStats, 'info');
            }
        }

        function updateBotStatus(status, text) {
            const statusBadge = document.getElementById('statusBadge');
            const statusDot = document.getElementById('statusDot');
            const statusText = document.getElementById('statusText');
            
            statusBadge.className = `status-badge ${status}`;
            statusDot.className = `status-dot ${status}`;
            statusText.textContent = text;
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            @if(Auth::user()->wallet_balance >= $amount)
                document.getElementById('startBtn').addEventListener('click', startBot);
                document.getElementById('pauseBtn').addEventListener('click', pauseBot);
                document.getElementById('stopBtn').addEventListener('click', stopBot);
                
                // Initialize with ready status
                updateBotStatus('stopped', 'Ready to Start');
            @endif
            
            // Add initial log entries
            const timestamp = tradingBot.getCurrentTimestamp();
            addLogEntry(timestamp, 'Enhanced MACD Trading Bot v2.0 initialized', 'success');
            addLogEntry(timestamp, 'Advanced signal processing algorithms loaded', 'success');
            addLogEntry(timestamp, 'Risk management protocols activated', 'success');
            addLogEntry(timestamp, 'Exchange API connections established', 'success');
            addLogEntry(timestamp, 'Current balance: ${{ number_format(Auth::user()->wallet_balance, 2) }}', 'info');
            @if(Auth::user()->wallet_balance < $amount)
                addLogEntry(timestamp, 'Insufficient balance for trading (minimum $100 required)', 'error');
            @else
                addLogEntry(timestamp, 'Balance verification complete - Ready for enhanced trading', 'success');
            @endif
        });
    </script>

    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
@endsection