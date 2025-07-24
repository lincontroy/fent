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
        padding: 3rem 2rem;
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .main-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .main-subtitle {
        color: #9ca3af;
        font-size: 1.1rem;
        margin-bottom: 3rem;
    }

    .deposit-form {
        background: #1a2332;
        border-radius: 20px;
        padding: 2.5rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .method-tabs {
        display: flex;
        background: #0f1419;
        border-radius: 12px;
        padding: 0.5rem;
        margin-bottom: 2rem;
    }

    .method-tab {
        flex: 1;
        padding: 0.75rem 1.5rem;
        border: none;
        background: transparent;
        color: #9ca3af;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 500;
    }

    .method-tab.active {
        background: #4f46e5;
        color: white;
    }

    .method-tab:not(.active):hover {
        background: #374151;
        color: white;
    }

    .crypto-options {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .crypto-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem 1rem;
        background: #0f1419;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        border: 2px solid transparent;
    }

    .crypto-option:hover {
        background: #374151;
    }

    .crypto-option.selected {
        border-color: #4f46e5;
        background: #1e1b4b;
    }

    .crypto-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .crypto-icon.bitcoin {
        background: #f7931a;
        color: white;
    }

    .crypto-icon.ethereum {
        background: #627eea;
        color: white;
    }

    .crypto-icon.solana {
        background: #000;
        color: white;
    }

    .crypto-icon.ripple {
        background: #23292f;
        color: #00d4aa;
    }

    .crypto-icon.binance {
        background: #f3ba2f;
        color: #000;
    }

    .crypto-name {
        font-size: 0.9rem;
        font-weight: 500;
    }

    .amount-section {
        margin-bottom: 2rem;
    }

    .amount-label {
        text-align: left;
        font-size: 0.9rem;
        color: #9ca3af;
        margin-bottom: 0.5rem;
    }

    .amount-input {
        width: 100%;
        padding: 1rem 1.5rem;
        background: #374151;
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 1.1rem;
        outline: none;
    }

    .amount-input:focus {
        background: #4b5563;
    }

    .deposit-preview {
        background: linear-gradient(135deg, #1e3a8a, #3730a3);
        border-radius: 16px;
        padding: 2rem;
        margin-top: 2rem;
        text-align: center;
    }

    .preview-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #f7931a;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .preview-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .continue-btn {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #4ade80;
        border: none;
        color: #0a0f1c;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all 0.2s;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .continue-btn:hover {
        transform: scale(1.05);
    }

    .card-details {
        margin-bottom: 2rem;
    }

    .card-label {
        text-align: left;
        font-size: 0.9rem;
        color: #9ca3af;
        margin-bottom: 0.5rem;
    }

    .card-input {
        width: 100%;
        padding: 1rem 1.5rem;
        background: #374151;
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 1.1rem;
        outline: none;
        margin-bottom: 1rem;
    }

    .mpesa-details {
        margin-bottom: 2rem;
    }

    .mpesa-label {
        text-align: left;
        font-size: 0.9rem;
        color: #9ca3af;
        margin-bottom: 0.5rem;
    }

    .mpesa-input {
        width: 100%;
        padding: 1rem 1.5rem;
        background: #374151;
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 1.1rem;
        outline: none;
    }

    .crypto-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Changed from 5 to 3 */
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .method-tab {
        flex: 1;
        padding: 1rem 1.5rem; /* Increased padding */
        border: none;
        background: transparent;
        color: #9ca3af;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 500;
        font-size: 1.1rem; /* Increased font size */
    }

    .continue-btn {
        width: 100%; /* Changed to full width */
        height: 50px; /* Increased height */
        border-radius: 12px; /* Changed to more rounded corners */
        background: #4ade80;
        border: none;
        color: #0a0f1c;
        font-size: 1.2rem; /* Increased font size */
        cursor: pointer;
        transition: all 0.2s;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    @media (max-width: 768px) {
        .crypto-options {
            grid-template-columns: repeat(2, 1fr); /* Changed to 2 columns on mobile */
        }

        .method-tab {
            padding: 0.8rem 1rem; /* Adjusted padding on mobile */
            font-size: 1rem; /* Adjusted font size on mobile */
        }

        .deposit-form {
            padding: 1.5rem; /* Adjusted padding on mobile */
        }
    }

    @media (max-width: 480px) {
        .crypto-options {
            grid-template-columns: repeat(1, 1fr); /* Changed to 1 column on smaller mobile devices */
        }

        .method-tab {
            padding: 0.6rem 0.8rem; /* Further adjusted padding on smaller mobile devices */
            font-size: 0.9rem; /* Further adjusted font size on smaller mobile devices */
        }
    }
</style>

<body>
    <main class="main-content">
        <h1 class="main-title">Fund Your Account</h1>
        <p class="main-subtitle">Choose your preferred deposit method below</p>
        
        <div class="deposit-form">
            <div class="method-tabs">
                <button class="method-tab active" id="crypto-tab">💰 Crypto</button>
                <button class="method-tab" id="card-tab">💳 Card</button>
                <button class="method-tab" id="mpesa-tab">📱 Mpesa</button>
            </div>
            
            <!-- Crypto deposit form -->
            <div id="crypto-deposit-form">
                <div class="crypto-options">
                    <div class="crypto-option selected" onclick="selectCrypto(this, 'bitcoin')">
                        <div class="crypto-icon bitcoin">₿</div>
                        <div class="crypto-name">Bitcoin</div>
                    </div>
                    <div class="crypto-option" onclick="selectCrypto(this, 'ethereum')">
                        <div class="crypto-icon ethereum">Ξ</div>
                        <div class="crypto-name">Ethereum</div>
                    </div>
                    <div class="crypto-option" onclick="selectCrypto(this, 'solana')">
                        <div class="crypto-icon solana">◎</div>
                        <div class="crypto-name">Solana</div>
                    </div>
                    <div class="crypto-option" onclick="selectCrypto(this, 'ripple')">
                        <div class="crypto-icon ripple">✕</div>
                        <div class="crypto-name">Ripple</div>
                    </div>
                    <div class="crypto-option" onclick="selectCrypto(this, 'binance')">
                        <div class="crypto-icon binance">B</div>
                        <div class="crypto-name">Binance</div>
                    </div>
                </div>
                
                <div class="amount-section">
                    <div class="amount-label">Amount (USD)</div>
                    <input type="number" class="amount-input" placeholder="28" value="28">
                </div>
                
                <div class="deposit-preview">
                    <div class="preview-icon">₿</div>
                    <div class="preview-title">Bitcoin Deposit</div>
                    <button class="continue-btn">📊</button>
                </div>
            </div>
            
            <!-- Card deposit form -->
            <div id="card-deposit-form" style="display: none;">
                <div class="amount-section">
                    <div class="amount-label">Amount (USD)</div>
                    <input type="number" class="amount-input" placeholder="28" value="28">
                </div>
                <div class="card-details">
                    <div class="card-label">Card Number</div>
                    <input type="text" class="card-input" placeholder="1234 5678 9012 3456">
                    <div class="card-label">Expiry Date</div>
                    <input type="text" class="card-input" placeholder="MM/YY">
                    <div class="card-label">CVV</div>
                    <input type="text" class="card-input" placeholder="123">
                </div>
                <button class="continue-btn">Pay Now</button>
            </div>
            
            <!-- Mpesa deposit form -->
            <div id="mpesa-deposit-form" style="display: none;">
                <div class="amount-section">
                    <div class="amount-label">Amount (KES)</div>
                    <input type="number" class="amount-input" placeholder="2800" value="2800">
                </div>
                <div class="mpesa-details">
                    <div class="mpesa-label">Phone Number</div>
                    <input type="text" class="mpesa-input" placeholder="0712 345678">
                </div>
                <button class="continue-btn">Pay Now</button>
            </div>
        </div>
    </main>

    <script>
        function selectCrypto(element, cryptoType) {
            // Remove selected class from all options
            document.querySelectorAll('.crypto-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            element.classList.add('selected');
            
            // Update preview section
            const previewIcon = document.querySelector('.preview-icon');
            const previewTitle = document.querySelector('.preview-title');
            
            const cryptoData = {
                bitcoin: { icon: '₿', name: 'Bitcoin' },
                ethereum: { icon: 'Ξ', name: 'Ethereum' },
                solana: { icon: '◎', name: 'Solana' },
                ripple: { icon: '✕', name: 'Ripple' },
                binance: { icon: 'B', name: 'Binance' }
            };
            
            const crypto = cryptoData[cryptoType];
            previewIcon.textContent = crypto.icon;
            previewTitle.textContent = `${crypto.name} Deposit`;
        }

        // Tab switching functionality
        document.querySelectorAll('.method-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.method-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                if (this.id === 'crypto-tab') {
                    document.getElementById('crypto-deposit-form').style.display = 'block';
                    document.getElementById('card-deposit-form').style.display = 'none';
                    document.getElementById('mpesa-deposit-form').style.display = 'none';
                } else if (this.id === 'card-tab') {
                    document.getElementById('crypto-deposit-form').style.display = 'none';
                    document.getElementById('card-deposit-form').style.display = 'block';
                    document.getElementById('mpesa-deposit-form').style.display = 'none';
                } else if (this.id === 'mpesa-tab') {
                    document.getElementById('crypto-deposit-form').style.display = 'none';
                    document.getElementById('card-deposit-form').style.display = 'none';
                    document.getElementById('mpesa-deposit-form').style.display = 'block';
                }
            });
        });
    </script>
@endsection