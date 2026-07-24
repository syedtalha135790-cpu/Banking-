<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Types | Bank Management Services</title>
  <meta name="description" content="Compare BMS checking, savings, premium, and business account tiers. Find the perfect banking structure for your goals.">
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
          <a href="{{ route('accounts') }}" class="text-primary font-semibold transition-colors duration-200">Accounts</a>
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
      <a href="{{ route('accounts') }}" class="block px-4 py-3 rounded-xl bg-slate-50 text-primary font-semibold">Accounts</a>
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
      <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">Structured Account Tiers</h1>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto">
        Select a digital banking plan tailored to your trading volume, saving goals, or business expansion.
      </p>
    </div>
  </header>

  <!-- Tiers Grid -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid lg:grid-cols-4 gap-8 items-stretch">
        
        <!-- Standard Tier -->
        <div class="bg-white border border-gray-200 border-t-4 border-t-slate-400 p-8 rounded-[24px] shadow-[0_8px_30px_rgba(0,0,0,0.01)] hover:shadow-[0_20px_40px_rgba(100,116,139,0.08)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between reveal">
          <div class="space-y-6">
            <div>
              <span class="inline-block text-[9px] bg-slate-100 text-slate-600 font-bold px-2.5 py-1 rounded-full uppercase tracking-wider mb-3 w-fit">Basic checking</span>
              <h3 class="text-xl font-bold text-gray-900">Standard</h3>
              <p class="text-gray-400 text-xs mt-1 font-medium">For everyday personal checking</p>
            </div>
            <div>
              <span class="text-4xl font-extrabold text-gray-900">0</span>
              <span class="text-gray-400 text-sm">/ month</span>
            </div>
            <hr class="border-gray-200">
            <ul class="text-xs space-y-3.5 text-gray-500">
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>1.2% Vault Interest APY</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Free digital debit cards</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Domestic transfers free</li>
              <li class="flex items-center text-gray-300 line-through"><i data-lucide="x" class="w-4 h-4 text-rose-500 mr-2"></i>Zero overseas FX markups</li>
              <li class="flex items-center text-gray-300 line-through"><i data-lucide="x" class="w-4 h-4 text-rose-500 mr-2"></i>Metallic card issue</li>
            </ul>
          </div>
          <div class="pt-8">
            <a href="{{ route('register') }}" class="btn-3d-secondary block w-full py-3 text-center text-sm font-bold border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 rounded-2xl transition-all">
              Choose Standard
            </a>
          </div>
        </div>

        <!-- Premium Tier -->
        <div class="bg-white p-8 rounded-[24px] border-t-4 border-t-blue-600 border border-gray-200 relative shadow-[0_8px_30px_rgba(37,99,235,0.02)] hover:shadow-[0_20px_40px_rgba(37,99,235,0.12)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between reveal" style="transition-delay: 100ms;">
          <div class="space-y-6">
            <div>
              <span class="inline-block text-[9px] bg-blue-50 text-blue-600 font-bold px-2.5 py-1 rounded-full uppercase tracking-wider mb-3 w-fit">Most Popular</span>
              <h3 class="text-xl font-bold text-gray-900">Premium</h3>
              <p class="text-gray-400 text-xs mt-1 font-medium">For active traders and savers</p>
            </div>
            <div>
              <span class="text-4xl font-extrabold text-gray-900">9.99</span>
              <span class="text-gray-400 text-sm">/ month</span>
            </div>
            <hr class="border-gray-200">
            <ul class="text-xs space-y-3.5 text-gray-500">
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>2.8% Vault Interest APY</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Free metallic physical card</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Unlimited virtual cards</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Zero overseas FX markups</li>
              <li class="flex items-center text-gray-300 line-through"><i data-lucide="x" class="w-4 h-4 text-rose-500 mr-2"></i>Dedicated portfolio advisor</li>
            </ul>
          </div>
          <div class="pt-8">
            <a href="{{ route('register') }}" class="btn-3d-primary block w-full py-3 text-center text-sm font-bold bg-gradient-primary text-white rounded-2xl shadow-md transition-all">
              Go Premium
            </a>
          </div>
        </div>

        <!-- Wealth / VIP Tier -->
        <div class="bg-white border border-gray-200 border-t-4 border-t-amber-500 p-8 rounded-[24px] shadow-[0_8px_30px_rgba(245,158,11,0.02)] hover:shadow-[0_20px_40px_rgba(245,158,11,0.12)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between reveal" style="transition-delay: 200ms;">
          <div class="space-y-6">
            <div>
              <span class="inline-block text-[9px] bg-amber-50 text-amber-600 font-bold px-2.5 py-1 rounded-full uppercase tracking-wider mb-3 w-fit">Elite VIP</span>
              <h3 class="text-xl font-bold text-gray-900">Wealth / VIP</h3>
              <p class="text-gray-400 text-xs mt-1 font-medium">For high-net-worth portfolios</p>
            </div>
            <div>
              <span class="text-4xl font-extrabold text-gray-900">49.99</span>
              <span class="text-gray-400 text-sm">/ month</span>
            </div>
            <hr class="border-gray-200">
            <ul class="text-xs space-y-3.5 text-gray-500">
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>4.5% Vault Interest APY</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>24/7 dedicated wealth manager</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Unlimited metal/virtual cards</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Exclusive airport lounge passes</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Special loan interest deductions</li>
            </ul>
          </div>
          <div class="pt-8">
            <a href="{{ route('register') }}" class="btn-3d-gold block w-full py-3 text-center text-sm font-bold bg-gradient-to-r from-amber-500 to-yellow-500 text-white rounded-2xl shadow-md transition-all">
              Request Wealth VIP
            </a>
          </div>
        </div>

        <!-- Business Tier -->
        <div class="bg-white border border-gray-200 border-t-4 border-t-indigo-600 p-8 rounded-[24px] shadow-[0_8px_30px_rgba(79,70,229,0.02)] hover:shadow-[0_20px_40px_rgba(79,70,229,0.12)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between reveal" style="transition-delay: 300ms;">
          <div class="space-y-6">
            <div>
              <span class="inline-block text-[9px] bg-indigo-50 text-indigo-700 font-bold px-2.5 py-1 rounded-full uppercase tracking-wider mb-3 w-fit">Corporate Teams</span>
              <h3 class="text-xl font-bold text-gray-900">Business</h3>
              <p class="text-gray-400 text-xs mt-1 font-medium">For corporate platforms & teams</p>
            </div>
            <div>
              <span class="text-4xl font-extrabold text-gray-900">24.99</span>
              <span class="text-gray-400 text-sm">/ month</span>
            </div>
            <hr class="border-gray-200">
            <ul class="text-xs space-y-3.5 text-gray-500">
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Custom API sandbox access</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Multi-user approval workflows</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Integrates with accounting software</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Corporate physical card batching</li>
              <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-blue-600 mr-2"></i>Bulk payroll execution tools</li>
            </ul>
          </div>
          <div class="pt-8">
            <a href="{{ route('register') }}" class="btn-3d-indigo block w-full py-3 text-center text-sm font-bold bg-gradient-to-r from-indigo-600 to-blue-500 text-white rounded-2xl shadow-md transition-all">
              Launch Business
            </a>
          </div>
        </div>

      </div>

      <!-- Comparison Matrix -->
      <div class="mt-20 overflow-x-auto rounded-2xl border border-gray-200 shadow-sm reveal">
        <table class="w-full text-left border-collapse bg-white text-sm">
          <thead>
            <tr class="bg-slate-50 text-gray-900 border-b border-gray-200">
              <th class="p-4 font-bold">Key Capabilities</th>
              <th class="p-4 font-bold">Standard</th>
              <th class="p-4 font-bold">Premium</th>
              <th class="p-4 font-bold">Wealth / VIP</th>
              <th class="p-4 font-bold">Business</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 text-gray-600">
            <tr class="hover:bg-slate-50/50">
              <td class="p-4 font-medium text-gray-900">Monthly Fee</td>
              <td class="p-4 text-gray-500">0.00</td>
              <td class="p-4 text-gray-500">9.99</td>
              <td class="p-4 text-gray-500">49.99</td>
              <td class="p-4 text-gray-500">24.99</td>
            </tr>
            <tr class="hover:bg-slate-50/50">
              <td class="p-4 font-medium text-gray-900">Vault Interest APY</td>
              <td class="p-4 text-gray-500">1.2% APY</td>
              <td class="p-4 text-gray-500">2.8% APY</td>
              <td class="p-4 text-gray-500">4.5% APY</td>
              <td class="p-4 text-gray-500">1.5% APY</td>
            </tr>
            <tr class="hover:bg-slate-50/50">
              <td class="p-4 font-medium text-gray-900">Card Materials Available</td>
              <td class="p-4 text-gray-500">Recycled Plastics</td>
              <td class="p-4 text-gray-500">Space Grey Metal</td>
              <td class="p-4 text-slate-500">Solid Gold/Silver Metal</td>
              <td class="p-4 text-gray-500">Company Custom Branding</td>
            </tr>
            <tr class="hover:bg-slate-50/50">
              <td class="p-4 font-medium text-gray-900">ATM Withdrawal limits</td>
              <td class="p-4 text-gray-500">200 / month free</td>
              <td class="p-4 text-gray-500">600 / month free</td>
              <td class="p-4 text-gray-500">Unlimited free withdrawals</td>
              <td class="p-4 text-gray-500">1,500 / month free</td>
            </tr>
            <tr class="hover:bg-slate-50/50">
              <td class="p-4 font-medium text-gray-900">API Endpoint Access</td>
              <td class="p-4"><i data-lucide="x" class="w-4 h-4 text-rose-500"></i></td>
              <td class="p-4"><i data-lucide="x" class="w-4 h-4 text-rose-500"></i></td>
              <td class="p-4"><i data-lucide="check" class="w-4 h-4 text-blue-600"></i></td>
              <td class="p-4"><i data-lucide="check" class="w-4 h-4 text-blue-600"></i></td>
            </tr>
          </tbody>
        </table>
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
