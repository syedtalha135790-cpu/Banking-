<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services | Bank Management Services</title>
  <meta name="description" content="Explore BMS's comprehensive digital banking services: multi-currency transfers, cards, investments, and lines of credit.">
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
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
</head>
<body class="bg-white text-gray-900 transition-colors duration-300 relative overflow-x-hidden">
  <div class="glow-sphere glow-blue w-[500px] h-[500px] -top-60 -left-60"></div>
  <div class="glow-sphere glow-cyan w-[500px] h-[500px] top-[35%] -right-60"></div>
  <div class="glow-sphere glow-indigo w-[400px] h-[400px] bottom-10 left-10"></div>

  
  </div>

  <!-- Navbar -->
  <nav class="sticky top-0 z-50 glass-nav shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <a href="{{ route('home') }}" class="flex items-center space-x-2">
          <div class="p-2.5 bg-gradient-primary rounded-xl text-white shadow-md shadow-primary/20">
            <i data-lucide="landmark" class="w-6 h-6"></i>
          </div>
          <span class="font-extrabold text-xl tracking-tight text-gradient-primary">BMS</span>
        </a>
        <div class="hidden lg:flex items-center space-x-6">
          <a href="{{ route('home') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Home</a>
          <a href="{{ route('about') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">About</a>
          <a href="{{ route('services') }}" class="text-primary font-semibold transition-colors duration-200">Services</a>
          <a href="{{ route('accounts') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Accounts</a>
          <a href="{{ route('loans') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Loans</a>
          <a href="{{ route('contact') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Contact</a>
        </div>
        <div class="hidden lg:flex items-center space-x-4">
          <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl font-semibold text-gray-700 hover:bg-slate-50 transition-all duration-200">Login</a>
          <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-primary hover:opacity-95 text-white font-semibold rounded-xl shadow-lg shadow-primary/20 transition-all duration-200">Open Account</a>
        </div>
        <div class="flex items-center lg:hidden">
          <button id="mobile-menu-btn" class="p-2.5 rounded-xl border border-gray-200 text-gray-600 hover:bg-slate-50">
            <i data-lucide="menu" class="w-6 h-6"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-200 bg-white px-4 pt-4 pb-6 space-y-2 shadow-xl">
      <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Home</a>
      <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">About</a>
      <a href="{{ route('services') }}" class="block px-4 py-3 rounded-xl bg-slate-50 text-primary font-semibold">Services</a>
      <a href="{{ route('accounts') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Accounts</a>
      <a href="{{ route('loans') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Loans</a>
      <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Contact</a>
      <div class="pt-4 flex flex-col space-y-3">
        <a href="{{ route('login') }}" class="text-center py-3 rounded-xl font-semibold border border-gray-200 text-gray-700 hover:bg-slate-50">Login</a>
        <a href="{{ route('register') }}" class="text-center py-3 bg-gradient-primary text-white font-semibold rounded-xl">Open Account</a>
      </div>
    </div>
  </nav>

  <!-- Sub-Hero Section -->
  <header class="relative overflow-hidden py-16 lg:py-24 bg-gradient-primary text-white">
    <div class="absolute inset-0 bg-black/5"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
      <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">Our Financial Offerings</h1>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto">
        Discover state-of-the-art tools crafted to secure assets, accelerate transfers, and finance projects.
      </p>
    </div>
  </header>

  <!-- Service List -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Checking & Savings -->
        <div class="card-3d p-8 rounded-3xl relative reveal">
          <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="piggy-bank" class="w-7 h-7"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Checking & Savings</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Instantly set up multi-currency vaults. Generate up to 4.5% APY on automated saving pockets with interest compounding monthly.
          </p>
          <ul class="text-xs space-y-2 text-gray-400 mb-6">
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>No monthly maintenance fees</li>
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Vault round-up rules</li>
          </ul>
          <a href="{{ route('accounts') }}" class="inline-flex items-center text-primary font-bold text-sm hover:underline">
            <span>Explore Accounts</span>
            <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Global Wire Transfer -->
        <div class="card-3d p-8 rounded-3xl relative reveal" style="transition-delay: 100ms;">
          <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="arrow-left-right" class="w-7 h-7"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Global Wire Transfer</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Send high-volume transfers domestic or globally. We route your payments in real time using SEPA, SWIFT, and Faster Payments.
          </p>
          <ul class="text-xs space-y-2 text-gray-400 mb-6">
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Interbank mid-market rates</li>
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Zero hidden routing charges</li>
          </ul>
          <a href="{{ route('register') }}" class="inline-flex items-center text-primary font-bold text-sm hover:underline">
            <span>Sign Up to Transact</span>
            <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Customizable Cards -->
        <div class="card-3d p-8 rounded-3xl relative reveal" style="transition-delay: 200ms;">
          <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="credit-card" class="w-7 h-7"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Customizable Cards</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Order premium physical cards (sleek matte metal or eco-plastics) and generate infinite temporary virtual cards for safe shopping.
          </p>
          <ul class="text-xs space-y-2 text-gray-400 mb-6">
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Instant in-app card freeze</li>
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Customize spending caps</li>
          </ul>
          <a href="{{ route('online-banking') }}" class="inline-flex items-center text-primary font-bold text-sm hover:underline">
            <span>Manage Cards</span>
            <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Mortgage & Personal Loans -->
        <div class="card-3d p-8 rounded-3xl relative reveal">
          <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="home" class="w-7 h-7"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Mortgages & Loans</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Acquire funding for commercial expansion, properties, auto purchases, or student tuition. Benefit from low fixed annual interest rates.
          </p>
          <ul class="text-xs space-y-2 text-gray-400 mb-6">
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Online calculator pre-approvals</li>
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Flexible early prepayment plans</li>
          </ul>
          <a href="{{ route('loans') }}" class="inline-flex items-center text-primary font-bold text-sm hover:underline">
            <span>Calculate Loans</span>
            <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Wealth & Brokerage -->
        <div class="card-3d p-8 rounded-3xl relative reveal" style="transition-delay: 100ms;">
          <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="bar-chart-3" class="w-7 h-7"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Wealth & Brokerage</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Build and optimize portfolios with direct exposure to global stocks, indices, ETFs, commodities, and secure retirement plans.
          </p>
          <ul class="text-xs space-y-2 text-gray-400 mb-6">
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Robo-advisory algorithm tools</li>
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Fractional share purchase options</li>
          </ul>
          <a href="{{ route('register') }}" class="inline-flex items-center text-primary font-bold text-sm hover:underline">
            <span>Start Investing</span>
            <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

        <!-- Commercial API Banking -->
        <div class="card-3d p-8 rounded-3xl relative reveal" style="transition-delay: 200ms;">
          <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl w-14 h-14 flex items-center justify-center mb-6">
            <i data-lucide="terminal" class="w-7 h-7"></i>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-900">Commercial API Banking</h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6">
            Integrate our high-security APIs into your company billing platform to trigger auto-payouts, collect fees, and read statements.
          </p>
          <ul class="text-xs space-y-2 text-gray-400 mb-6">
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>REST endpoints with SDKs</li>
            <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Webhooks for instant notification</li>
          </ul>
          <a href="{{ route('contact') }}" class="inline-flex items-center text-primary font-bold text-sm hover:underline">
            <span>Contact Dev Sales</span>
            <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
          </a>
        </div>

      </div>

    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-slate-50 text-gray-500 pt-16 pb-12 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 mb-12">
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

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
</body>
</html>
