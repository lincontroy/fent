@extends('layouts.app')
@section('content')

<main class="main-content">
        <h1 class="page-title">Dashboard</h1>

        <!-- Portfolio Section -->
        <section class="portfolio-section">
            <div class="portfolio-header">Real Portfolio</div>
            <div class="portfolio-balance">$0.00</div>
            <div class="portfolio-change">↗ 1.41%</div>
            <div class="portfolio-actions">
            <button class="btn-deposit" onclick="location.href='/deposit'">Deposit</button>
                <button class="btn-withdraw">Withdraw</button>
            </div>
        </section>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Watchlist Section -->
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">Watchlist</h2>
                    <a href="#" class="see-all">See All →</a>
                </div>
                
                <div class="watchlist-item">
                    <div class="crypto-info">
                        <div class="crypto-icon eth">ETH</div>
                        <div class="crypto-details">
                            <h4>ETH</h4>
                            <p>Ethereum</p>
                        </div>
                    </div>
                    <div class="crypto-price">
                        <div class="price">$3596.51</div>
                        <div class="change negative">↓ -1.39%</div>
                    </div>
                </div>

                <div class="watchlist-item">
                    <div class="crypto-info">
                        <div class="crypto-icon btc">BTC</div>
                        <div class="crypto-details">
                            <h4>BTC</h4>
                            <p>Bitcoin</p>
                        </div>
                    </div>
                    <div class="crypto-price">
                        <div class="price">$118478.70</div>
                        <div class="change positive">↑ 0.17%</div>
                    </div>
                </div>

                <div class="watchlist-item">
                    <div class="crypto-info">
                        <div class="crypto-icon usdc">USD</div>
                        <div class="crypto-details">
                            <h4>USDC</h4>
                            <p>USDC</p>
                        </div>
                    </div>
                    <div class="crypto-price">
                        <div class="price">$1.00</div>
                        <div class="change positive">↑ 0.00%</div>
                    </div>
                </div>
            </section>

            <!-- Your Crypto Section -->
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">Your Crypto</h2>
                </div>
                
                <div class="crypto-grid">
                    <div class="crypto-card">
                        <div class="crypto-card-header">
                            <div class="crypto-card-icon btc">BTC</div>
                            <div class="crypto-card-change positive">+0.16%</div>
                        </div>
                        <div class="crypto-card-price">$118478.71</div>
                        <div class="crypto-card-details">Amount: 0.01 BTC</div>
                        <div class="crypto-card-value">Value: $1184.79</div>
                        <div class="crypto-card-footer">
                            <button class="trade-btn">📈 Trade</button>
                            <div class="last-updated">Last updated: 11:23:53 AM</div>
                        </div>
                    </div>

                    <div class="crypto-card">
                        <div class="crypto-card-header">
                            <div class="crypto-card-icon eth">ETH</div>
                            <div class="crypto-card-change negative">--1.98%</div>
                        </div>
                        <div class="crypto-card-price">$3597.06</div>
                        <div class="crypto-card-details">Amount: 0.25 ETH</div>
                        <div class="crypto-card-value">Value: $899.26</div>
                        <div class="crypto-card-footer">
                            <button class="trade-btn">📈 Trade</button>
                            <div class="last-updated">Last updated: 11:23:53 AM</div>
                        </div>
                    </div>

                    <div class="crypto-card">
                        <div class="crypto-card-header">
                            <div class="crypto-card-icon bnb">BNB</div>
                            <div class="crypto-card-change negative">--4.16%</div>
                        </div>
                        <div class="crypto-card-price">$760.11</div>
                        <div class="crypto-card-details">Amount: 1.5 BNB</div>
                        <div class="crypto-card-value">Value: $1140.16</div>
                        <div class="crypto-card-footer">
                            <button class="trade-btn">📈 Trade</button>
                            <div class="last-updated">Last updated: 11:23:53 AM</div>
                        </div>
                    </div>

                    <div class="crypto-card">
                        <div class="crypto-card-header">
                            <div class="crypto-card-icon sol">SOL</div>
                            <div class="crypto-card-change negative">--7.38%</div>
                        </div>
                        <div class="crypto-card-price">$184.20</div>
                        <div class="crypto-card-details">Amount: 2.5 SOL</div>
                        <div class="crypto-card-value">Value: $460.50</div>
                        <div class="crypto-card-footer">
                            <button class="trade-btn">📈 Trade</button>
                            <div class="last-updated">Last updated: 11:23:53 AM</div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    @endsection