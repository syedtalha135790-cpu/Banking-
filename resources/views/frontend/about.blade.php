<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | Bank Management Services</title>
  <meta name="description" content="Learn about the history, values, leadership team, and security principles behind Bank Management Services.">
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
          <a href="{{ route('about') }}" class="text-primary font-semibold transition-colors duration-200">About</a>
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
      <a href="{{ route('about') }}" class="block px-4 py-3 rounded-xl bg-slate-50 text-primary font-semibold">About</a>
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
      <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">About Our Institution</h1>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto">
        Empowering businesses and individuals since 2012 with secure, fast, and modern digital bank management systems.
      </p>
    </div>
  </header>

  <!-- Vision & Mission -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6 reveal-left">
          <h2 class="text-xs font-bold uppercase tracking-wider text-primary">Our Purpose</h2>
          <h3 class="text-3xl font-extrabold text-gray-900">Redefining the Future of Wealth Administration</h3>
          <p class="text-gray-500 leading-relaxed text-sm">
            Bank Management Services (BMS) was founded with a single mission: to remove the friction from daily financial transactions and supply enterprise-level security to individual account holders.
          </p>
          <p class="text-gray-500 leading-relaxed text-sm">
            By building an end-to-end digital dashboard, we enable users to track balance projections, settle mortgages, exchange currencies, and automate expense reports with absolute transparency.
          </p>
          <div class="flex items-center space-x-6 pt-4">
            <div class="border-l-4 border-cyan-500 pl-4">
              <p class="text-2xl font-bold text-gray-900">100%</p>
              <p class="text-xs text-gray-400 uppercase tracking-wider">Paperless</p>
            </div>
            <div class="border-l-4 border-primary pl-4">
              <p class="text-2xl font-bold text-gray-900">30+</p>
              <p class="text-xs text-gray-400 uppercase tracking-wider">Currencies</p>
            </div>
          </div>
        </div>
        <div class="reveal-right flex justify-center">
          <!-- Illustration SVG -->
          <svg class="w-full max-w-md text-gray-200 animate-float" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="50" y="50" width="300" height="300" rx="30" fill="#FFFFFF" stroke="#E5E7EB" stroke-width="2"/>
            <circle cx="200" cy="200" r="100" fill="url(#circle-grad)" fill-opacity="0.9"/>
            <path d="M 120 200 L 170 250 L 280 140" stroke="#ffffff" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
            <defs>
              <linearGradient id="circle-grad" x1="100" y1="100" x2="300" y2="300" gradientUnits="userSpaceOnUse">
                <stop offset="0%" stop-color="#2563EB"/>
                <stop offset="100%" stop-color="#06B6D4"/>
              </linearGradient>
            </defs>
          </svg>
        </div>
      </div>
    </div>
  </section>

  <!-- Core Values -->
  <section class="py-20 bg-slate-50 border-y border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-16 reveal">
        <h2 class="text-xs font-bold uppercase tracking-wider text-primary mb-3">Our Principles</h2>
        <p class="text-3xl font-extrabold text-gray-900">Values That Guide Our Development</p>
      </div>

      <div class="grid md:grid-cols-4 gap-8">
        
        <!-- Value 1 -->
        <div class="card-3d p-8 rounded-3xl text-center space-y-4 reveal">
          <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto">
            <i data-lucide="shield-check" class="w-6 h-6"></i>
          </div>
          <h4 class="font-bold text-lg text-gray-900">Security First</h4>
          <p class="text-gray-500 text-xs leading-relaxed">
            Your data and deposits are safe under military-grade encryption and adaptive firewalls.
          </p>
        </div>

        <!-- Value 2 -->
        <div class="card-3d p-8 rounded-3xl text-center space-y-4 reveal">
          <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto">
            <i data-lucide="smile" class="w-6 h-6"></i>
          </div>
          <h4 class="font-bold text-lg text-gray-900">User-Centric</h4>
          <p class="text-gray-500 text-xs leading-relaxed">
            Simple forms, intuitive sidebars, and 24/7 client support channels.
          </p>
        </div>

        <!-- Value 3 -->
        <div class="card-3d p-8 rounded-3xl text-center space-y-4 reveal">
          <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto">
            <i data-lucide="trending-up" class="w-6 h-6"></i>
          </div>
          <h4 class="font-bold text-lg text-gray-900">Innovation</h4>
          <p class="text-gray-500 text-xs leading-relaxed">
            Continuous development of AI assistant integrations and live charts.
          </p>
        </div>

        <!-- Value 4 -->
        <div class="card-3d p-8 rounded-3xl text-center space-y-4 reveal">
          <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mx-auto">
            <i data-lucide="eye" class="w-6 h-6"></i>
          </div>
          <h4 class="font-bold text-lg text-gray-900">Transparency</h4>
          <p class="text-gray-500 text-xs leading-relaxed">
            Zero hidden charges. Transparent interbank exchange rates and loan schedules.
          </p>
        </div>

      </div>
    </div>
  </section>

  <!-- Executive Team -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto mb-16 reveal">
        <h2 class="text-xs font-bold uppercase tracking-wider text-primary mb-3">Our Leadership</h2>
        <p class="text-3xl font-extrabold text-gray-900">The Brains Behind BMS</p>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Member 1 -->
        <div class="card-3d p-6 rounded-3xl text-center reveal">
          <div class="w-24 h-24 bg-blue-50 text-blue-600 font-bold text-2xl flex items-center justify-center rounded-full mx-auto mb-4 border border-blue-100">
            AM
          </div>
          <h4 class="font-bold text-lg text-gray-900">Arthur Pendragon</h4>
          <p class="text-xs text-gray-400 mb-4 font-medium">CEO & Founder</p>
          <div class="flex items-center justify-center space-x-2 text-gray-400">
            <a href="#" class="hover:text-primary"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
            <a href="#" class="hover:text-primary"><i data-lucide="twitter" class="w-4 h-4"></i></a>
          </div>
        </div>

        <!-- Member 2 -->
        <div class="card-3d p-6 rounded-3xl text-center reveal" style="transition-delay: 100ms;">
          <div class="w-24 h-24 bg-blue-50 text-blue-600 font-bold text-2xl flex items-center justify-center rounded-full mx-auto mb-4 border border-blue-100">
            JL
          </div>
          <h4 class="font-bold text-lg text-gray-900">Juliet Lovelace</h4>
          <p class="text-xs text-gray-400 mb-4 font-medium">Chief Operations Officer</p>
          <div class="flex items-center justify-center space-x-2 text-gray-400">
            <a href="#" class="hover:text-primary"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
            <a href="#" class="hover:text-primary"><i data-lucide="twitter" class="w-4 h-4"></i></a>
          </div>
        </div>

        <!-- Member 3 -->
        <div class="card-3d p-6 rounded-3xl text-center reveal" style="transition-delay: 200ms;">
          <div class="w-24 h-24 bg-blue-50 text-blue-600 font-bold text-2xl flex items-center justify-center rounded-full mx-auto mb-4 border border-blue-100">
            CH
          </div>
          <h4 class="font-bold text-lg text-gray-900">Christopher H.</h4>
          <p class="text-xs text-gray-400 mb-4 font-medium">Head of Security Architecture</p>
          <div class="flex items-center justify-center space-x-2 text-gray-400">
            <a href="#" class="hover:text-primary"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
            <a href="#" class="hover:text-primary"><i data-lucide="twitter" class="w-4 h-4"></i></a>
          </div>
        </div>

        <!-- Member 4 -->
        <div class="card-3d p-6 rounded-3xl text-center reveal" style="transition-delay: 300ms;">
          <div class="w-24 h-24 bg-blue-50 text-blue-600 font-bold text-2xl flex items-center justify-center rounded-full mx-auto mb-4 border border-blue-100">
            ME
          </div>
          <h4 class="font-bold text-lg text-gray-900">Melinda E.</h4>
          <p class="text-xs text-gray-400 mb-4 font-medium">Lead AI Engineer</p>
          <div class="flex items-center justify-center space-x-2 text-gray-400">
            <a href="#" class="hover:text-primary"><i data-lucide="linkedin" class="w-4 h-4"></i></a>
            <a href="#" class="hover:text-primary"><i data-lucide="twitter" class="w-4 h-4"></i></a>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Regulatory Certifications -->
  <section class="py-12 bg-slate-50 border-t border-gray-200 text-center">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
      <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Regulated by Global Authorities</p>
      <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60">
        <div class="flex items-center space-x-1.5 font-extrabold text-sm text-gray-600"><i data-lucide="shield" class="w-5 h-5 text-primary"></i><span>FDIC ASSURED</span></div>
        <div class="flex items-center space-x-1.5 font-extrabold text-sm text-gray-600"><i data-lucide="globe" class="w-5 h-5 text-primary"></i><span>SEC REGULATED</span></div>
        <div class="flex items-center space-x-1.5 font-extrabold text-sm text-gray-600"><i data-lucide="check-square" class="w-5 h-5 text-primary"></i><span>FCA COMPLIANT</span></div>
        <div class="flex items-center space-x-1.5 font-extrabold text-sm text-gray-600"><i data-lucide="lock" class="w-5 h-5 text-primary"></i><span>ISO 27001</span></div>
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
