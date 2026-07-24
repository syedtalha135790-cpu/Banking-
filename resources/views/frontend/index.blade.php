<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bank Management Services | Secure & Smart Banking</title>
  <meta name="description" content="Manage your accounts, transactions, loans, cards, and banking services efficiently with BMS's secure digital platform.">
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: {
              DEFAULT: '#2563EB',
              dark: '#1D4ED8',
              light: '#60A5FA',
            },
            secondary: {
              DEFAULT: '#1D4ED8',
            },
            accent: {
              DEFAULT: '#06B6D4',
            },
          }
        }
      }
    }
  </script>
  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  <!-- Custom Styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
</head>
<body class="bg-white text-gray-900 transition-colors duration-300 relative overflow-x-hidden">
  <div class="glow-sphere glow-blue w-[500px] h-[500px] -top-60 -left-60"></div>
  <div class="glow-sphere glow-cyan w-[500px] h-[500px] top-[35%] -right-60"></div>
  <div class="glow-sphere glow-indigo w-[400px] h-[400px] bottom-10 left-10"></div>

  <!-- Scroll Progress Bar -->
  <div id="scroll-progress" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-blue-600 to-cyan-500 z-[100] transition-all duration-100" style="width: 0%;"></div>

  <!-- Navbar -->
  <nav class="sticky top-0 z-50 glass-nav shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
          <div class="p-2.5 bg-gradient-primary rounded-xl text-white shadow-md shadow-primary/20">
            <i data-lucide="landmark" class="w-6 h-6"></i>
          </div>
          <span class="font-extrabold text-xl tracking-tight text-gradient-primary">BMS</span>
        </a>

        <!-- Desktop Navigation Menu -->
        <div class="hidden lg:flex items-center space-x-6">
          <a href="{{ route('home') }}" class="text-primary font-semibold transition-colors duration-200">Home</a>
          <a href="{{ route('about') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">About</a>
          <a href="{{ route('services') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Services</a>
          <a href="{{ route('accounts') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Accounts</a>
          <a href="{{ route('loans') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Loans</a>
          <a href="{{ route('contact') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Contact</a>
        </div>

        <!-- Navbar Actions (Auth) -->
        <div class="hidden lg:flex items-center space-x-4">
          <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl font-semibold text-gray-700 hover:bg-slate-50 transition-all duration-200">Login</a>
          <a href="{{ route('register') }}" class="btn-3d-primary px-5 py-2.5 bg-gradient-primary text-white font-semibold rounded-xl shadow-md transition-all duration-200">Open Account</a>
        </div>

        <!-- Mobile Hamburg Menu Trigger -->
        <div class="flex items-center lg:hidden">
          <button id="mobile-menu-btn" class="p-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-slate-50 transition-all" aria-label="Open Menu">
            <i data-lucide="menu" class="w-6 h-6"></i>
          </button>
        </div>

      </div>
    </div>

    <!-- Mobile Menu Container -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-200 bg-white px-4 pt-4 pb-6 space-y-2 shadow-xl">
      <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl bg-slate-50 text-primary font-semibold">Home</a>
      <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">About</a>
      <a href="{{ route('services') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Services</a>
      <a href="{{ route('accounts') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Accounts</a>
      <a href="{{ route('loans') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Loans</a>
      <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Contact</a>
      <div class="pt-4 flex flex-col space-y-3">
        <a href="{{ route('login') }}" class="text-center py-3 rounded-xl font-semibold border border-gray-200 text-gray-700 hover:bg-slate-550 transition-all">Login</a>
        <a href="{{ route('register') }}" class="text-center py-3 bg-gradient-primary text-white font-semibold rounded-xl">Open Account</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-32 bg-white">
    <!-- Soft Background Shapes -->
    <div class="absolute top-1/4 left-1/10 w-96 h-96 bg-blue-50/60 rounded-full blur-3xl animate-pulse-soft"></div>
    <div class="absolute bottom-1/4 right-1/10 w-96 h-96 bg-cyan-50/50 rounded-full blur-3xl animate-pulse-soft"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
      <div class="grid lg:grid-cols-12 gap-12 items-center">
        
        <!-- Hero Text -->
        <div class="lg:col-span-6 space-y-6 text-center lg:text-left reveal-left active">
          <div class="inline-flex items-center space-x-2 bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">
            <i data-lucide="shield-check" class="w-4 h-4"></i>
            <span>Institutional-Grade Security</span>
          </div>
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
            Secure & Smart <br class="hidden sm:inline">
            <span class="text-gradient-primary ticker-fade active" id="hero-ticker">Bank Management</span>
          </h1>
          <p class="text-base sm:text-lg text-gray-500 max-w-xl mx-auto lg:mx-0">
            Manage accounts, transactions, loans, cards, and corporate banking services efficiently. Experience banking powered by modern tools.
          </p>
          <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
            <a href="{{ route('register') }}" class="btn-3d-primary w-full sm:w-auto px-8 py-4 bg-gradient-primary text-white font-bold rounded-2xl shadow-md text-center">
              Open Account
            </a>
            <a href="{{ route('login') }}" class="btn-3d-secondary w-full sm:w-auto px-8 py-4 border border-slate-300 text-slate-700 bg-white hover:bg-slate-50 font-bold rounded-2xl text-center">
              Internet Banking
            </a>
          </div>
        </div>

        <!-- Hero Illustration -->
        <div class="lg:col-span-6 relative flex justify-center reveal-right active">
          <div class="relative w-full max-w-md md:max-w-lg aspect-square flex items-center justify-center">
            
            <!-- Dynamic SVG Banking Dashboard Mockup -->
            <svg class="w-full h-full text-gray-200 animate-float" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="50" y="50" width="400" height="400" rx="30" fill="#FFFFFF" stroke="#E5E7EB" stroke-width="2"/>
              <!-- Card 1 -->
              <rect x="80" y="90" width="340" height="150" rx="20" fill="url(#card-grad)" class="shadow-md"/>
              <circle cx="130" cy="140" r="20" fill="#ffffff" fill-opacity="0.3"/>
              <rect x="80" y="270" width="160" height="100" rx="15" fill="#FFFFFF" stroke="#E5E7EB" stroke-width="1.5"/>
              <rect x="260" y="270" width="160" height="100" rx="15" fill="#FFFFFF" stroke="#E5E7EB" stroke-width="1.5"/>
              <!-- Graph SVG Inside -->
              <path d="M 95 350 Q 130 310 160 330 T 225 290" stroke="#06B6D4" stroke-width="4" stroke-linecap="round" fill="none"/>
              <circle cx="225" cy="290" r="5" fill="#F4C542"/>
              <!-- Small Card Details -->
              <rect x="280" y="295" width="80" height="10" rx="5" fill="#E5E7EB"/>
              <rect x="280" y="315" width="120" height="12" rx="6" fill="#2563EB"/>
              <rect x="280" y="335" width="50" height="10" rx="5" fill="#E5E7EB"/>
              <!-- Card Chip/Logo -->
              <rect x="340" y="125" width="45" height="30" rx="5" fill="#F4C542" fill-opacity="0.9"/>
              <!-- Card Number Placeholder -->
              <text x="110" y="210" fill="#ffffff" font-family="'Outfit', sans-serif" font-weight="bold" font-size="16" letter-spacing="4">••••  ••••  ••••  8829</text>
              <defs>
                <linearGradient id="card-grad" x1="80" y1="90" x2="420" y2="240" gradientUnits="userSpaceOnUse">
                  <stop offset="0%" stop-color="#2563EB"/>
                  <stop offset="100%" stop-color="#06B6D4"/>
                </linearGradient>
              </defs>
            </svg>
            
            <!-- Floating Elements -->
            <div class="absolute -top-4 -right-4 card-3d p-4 rounded-2xl flex items-center space-x-3">
              <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                <i data-lucide="trending-up" class="w-5 h-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-400">Total Revenue</p>
                <p class="text-sm font-bold text-gray-800">+24.8%</p>
              </div>
            </div>
            
            <div class="absolute -bottom-4 -left-4 card-3d p-4 rounded-2xl flex items-center space-x-3">
              <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                <i data-lucide="credit-card" class="w-5 h-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-400">Active Cards</p>
                <p class="text-sm font-bold text-gray-800">Visa Premium</p>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </header>

  <!-- Statistics Section -->
  <section class="py-12 bg-slate-50 border-y border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
        
        <div class="space-y-1">
          <p class="text-3xl sm:text-4xl font-extrabold text-primary stat-counter" data-target="500" data-suffix="K+">0K+</p>
          <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wider">Active Customers</p>
        </div>

        <div class="space-y-1">
          <p class="text-3xl sm:text-4xl font-extrabold text-primary stat-counter" data-target="250" data-suffix="+">0+</p>
          <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wider">Global Branches</p>
        </div>

        <div class="space-y-1">
          <p class="text-3xl sm:text-4xl font-extrabold text-primary stat-counter" data-target="99.99" data-suffix="%" data-decimal="true">0.00%</p>
          <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wider">Secure Transactions</p>
        </div>

        <div class="space-y-1">
          <p class="text-3xl sm:text-4xl font-extrabold text-primary stat-counter" data-target="24" data-suffix="/7">0/7</p>
          <p class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wider">Support Uptime</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-16 reveal">
        <h2 class="text-xs font-bold uppercase tracking-wider text-primary mb-3">Our Core Services</h2>
        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">
          Comprehensive Banking Built Around You
        </p>
        <p class="mt-4 text-gray-500">
          Unlock the full potential of your finances with modern tools to deposit, invest, transfer, and borrow safely.
        </p>
      </div>

      <!-- Services Grid -->
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Account Management -->
        <div class="card-3d p-8 rounded-3xl relative group overflow-hidden reveal">
          <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full blur-xl group-hover:bg-blue-100 transition-all duration-300"></div>
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="user-check" class="w-6 h-6"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Account Management</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Monitor balances, set savings pockets, and configure auto-transfers in seconds.
          </p>
          <a href="{{ route('accounts') }}" class="flex items-center text-primary font-bold text-sm hover:underline">
            <span>Learn More</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Online Banking -->
        <div class="card-3d p-8 rounded-3xl relative group overflow-hidden reveal">
          <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-50 rounded-full blur-xl group-hover:bg-cyan-100 transition-all duration-300"></div>
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="monitor" class="w-6 h-6"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Online Banking</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Check logs, transfer anywhere, and update cards straight from your browser.
          </p>
          <a href="{{ route('online-banking') }}" class="flex items-center text-primary font-bold text-sm hover:underline">
            <span>Explore App</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Money Transfer -->
        <div class="card-3d p-8 rounded-3xl relative group overflow-hidden reveal">
          <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full blur-xl group-hover:bg-blue-100 transition-all duration-300"></div>
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="arrow-left-right" class="w-6 h-6"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Money Transfer</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Instant peer-to-peer and domestic wire transfers with rock-bottom fees.
          </p>
          <a href="{{ route('services') }}" class="flex items-center text-primary font-bold text-sm hover:underline">
            <span>Transfer Rates</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Loan Management -->
        <div class="card-3d p-8 rounded-3xl relative group overflow-hidden reveal">
          <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-full blur-xl group-hover:bg-blue-100 transition-all duration-300"></div>
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="file-text" class="w-6 h-6"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Loan Management</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Get pre-approved for mortgages, car loans, and business development funding.
          </p>
          <a href="{{ route('loans') }}" class="flex items-center text-primary font-bold text-sm hover:underline">
            <span>Calculate Interest</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Credit Cards -->
        <div class="card-3d p-8 rounded-3xl relative group overflow-hidden reveal">
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="credit-card" class="w-6 h-6"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Credit Cards</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Up to 3% cashback on regular spending. Generous ceilings and flexible rates.
          </p>
          <a href="{{ route('services') }}" class="flex items-center text-primary font-bold text-sm hover:underline">
            <span>Apply Now</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Debit Cards -->
        <div class="card-3d p-8 rounded-3xl relative group overflow-hidden reveal">
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="pocket" class="w-6 h-6"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Debit Cards</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Instantly issue digital debits or order premium metallic cards direct to door.
          </p>
          <a href="{{ route('services') }}" class="flex items-center text-primary font-bold text-sm hover:underline">
            <span>Design Card</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Mobile Banking -->
        <div class="card-3d p-8 rounded-3xl relative group overflow-hidden reveal">
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="smartphone" class="w-6 h-6"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Mobile Banking</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            NFC payments, push updates, biometrics and QR codes with our premium mobile app.
          </p>
          <a href="{{ route('online-banking') }}" class="flex items-center text-primary font-bold text-sm hover:underline">
            <span>Download</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Investment Services -->
        <div class="card-3d p-8 rounded-3xl relative group overflow-hidden reveal">
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="bar-chart-3" class="w-6 h-6"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Investment Services</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Buy global shares, funds, or commodities. Managed portfolio advisory tools.
          </p>
          <a href="{{ route('services') }}" class="flex items-center text-primary font-bold text-sm hover:underline">
            <span>View Markets</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

      </div>

    </div>
  </section>

  <!-- Features Section -->
  <section class="py-20 lg:py-32 bg-slate-50 border-y border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-16 reveal">
        <h2 class="text-xs font-bold uppercase tracking-wider text-primary mb-3">Why Choose BMS</h2>
        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">
          State-of-the-Art Banking Features
        </p>
        <p class="mt-4 text-gray-500">
          We combine cutting-edge technology with institutional security to bring you an unparalleled banking experience.
        </p>
      </div>

      <!-- Features Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Secure Login -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="key-round" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Secure Login</h3>
            <p class="text-gray-500 text-sm">Multi-level cryptographic verification keeps your login sessions bulletproof.</p>
          </div>
        </div>

        <!-- OTP Verification -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="shield-check" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">OTP Verification</h3>
            <p class="text-gray-500 text-sm">Dual-channel SMS & Email OTP protocols to authorize any high-value transactions.</p>
          </div>
        </div>

        <!-- Fast Transactions -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="zap" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Fast Transactions</h3>
            <p class="text-gray-500 text-sm">Domestic and international payments routed in real time with high throughput speed.</p>
          </div>
        </div>

        <!-- Transaction History -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="history" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Transaction History</h3>
            <p class="text-gray-500 text-sm">Comprehensive ledger logs, category sorting, search bars, and tags for budgeting.</p>
          </div>
        </div>

        <!-- Real-Time Notifications -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="bell" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Real-Time Notifications</h3>
            <p class="text-gray-500 text-sm">Instant push notifications, SMS alerts, and email summaries for account activities.</p>
          </div>
        </div>

        <!-- Biometric Authentication -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="fingerprint" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Biometric Authentication</h3>
            <p class="text-gray-500 text-sm">Touch ID and Face ID compatibility via WebAuthn API on supported web browsers.</p>
          </div>
        </div>

        <!-- Online Bill Payments -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="receipt" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Online Bill Payments</h3>
            <p class="text-gray-500 text-sm">Automate recurring utility utilities, subscriptions, and card settlements easily.</p>
          </div>
        </div>

        <!-- Account Statements -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="file-bar-chart" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Account Statements</h3>
            <p class="text-gray-500 text-sm">Download signed PDF/CSV monthly summaries directly from your customer panel.</p>
          </div>
        </div>

        <!-- Multi Currency Support -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="globe" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Multi Currency Support</h3>
            <p class="text-gray-500 text-sm">Hold, receive, and swap over 30 global currencies at standard interbank rates.</p>
          </div>
        </div>

        <!-- Fraud Detection -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="shield-alert" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Fraud Detection</h3>
            <p class="text-gray-500 text-sm">AI monitors behavior metrics to auto-block suspicious login locations and requests.</p>
          </div>
        </div>

        <!-- AI Chat Assistant -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="message-square" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">AI Chat Assistant</h3>
            <p class="text-gray-500 text-sm">Get immediate answers for card freezes, limits, and product rates via virtual chat.</p>
          </div>
        </div>

        <!-- Secure Data Encryption -->
        <div class="flex space-x-4 p-6 rounded-2xl bg-white border border-gray-200 hover:shadow-md transition-all reveal">
          <div class="flex-shrink-0 text-blue-600 p-2 bg-blue-50 rounded-xl h-10 w-10 flex items-center justify-center">
            <i data-lucide="lock" class="w-5 h-5"></i>
          </div>
          <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Secure Data Encryption</h3>
            <p class="text-gray-500 text-sm">End-to-end data encryption using AES-256 standards both in transit and at rest.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="py-20 lg:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-20 reveal">
        <h2 class="text-xs font-bold uppercase tracking-wider text-primary mb-3">Onboarding</h2>
        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">
          Get Started in 4 Easy Steps
        </p>
        <p class="mt-4 text-gray-500">
          Our online system is completely paperless. Open your institutional account in under 10 minutes.
        </p>
      </div>

      <!-- Process Steps Layout -->
      <div class="relative">
        <!-- Connecting Line for Desktop -->
        <div class="hidden lg:block absolute top-1/2 left-0 right-0 h-1 bg-blue-100 -translate-y-1/2 z-0"></div>
        
        <div class="grid lg:grid-cols-4 gap-12 relative z-10">
          
          <!-- Step 1 -->
          <div class="bg-white border border-gray-200 p-8 rounded-[20px] text-center shadow-sm hover-scale reveal">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-extrabold text-xl mx-auto mb-6">
              1
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-900">Register</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
              Create an account online with your email and standard password credentials.
            </p>
          </div>

          <!-- Step 2 -->
          <div class="bg-white border border-gray-200 p-8 rounded-[20px] text-center shadow-sm hover-scale reveal" style="transition-delay: 150ms;">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-extrabold text-xl mx-auto mb-6">
              2
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-900">Verify Identity</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
              Upload a valid passport or government ID to securely verify your personal details.
            </p>
          </div>

          <!-- Step 3 -->
          <div class="bg-white border border-gray-200 p-8 rounded-[20px] text-center shadow-sm hover-scale reveal" style="transition-delay: 300ms;">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-extrabold text-xl mx-auto mb-6">
              3
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-900">Open Account</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
              Select your currency pockets, configure deposits, and customize security.
            </p>
          </div>

          <!-- Step 4 -->
          <div class="bg-white border border-gray-200 p-8 rounded-[20px] text-center shadow-sm hover-scale reveal" style="transition-delay: 450ms;">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-extrabold text-xl mx-auto mb-6">
              4
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-900">Start Banking</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
              Transact domestic or global payments, order cards, and track portfolios instantly.
            </p>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-20 lg:py-32 bg-slate-50 border-y border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-3xl mx-auto mb-16 reveal">
        <h2 class="text-xs font-bold uppercase tracking-wider text-primary mb-3">Client Success</h2>
        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">
          Trusted by Millions Globally
        </p>
        <p class="mt-4 text-gray-500">
          Hear from our personal and corporate accounts about how BMS simplifies financial administration.
        </p>
      </div>

      <!-- Testimonial Cards -->
      <div class="grid md:grid-cols-3 gap-8">
        
        <!-- Card 1 -->
        <div class="bg-white border border-gray-200 p-8 rounded-[20px] shadow-sm relative reveal">
          <div class="flex items-center space-x-1 text-amber-500 mb-4">
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
          </div>
          <p class="text-gray-600 text-sm leading-relaxed italic mb-6">
            "Switching our corporate account structure to BMS cut down international transaction times from 3 days to literally under 5 minutes. The dashboard interface is outstanding."
          </p>
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 font-bold text-center flex items-center justify-center border border-blue-100">
              SH
            </div>
            <div>
              <h4 class="font-bold text-sm text-gray-900">Sarah Jenkins</h4>
              <p class="text-xs text-gray-400">CFO, Apex Global</p>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white border border-gray-200 p-8 rounded-[20px] shadow-sm relative reveal" style="transition-delay: 150ms;">
          <div class="flex items-center space-x-1 text-amber-500 mb-4">
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
          </div>
          <p class="text-gray-600 text-sm leading-relaxed italic mb-6">
            "The personal savings vaults and custom card limits allow me to split bills and manage my family budget stress-free. The mobile app face-unlock makes accessing accounts seamless."
          </p>
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 font-bold text-center flex items-center justify-center border border-blue-100">
              MK
            </div>
            <div>
              <h4 class="font-bold text-sm text-gray-900">Marcus King</h4>
              <p class="text-xs text-gray-400">Tech Lead, StreamLine</p>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white border border-gray-200 p-8 rounded-[20px] shadow-sm relative reveal" style="transition-delay: 300ms;">
          <div class="flex items-center space-x-1 text-amber-500 mb-4">
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
            <i data-lucide="star" class="w-5 h-5 fill-current"></i>
          </div>
          <p class="text-gray-600 text-sm leading-relaxed italic mb-6">
            "Securing a student loan with their automated calculator was fully online. The monthly repayments and transparent interest rates were clear without any hidden advisory service fees."
          </p>
          <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 font-bold text-center flex items-center justify-center border border-blue-100">
              EL
            </div>
            <div>
              <h4 class="font-bold text-sm text-gray-900">Elena Rostova</h4>
              <p class="text-xs text-gray-400">PhD Student, Imperial</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="py-20 lg:py-32 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center mb-16 reveal">
        <h2 class="text-xs font-bold uppercase tracking-wider text-primary mb-3">Common Questions</h2>
        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900">
          Frequently Asked Questions
        </p>
      </div>

      <!-- FAQ Accordion -->
      <div class="space-y-4">
        
        <!-- Item 1 -->
        <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden reveal">
          <button class="faq-trigger w-full px-6 py-5 text-left flex justify-between items-center font-bold text-gray-900 hover:bg-slate-50 transition-colors">
            <span>How secure is BMS's bank management services?</span>
            <i data-lucide="chevron-down" class="faq-icon w-5 h-5 text-gray-500 transition-transform duration-300"></i>
          </button>
          <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 px-6">
            <p class="text-sm text-gray-500 leading-relaxed">
              We employ military-grade AES-256 encryption protocols for static logs and transport layers. Additionally, logins are backed by Multi-Factor Authentication (OTP), biometrics, and active AI fraud monitors to isolate anomalies immediately.
            </p>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden reveal">
          <button class="faq-trigger w-full px-6 py-5 text-left flex justify-between items-center font-bold text-gray-900 hover:bg-slate-50 transition-colors">
            <span>What documents are needed to register for an online account?</span>
            <i data-lucide="chevron-down" class="faq-icon w-5 h-5 text-gray-500 transition-transform duration-300"></i>
          </button>
          <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 px-6">
            <p class="text-sm text-gray-500 leading-relaxed">
              You will need a valid government-issued photographic ID (Passport, National ID, or Driver's license) and a document verifying your residential address (Utility bill or official bank statement dated within the last 3 months).
            </p>
          </div>
        </div>

        <!-- Item 3 -->
        <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden reveal">
          <button class="faq-trigger w-full px-6 py-5 text-left flex justify-between items-center font-bold text-gray-900 hover:bg-slate-50 transition-colors">
            <span>How long does the loan application and approval process take?</span>
            <i data-lucide="chevron-down" class="faq-icon w-5 h-5 text-gray-500 transition-transform duration-300"></i>
          </button>
          <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 px-6">
            <p class="text-sm text-gray-500 leading-relaxed">
              For standard personal and auto loans, our scoring engine calculates credit eligibility in real time. Pre-approvals occur inside 10 minutes. Complex commercial mortgage evaluations might take 3 to 5 business days for compliance review.
            </p>
          </div>
        </div>

        <!-- Item 4 -->
        <div class="faq-item bg-white border border-gray-200 rounded-2xl overflow-hidden reveal">
          <button class="faq-trigger w-full px-6 py-5 text-left flex justify-between items-center font-bold text-gray-900 hover:bg-slate-50 transition-colors">
            <span>Are there any foreign currency exchange fees?</span>
            <i data-lucide="chevron-down" class="faq-icon w-5 h-5 text-gray-500 transition-transform duration-300"></i>
          </button>
          <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 px-6">
            <p class="text-sm text-gray-500 leading-relaxed">
              We offer conversion rates using the real-time interbank market average. Standard transactions feature zero markups on weekdays, while high-value weekend transactions incur a tiny liquidity fee of up to 0.5%.
            </p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- Call To Action Section -->
  <section class="py-20 lg:py-28 relative overflow-hidden bg-gradient-primary text-white">
    <div class="absolute inset-0 bg-black/5"></div>
    <div class="absolute -top-1/2 -left-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse-soft"></div>
    <div class="absolute -bottom-1/2 -right-1/4 w-96 h-96 bg-cyan-550/20 rounded-full blur-3xl animate-pulse-soft"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-8 reveal">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
        Start Your Banking Journey Today
      </h2>
      <p class="text-lg text-blue-50 max-w-2xl mx-auto">
        Join over 500,000+ businesses and individuals managing accounts, sending global payments, and acquiring loans easily.
      </p>
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-blue-600 font-bold rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all text-center">
          Open an Account
        </a>
        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-8 py-4 border border-white/30 hover:bg-white/10 text-white font-bold rounded-xl hover:-translate-y-0.5 transition-all text-center">
          Contact Us
        </a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-slate-50 text-gray-500 pt-16 pb-12 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 mb-12">
        
        <!-- Logo & Description -->
        <div class="lg:col-span-4 space-y-4">
          <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <div class="p-2 bg-gradient-primary rounded-lg text-white">
              <i data-lucide="landmark" class="w-5 h-5"></i>
            </div>
            <span class="font-extrabold text-lg text-gradient-primary">BMS</span>
          </a>
          <p class="text-sm leading-relaxed max-w-sm text-gray-400">
            A premium, modern bank management services platform for fast, secured, and responsive transactions worldwide.
          </p>
          <div class="flex space-x-3 pt-2">
            <a href="#" class="p-2 rounded-lg bg-white border border-gray-200 text-gray-400 hover:text-primary hover:border-primary transition-colors"><i data-lucide="facebook" class="w-4 h-4"></i></a>
            <a href="#" class="p-2 rounded-lg bg-white border border-gray-200 text-gray-400 hover:text-primary hover:border-primary transition-colors"><i data-lucide="twitter" class="w-4 h-4"></i></a>
            <a href="#" class="p-2 rounded-lg bg-white border border-gray-200 text-gray-400 hover:text-primary hover:border-primary transition-colors"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
            <a href="#" class="p-2 rounded-lg bg-white border border-gray-200 text-gray-400 hover:text-primary hover:border-primary transition-colors"><i data-lucide="instagram" class="w-4 h-4"></i></a>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="lg:col-span-2 space-y-4">
          <h4 class="font-bold text-sm uppercase tracking-wider text-gray-900">Company</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="{{ route('about') }}" class="hover:text-primary transition-colors">About Us</a></li>
            <li><a href="{{ route('contact') }}" class="hover:text-primary transition-colors">Contact</a></li>
            <li><a href="#" class="hover:text-primary transition-colors">Careers</a></li>
            <li><a href="#" class="hover:text-primary transition-colors">Press Room</a></li>
            <li><a href="/404" class="hover:text-primary transition-colors">404 Error</a></li>
          </ul>
        </div>

        <!-- Banking Services -->
        <div class="lg:col-span-3 space-y-4">
          <h4 class="font-bold text-sm uppercase tracking-wider text-gray-900">Services</h4>
          <ul class="space-y-2 text-sm">
            <li><a href="{{ route('accounts') }}" class="hover:text-primary transition-colors">Checking & Savings</a></li>
            <li><a href="{{ route('loans') }}" class="hover:text-primary transition-colors">Mortgages & Loans</a></li>
            <li><a href="{{ route('services') }}" class="hover:text-primary transition-colors">Credit Card Catalog</a></li>
            <li><a href="{{ route('online-banking') }}" class="hover:text-primary transition-colors">Online & Mobile Banking</a></li>
            <li><a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Client Dashboard</a></li>
          </ul>
        </div>

        <!-- Newsletter Subscription -->
        <div class="lg:col-span-3 space-y-4">
          <h4 class="font-bold text-sm uppercase tracking-wider text-gray-900">Stay Updated</h4>
          <p class="text-sm text-gray-400">Subscribe to get interest rate reductions and security digests.</p>
          <form class="flex flex-col space-y-2" onsubmit="event.preventDefault(); alert('Subscribed to Newsletter!');">
            <input type="email" placeholder="name@domain.com" required class="px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary text-gray-900">
            <button type="submit" class="px-4 py-3 bg-gradient-primary hover:opacity-95 text-white font-bold text-sm rounded-xl transition-all shadow-md">
              Subscribe
            </button>
          </form>
        </div>

      </div>

      <hr class="border-gray-200 my-8">

      <!-- Bottom Bar -->
      <div class="flex flex-col md:flex-row items-center justify-between text-xs text-gray-400">
        <p>&copy; 2026 Bank Management Services (BMS). All rights reserved.</p>
        <div class="flex space-x-4 mt-4 md:mt-0">
          <a href="#" class="hover:text-gray-600">Privacy Policy</a>
          <a href="#" class="hover:text-gray-600">Terms & Conditions</a>
          <a href="#" class="hover:text-gray-600">Cookie Preferences</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll to Top Button -->
  <button id="scroll-to-top" class="fixed bottom-6 right-6 z-50 p-3 rounded-full bg-primary hover:bg-opacity-90 text-white shadow-lg transition-all duration-300 opacity-0 invisible hover:-translate-y-1">
    <i data-lucide="arrow-up" class="w-6 h-6"></i>
  </button>

  <!-- Global scripts -->
  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
  <!-- Homepage Interactive Effects -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // 1. Scroll Progress Bar
      const scrollProgress = document.getElementById('scroll-progress');
      if (scrollProgress) {
        window.addEventListener('scroll', () => {
          const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
          const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
          const scrolled = height > 0 ? (winScroll / height) * 100 : 0;
          scrollProgress.style.width = scrolled + '%';
        });
      }

      // 2. Card Mouse Move Spotlight Effect
      const spotlightCards = document.querySelectorAll('.card-3d');
      spotlightCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
          const rect = card.getBoundingClientRect();
          const x = e.clientX - rect.left;
          const y = e.clientY - rect.top;
          card.style.setProperty('--mouse-x', `${x}px`);
          card.style.setProperty('--mouse-y', `${y}px`);
        });
      });

      // 3. Hero Text Ticker Animation
      const tickerElement = document.getElementById('hero-ticker');
      if (tickerElement) {
        const words = [
          "Bank Management",
          "3D Digital Wallets",
          "Global Transfers",
          "Secured Lending"
        ];
        let wordIndex = 0;
        
        setInterval(() => {
          tickerElement.classList.remove('active');
          setTimeout(() => {
            wordIndex = (wordIndex + 1) % words.length;
            tickerElement.textContent = words[wordIndex];
            tickerElement.classList.add('active');
          }, 400); // Time to slide down and hide before word swap
        }, 3500); // Swaps word every 3.5 seconds
      }
    });
  </script>
</body>
</html>
