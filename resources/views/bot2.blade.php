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

        .main-content {
            padding: 30px;
            max-width: 1400px;
            margin: 0 auto;
        }

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

        .dashboard-layout {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .dashboard-main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
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
            text-decoration: none;
            text-align: center;
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
            text-decoration: none;
            text-align: center;
        }

        .btn-primary:hover {
            background: #22c55e;
        }

        .btn-primary:disabled {
            background: #6b7280;
            color: #9ca3af;
            cursor: not-allowed;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            backdrop-filter: blur(4px);
        }

        .modal-overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal {
            background: #1a1a20;
            border-radius: 16px;
            padding: 32px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            border: 1px solid #2a2a30;
            animation: slideUp 0.3s ease;
            position: relative;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #2a2a30;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #4ade80;
        }

        .close-btn {
            background: none;
            border: none;
            color: #888;
            font-size: 24px;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .close-btn:hover {
            background: #374151;
            color: white;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #e5e7eb;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px;
            background: #0f1419;
            border: 1px solid #374151;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #4ade80;
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.1);
        }

        .form-select option {
            background: #1a1a20;
            color: white;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid #2a2a30;
        }

        .btn-cancel {
            background: #374151;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #4b5563;
        }

        .btn-start {
            background: #4ade80;
            color: #000;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
        }

        .btn-start:hover {
            background: #22c55e;
        }

        .btn-start:disabled {
            background: #6b7280;
            color: #9ca3af;
            cursor: not-allowed;
        }

        .investment-info {
            background: #0f1419;
            border-radius: 8px;
            padding: 12px;
            margin-top: 8px;
            border-left: 3px solid #4ade80;
        }

        .investment-info-label {
            color: #9ca3af;
            font-size: 12px;
            margin-bottom: 4px;
        }

        .investment-info-value {
            color: #4ade80;
            font-weight: 600;
            font-size: 14px;
        }

        .success-message {
            display: none;
            background: #065f46;
            border: 1px solid #10b981;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            color: #d1fae5;
        }

        .success-message.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .error-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #dc2626;
            color: white;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.3);
            z-index: 10000;
            max-width: 400px;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        
        .loading {
            position: relative;
            pointer-events: none;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

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

            .modal {
                padding: 24px;
                margin: 20px;
            }
        }
    </style>

<body>
    <!-- Main Content -->
   <div class="success-message" id="successMessage">
        <strong>Bot Started Successfully!</strong> Your trading bot configuration has been saved and is now active.
    </div>

    <main class="main-content">
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-left">
                    <h1 class="hero-title">Automated Trading</h1>
                    <p class="hero-subtitle">Create and manage algorithmic trading strategies</p>
                    <div class="hero-stats">
                        <div class="stat">
                            <div class="stat-number" id="totalBots">4</div>
                            <div class="stat-label">Total Bots</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number" id="activeBots">2</div>
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

        <div class="dashboard-layout">
            <div class="dashboard-main">
                <div class="section-header">
                    <div>
                        <h2 class="section-title">Dollar-Cost Averaging Bots</h2>
                        <p class="section-subtitle">Regular purchases of assets regardless of price</p>
                    </div>
                    <button class="create-dca-btn">Create DCA Bot</button>
                </div>

                <div class="bot-grid">
                    <div class="bot-card" data-bot-id="bitcoin-accumulation">
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
                            <button class="btn-primary bot-start-btn" data-bot-type="bitcoin-accumulation">Start BA Bot</button>
                        </div>
                    </div>

                    <div class="bot-card" data-bot-id="eth-dca-pro">
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
                            <button class="btn-primary bot-start-btn" data-bot-type="eth-dca-pro">Start DCA Pro</button>
                        </div>
                    </div>

                    <div class="bot-card" data-bot-id="multi-coin-dca">
                        <div class="bot-header">
                            <div>
                                <h3 class="bot-title">Multi-Coin DCA</h3>
                                <div class="bot-frequency">Monthly • DCA</div>
                            </div>
                            <span class="bot-status status-inactive">Inactive</span>
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
                            <button class="btn-primary" disabled>Start Bot</button>
                        </div>
                    </div>

                    <div class="bot-card" data-bot-id="cycle-based">
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
                            <button class="btn-primary" disabled>Start Bot</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal-overlay" id="botModal">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Configure Trading Bot</h2>
                <button class="close-btn" id="closeModalBtn">&times;</button>
            </div>
            
            <form id="botConfigForm">
                <div class="form-group">
                    <label class="form-label">Select Asset</label>
                    <select class="form-select" id="assetSelect" required>
                        <option value="">Choose an asset...</option>
                        <option value="BTCUSDT">Bitcoin (BTC)</option>
                        <option value="ETHUSDT">Ethereum (ETH)</option>
                        <option value="BNBUSDT">Binance Coin (BNB)</option>
                        <option value="ADAUSDT">Cardano (ADA)</option>
                        <option value="SOLUSDT">Solana (SOL)</option>
                        <option value="DOTUSDT">Polkadot (DOT)</option>
                        <option value="MATICUSDT">Polygon (MATIC)</option>
                        <option value="LINKUSDT">Chainlink (LINK)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Investment Amount per Trade (USD)</label>
                    <input type="number" class="form-input" id="investmentAmount" min="10" max="10000" step="10" placeholder="100" required>
                    <div class="investment-info">
                        <div class="investment-info-label">Minimum: $10 • Maximum: $10,000</div>
                        <div class="investment-info-value">Enter the amount you want to invest per trade</div>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn-start" id="submitBtn">Start Trading Bot</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentBotType = '';
        let botConfigurations = {};
        let performanceSimulationStarted = false;
        let autoSaveTimeout;

        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
            addCardHoverEffects();
        });

        function initializeEventListeners() {
            console.log('Initializing event listeners...');
            
            const startButtons = document.querySelectorAll('.bot-start-btn');
            console.log('Found start buttons:', startButtons.length);
            
            startButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const botType = this.getAttribute('data-bot-type');
                    console.log('Start button clicked for bot type:', botType);
                    openBotModal(botType);
                });
            });

            // Modal close event listeners
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const botConfigForm = document.getElementById('botConfigForm');
            
            console.log('Form element found:', !!botConfigForm);
            
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeBotModal);
                console.log('Close modal button listener attached');
            }
            
            if (cancelBtn) {
                cancelBtn.addEventListener('click', closeBotModal);
                console.log('Cancel button listener attached');
            }
            
            // Form submission handler - Multiple approaches for reliability
            if (botConfigForm) {
                console.log('Attaching form submission listener...');
                
                // Method 1: Standard form submit event
                botConfigForm.addEventListener('submit', function(e) {
                    console.log('Form submission event triggered via addEventListener');
                    handleFormSubmission(e);
                });
                
                // Method 2: Also attach to submit button click as backup
                const submitBtn = document.getElementById('submitBtn');
                if (submitBtn) {
                    console.log('Submit button found, attaching click listener as backup');
                    submitBtn.addEventListener('click', function(e) {
                        console.log('Submit button clicked directly');
                        // Check if this is inside a form
                        const form = this.closest('form');
                        if (form) {
                            console.log('Submit button is inside form, preventing default and handling manually');
                            e.preventDefault();
                            handleFormSubmission(e);
                        }
                    });
                }
                
                console.log('Form submission listeners attached successfully');
            } else {
                console.error('botConfigForm not found!');
            }

            // Modal click outside to close
            const botModal = document.getElementById('botModal');
            if (botModal) {
                botModal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeBotModal();
                    }
                });
            }

            // Keyboard event handlers
            document.addEventListener('keydown', function(e) {
                const modal = document.getElementById('botModal');
                
                if (e.key === 'Escape' && modal && modal.classList.contains('active')) {
                    closeBotModal();
                }
                
                if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                    if (modal && modal.classList.contains('active')) {
                        e.preventDefault();
                        const form = document.getElementById('botConfigForm');
                        if (form) {
                            console.log('Ctrl+Enter pressed, submitting form');
                            const submitEvent = new Event('submit', { bubbles: true, cancelable: true });
                            form.dispatchEvent(submitEvent);
                        }
                    }
                }
            });

            // Auto-save handlers
            const inputs = document.querySelectorAll('#botConfigForm input, #botConfigForm select');
            inputs.forEach(input => {
                input.addEventListener('input', autoSaveFormData);
                input.addEventListener('change', autoSaveFormData);
            });
        }

        function openBotModal(botType) {
            console.log('Opening modal for bot type:', botType);
            currentBotType = botType;
            const modal = document.getElementById('botModal');
            const title = document.getElementById('modalTitle');
            
            if (!modal) {
                console.error('Modal element not found');
                return;
            }
            
            if (title) {
                if (botType === 'bitcoin-accumulation') {
                    title.textContent = 'Configure Bitcoin Accumulation Bot';
                    const assetSelect = document.getElementById('assetSelect');
                    if (assetSelect) assetSelect.value = 'BTCUSDT';
                } else if (botType === 'eth-dca-pro') {
                    title.textContent = 'Configure ETH DCA Pro Bot';
                    const assetSelect = document.getElementById('assetSelect');
                    if (assetSelect) assetSelect.value = 'ETHUSDT';
                }
            }
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Re-attach form listener after modal opens (in case of dynamic content)
            setTimeout(() => {
                const form = document.getElementById('botConfigForm');
                console.log('Modal opened, form element check:', !!form);
                
                if (form) {
                    // Remove any existing listeners to avoid duplicates
                    const newForm = form.cloneNode(true);
                    form.parentNode.replaceChild(newForm, form);
                    
                    // Re-attach the listener
                    newForm.addEventListener('submit', function(e) {
                        console.log('Form submission event triggered (re-attached)');
                        handleFormSubmission(e);
                    });
                    
                    // Also re-attach submit button listener
                    const submitBtn = newForm.querySelector('#submitBtn');
                    if (submitBtn) {
                        submitBtn.addEventListener('click', function(e) {
                            console.log('Submit button clicked (re-attached)');
                            if (e.target.type === 'submit') {
                                e.preventDefault();
                                handleFormSubmission(e);
                            }
                        });
                    }
                }
                
                restoreFormData();
            }, 100);
        }

        function closeBotModal() {
            const modal = document.getElementById('botModal');
            if (modal) {
                modal.classList.remove('active');
            }
            document.body.style.overflow = 'auto';
            resetForm();
        }

        function resetForm() {
            const form = document.getElementById('botConfigForm');
            if (form) {
                form.reset();
            }
            currentBotType = '';
        }

        function handleFormSubmission(e) {
            console.log("=== FORM SUBMISSION HANDLER CALLED ===");
            console.log("Event type:", e.type);
            console.log("Event target:", e.target);
            console.log("Current bot type:", currentBotType);
            
            e.preventDefault();
            
            // Validate form before proceeding
            if (!validateForm()) {
                console.log("Form validation failed");
                return;
            }
            
            const assetSelect = document.getElementById('assetSelect');
            const investmentAmount = document.getElementById('investmentAmount');
            
            console.log("Asset selected:", assetSelect ? assetSelect.value : 'NULL');
            console.log("Investment amount:", investmentAmount ? investmentAmount.value : 'NULL');
            
            const formData = {
                botType: currentBotType,
                asset: assetSelect ? assetSelect.value : '',
                investmentAmount: investmentAmount ? parseFloat(investmentAmount.value) : 0,
                timestamp: new Date().toISOString(),
                status: 'active'
            };
            
            console.log('Form data prepared:', formData);
            
            botConfigurations[currentBotType] = formData;
            
            const submitBtn = document.getElementById('submitBtn');

            if (submitBtn) {
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Starting Bot...';
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');

                console.log("Starting Bot...");
                
                setTimeout(() => {
                    updateBotStatus(currentBotType, 'active');
                    showSuccessMessage(`${getBotDisplayName(currentBotType)} has been started successfully!`);
                    
                    // Determine bot page ID based on bot type
                    let botPageId = '';
                    switch(currentBotType) {
                        case 'bitcoin-accumulation':
                            botPageId = 'bt-1';
                            break;
                        case 'eth-dca-pro':
                            botPageId = 'bt-2';
                            break;
                        case 'multi-coin-dca':
                            botPageId = 'bt-3';
                            break;
                        case 'cycle-based':
                            botPageId = 'bt-4';
                            break;
                        default:
                            botPageId = 'bt-1';
                    }
                    
                    // Redirect to the specific bot page with amount parameter
                    const redirectUrl = `/${botPageId}?amount=${formData.investmentAmount}&asset=${formData.asset}`;
                    console.log('Redirecting to:', redirectUrl);
                    
                    // Close modal first, then redirect
                    closeBotModal();
                    
                    // Add a small delay to show success message before redirect
                    setTimeout(() => {
                        window.location.href = redirectUrl;
                    }, 1000);
                    
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('loading');
                    
                    updateDashboardStats();
                    
                    if (!performanceSimulationStarted) {
                        startPerformanceSimulation();
                        performanceSimulationStarted = true;
                    }
                    
                    console.log('Bot Configuration Saved:', formData);
                    console.log('Redirecting to bot page:', botPageId);
                    
                }, 1500);
            } else {
                console.error('Submit button not found!');
            }
        }

        function validateForm() {
            const assetSelect = document.getElementById('assetSelect');
            const investmentAmount = document.getElementById('investmentAmount');
            
            const asset = assetSelect ? assetSelect.value : '';
            const amount = investmentAmount ? investmentAmount.value : '';
            
            if (!asset) {
                showError('Please select an asset');
                return false;
            }
            
            if (!amount || amount < 10 || amount > 10000) {
                showError('Please enter a valid investment amount between $10 and $10,000');
                return false;
            }
            
            return true;
        }

        function updateBotStatus(botType, status) {
            const botCard = document.querySelector(`[data-bot-id="${botType}"]`);
            if (botCard) {
                const statusElement = botCard.querySelector('.bot-status');
                const startButton = botCard.querySelector('.bot-start-btn');
                
                if (status === 'active') {
                    if (statusElement) {
                        statusElement.textContent = 'Active';
                        statusElement.className = 'bot-status status-active';
                    }
                    if (startButton) {
                        startButton.textContent = 'Running';
                        startButton.disabled = true;
                        startButton.classList.add('pulse');
                    }
                }
            }
        }

        function getBotDisplayName(botType) {
            const names = {
                'bitcoin-accumulation': 'Bitcoin Accumulation Bot',
                'eth-dca-pro': 'ETH DCA Pro Bot'
            };
            return names[botType] || 'Trading Bot';
        }

        function showSuccessMessage(message) {
            const successDiv = document.getElementById('successMessage');
            if (successDiv) {
                successDiv.innerHTML = `<strong>Success!</strong> ${message}`;
                successDiv.classList.add('show');
                
                setTimeout(() => {
                    successDiv.classList.remove('show');
                }, 5000);
            }
        }

        function showError(message, duration = 5000) {
            console.error('Error:', message);
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message';
            errorDiv.innerHTML = `<strong>Error:</strong> ${message}`;
            errorDiv.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #ef4444;
                color: white;
                padding: 12px 16px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                z-index: 10000;
                animation: slideInRight 0.3s ease;
            `;
            
            document.body.appendChild(errorDiv);
            
            setTimeout(() => {
                errorDiv.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    if (errorDiv.parentNode) {
                        errorDiv.parentNode.removeChild(errorDiv);
                    }
                }, 300);
            }, duration);
        }

        function updateDashboardStats() {
            const activeBots = Object.keys(botConfigurations).length;
            const activeBotElement = document.getElementById('activeBots');
            if (activeBotElement) {
                activeBotElement.textContent = activeBots;
            }
        }

        function addCardHoverEffects() {
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
        }

        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(amount);
        }

        function calculateROI(initialInvestment, currentValue) {
            if (initialInvestment === 0) return 0;
            return ((currentValue - initialInvestment) / initialInvestment * 100).toFixed(2);
        }

        function startPerformanceSimulation() {
            setInterval(() => {
                Object.keys(botConfigurations).forEach(botType => {
                    const botCard = document.querySelector(`[data-bot-id="${botType}"]`);
                    if (botCard) {
                        const performanceElement = botCard.querySelector('.metric-value.positive');
                        if (performanceElement) {
                            const currentPerf = parseFloat(performanceElement.textContent.replace('%', ''));
                            const change = (Math.random() - 0.5) * 0.2;
                            const newPerf = Math.max(0, currentPerf + change);
                            performanceElement.textContent = `+${newPerf.toFixed(1)}%`;
                        }
                    }
                });
            }, 30000);
        }

        function autoSaveFormData() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                const assetSelect = document.getElementById('assetSelect');
                const investmentAmount = document.getElementById('investmentAmount');
                
                const formData = {
                    asset: assetSelect ? assetSelect.value : '',
                    investmentAmount: investmentAmount ? investmentAmount.value : ''
                };
                
                window.tempFormData = formData;
            }, 1000);
        }

        function restoreFormData() {
            if (window.tempFormData) {
                const data = window.tempFormData;
                
                const assetSelect = document.getElementById('assetSelect');
                const investmentAmount = document.getElementById('investmentAmount');
                
                if (data.asset && assetSelect) assetSelect.value = data.asset;
                if (data.investmentAmount && investmentAmount) investmentAmount.value = data.investmentAmount;
            }
        }

        function getBotConfiguration(botType) {
            return botConfigurations[botType] || null;
        }

        function getAllBotConfigurations() {
            return botConfigurations;
        }

        function sendConfigurationToBackend(formData) {
            // For Laravel integration:
            /*
            fetch('/api/bot-configuration', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Configuration saved to backend:', data);
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Failed to save configuration to server');
            });
            */
        }

        // Global API
        window.TradingBotDashboard = {
            openModal: openBotModal,
            closeModal: closeBotModal,
            getBotConfig: getBotConfiguration,
            getAllConfigs: getAllBotConfigurations,
            showSuccess: showSuccessMessage,
            showError: showError,
            formatCurrency: formatCurrency,
            calculateROI: calculateROI
        };

        console.log('Trading Bot Dashboard script loaded successfully');
    </script>
    </body>
@endsection