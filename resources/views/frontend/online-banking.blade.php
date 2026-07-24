<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Banking | Bank Management Services</title>
  <meta name="description" content="Discover BMS online and mobile banking. Control cards, view transactions, transfer instantly, and integrate wallets.">
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
          <a href="{{ route('services') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Services</a>
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
      <a href="{{ route('services') }}" class="block px-4 py-3 rounded-xl text-gray-600 hover:bg-slate-50 font-medium">Services</a>
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
      <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">Digital & Mobile Banking</h1>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto">
        Your banking travels with you. Experience premium in-app configurations and absolute security from any global device.
      </p>
    </div>
  </header>

  <!-- Mobile App Promo -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid lg:grid-cols-12 gap-12 items-center">
        <!-- Phone Graphic -->
        <div class="lg:col-span-5 flex justify-center reveal-left">
          <div class="relative w-full max-w-[280px] aspect-[9/19] bg-slate-900 border-[8px] border-slate-800 rounded-[40px] shadow-2xl overflow-hidden">
            <!-- Screen Header -->
            <div class="h-6 bg-slate-800 flex justify-center items-center">
              <div class="w-16 h-4 bg-black rounded-b-xl"></div>
            </div>
            <!-- Inside App -->
            <div class="p-4 bg-white h-full space-y-4 text-gray-900">
              <div class="flex justify-between items-center text-xs">
                <span class="font-bold text-gray-900">BMS App</span>
                <i data-lucide="wifi" class="w-4 h-4 text-gray-900"></i>
              </div>
              <!-- Balance Widget -->
              <div class="bg-gradient-primary text-white p-4 rounded-2xl space-y-2">
                <p class="text-[10px] opacity-85">Available Balance</p>
                <p class="text-lg font-bold">12,850.45</p>
              </div>
              <!-- Action grid -->
              <div class="grid grid-cols-3 gap-2 text-center text-[10px] text-gray-700">
                <div class="p-2 bg-white border border-gray-100 rounded-xl">
                  <i data-lucide="send" class="w-4 h-4 mx-auto text-primary mb-1"></i>
                  <span>Send</span>
                </div>
                <div class="p-2 bg-white border border-gray-100 rounded-xl">
                  <i data-lucide="plus-circle" class="w-4 h-4 mx-auto text-primary mb-1"></i>
                  <span>Add</span>
                </div>
                <div class="p-2 bg-white border border-gray-100 rounded-xl">
                  <i data-lucide="credit-card" class="w-4 h-4 mx-auto text-cyan-550mb-1"></i>
                  <span>Card</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- App Features -->
        <div class="lg:col-span-7 space-y-8 reveal-right">
          <h2 class="text-xs font-bold uppercase tracking-wider text-primary">The BMS Mobile Application</h2>
          <h3 class="text-3xl font-extrabold text-gray-900">Control Your Wealth at the Touch of a Screen</h3>
          <p class="text-gray-500 leading-relaxed text-sm">
            Download our iOS and Android mobile app options to gain immediate notifications, QR authentication, biometric signoff, and NFC compatibility.
          </p>

          <div class="grid sm:grid-cols-2 gap-6">
            <div class="flex space-x-3">
              <div class="p-2 bg-blue-50 text-blue-600 rounded-lg h-9 w-9 flex items-center justify-center flex-shrink-0">
                <i data-lucide="bell" class="w-5 h-5"></i>
              </div>
              <div>
                <h4 class="font-bold text-sm text-gray-900">Push Notifications</h4>
                <p class="text-gray-500 text-xs mt-1">Get immediate alerts when funds land, cards trigger, or limits refresh.</p>
              </div>
            </div>

            <div class="flex space-x-3">
              <div class="p-2 bg-blue-50 text-blue-600 rounded-lg h-9 w-9 flex items-center justify-center flex-shrink-0">
                <i data-lucide="fingerprint" class="w-5 h-5"></i>
              </div>
              <div>
                <h4 class="font-bold text-sm text-gray-900">Biometric Locks</h4>
                <p class="text-gray-500 text-xs mt-1">Configure Face ID or biometric fingerprint tokens for safe key entry.</p>
              </div>
            </div>

            <div class="flex space-x-3">
              <div class="p-2 bg-blue-50 text-blue-600 rounded-lg h-9 w-9 flex items-center justify-center flex-shrink-0">
                <i data-lucide="lock" class="w-5 h-5"></i>
              </div>
              <div>
                <h4 class="font-bold text-sm text-gray-900">Card Control</h4>
                <p class="text-gray-500 text-xs mt-1">Temporarily freeze lost cards, adjust ATM ceilings, or block online buys instantly.</p>
              </div>
            </div>

            <div class="flex space-x-3">
              <div class="p-2 bg-blue-50 text-blue-600 rounded-lg h-9 w-9 flex items-center justify-center flex-shrink-0">
                <i data-lucide="wallet" class="w-5 h-5"></i>
              </div>
              <div>
                <h4 class="font-bold text-sm text-gray-900">Digital Wallet Hookup</h4>
                <p class="text-gray-500 text-xs mt-1">Integrate virtual debits directly into Apple Pay and Google Pay setups in seconds.</p>
              </div>
            </div>
          </div>

          <div class="flex flex-wrap gap-4 pt-4 justify-center sm:justify-start">
            <a href="#" class="px-6 py-3.5 bg-slate-900 text-white font-bold rounded-xl flex items-center space-x-2 hover:bg-slate-850 transition-colors">
              <i data-lucide="smartphone" class="w-5 h-5"></i>
              <div class="text-left text-xs leading-none">
                <p class="text-[9px] font-normal text-slate-400">Download on the</p>
                <p class="text-sm font-semibold">App Store</p>
              </div>
            </a>
            <a href="#" class="px-6 py-3.5 bg-slate-900 text-white font-bold rounded-xl flex items-center space-x-2 hover:bg-slate-850 transition-colors">
              <i data-lucide="play" class="w-5 h-5"></i>
              <div class="text-left text-xs leading-none">
                <p class="text-[9px] font-normal text-slate-400">GET IT ON</p>
                <p class="text-sm font-semibold">Google Play</p>
              </div>
            </a>
          </div>

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
