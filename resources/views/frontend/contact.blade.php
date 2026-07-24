<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | Bank Management Services</title>
  <meta name="description" content="Reach out to BMS customer support, locate branches, or contact business partnerships teams through our secure contact channels.">
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
          <a href="{{ route('contact') }}" class="text-primary font-semibold transition-colors duration-200">Contact</a>
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
      <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-xl bg-slate-50 text-primary font-semibold">Contact</a>
      <div class="pt-4 flex flex-col space-y-3">
        <a href="{{ route('login') }}" class="text-center py-3 rounded-xl font-semibold border border-gray-200 text-gray-700 hover:bg-slate-555">Login</a>
        <a href="{{ route('register') }}" class="text-center py-3 bg-gradient-primary text-white font-semibold rounded-xl">Open Account</a>
      </div>
    </div>
  </nav>

  <!-- Sub-Hero Section -->
  <header class="relative overflow-hidden py-16 lg:py-24 bg-gradient-primary text-white">
    <div class="absolute inset-0 bg-black/5"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 space-y-4">
      <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">Contact Our Teams</h1>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto">
        Got questions? Get in touch with our helpdesk, locate global branches, or schedule partnership calls.
      </p>
    </div>
  </header>

  <!-- Form & Directory -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid lg:grid-cols-12 gap-12">
        <!-- Contact Form -->
        <div class="bg-white border border-gray-200 p-8 rounded-[20px] shadow-lg space-y-6 reveal-left">
          <div>
            <h3 class="text-xl font-bold text-gray-900">Send A Message</h3>
            <p class="text-gray-400 text-xs mt-1 font-semibold">Our support team typically responds inside 2 hours</p>
          </div>

          <!-- Alert Container for success -->
          <div id="contact-success-alert" class="hidden p-4 bg-emerald-50 text-emerald-800 rounded-xl text-xs font-semibold flex items-center space-x-2 border border-emerald-200">
            <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
            <span>Thank you! Your inquiry was sent successfully. We will follow up shortly.</span>
          </div>

          <form id="contact-form" class="space-y-4" onsubmit="event.preventDefault(); document.getElementById('contact-success-alert').classList.remove('hidden'); document.getElementById('contact-form').reset();">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label for="contact-name" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Full Name</label>
                <input type="text" id="contact-name" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10">
              </div>
              <div>
                <label for="contact-email" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Email Address</label>
                <input type="email" id="contact-email" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10">
              </div>
            </div>

            <div>
              <label for="contact-subject" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Subject</label>
              <input type="text" id="contact-subject" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10">
            </div>

            <div>
              <label for="contact-message" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Message Content</label>
              <textarea id="contact-message" rows="5" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10"></textarea>
            </div>

            <button type="submit" class="w-full py-4 bg-gradient-primary hover:opacity-95 text-white font-bold rounded-xl shadow-md transition-all">
              Send Message
            </button>
          </form>
        </div>

        <!-- Directory & Map -->
        <div class="lg:col-span-5 space-y-6 reveal-right">
          
          <!-- Channels -->
          <div class="space-y-4">
            <div class="bg-white border border-gray-200 p-5 rounded-[20px] flex items-center space-x-4 shadow-sm">
              <div class="p-2.5 bg-blue-50 text-blue-600 rounded-lg">
                <i data-lucide="phone" class="w-5 h-5"></i>
              </div>
              <div>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Call Support</p>
                <p class="text-sm font-semibold text-gray-900">+1 (800) 555-8820</p>
              </div>
            </div>

            <div class="bg-white border border-gray-200 p-5 rounded-[20px] flex items-center space-x-4 shadow-sm">
              <div class="p-2.5 bg-blue-50 text-blue-600 rounded-lg">
                <i data-lucide="mail" class="w-5 h-5"></i>
              </div>
              <div>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Email Helpdesk</p>
                <p class="text-sm font-semibold text-gray-900">support@bankmanagementservices.com</p>
              </div>
            </div>

            <div class="bg-white border border-gray-200 p-5 rounded-[20px] flex items-center space-x-4 shadow-sm">
              <div class="p-2.5 bg-blue-50 text-blue-600 rounded-lg">
                <i data-lucide="map-pin" class="w-5 h-5"></i>
              </div>
              <div>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Headquarters</p>
                <p class="text-sm font-semibold text-gray-900">100 Financial Plaza, London, EC2V 6DL</p>
              </div>
            </div>
          </div>

          <!-- Mock Map (Beautiful Placeholder Graphic) -->
          <div class="relative w-full aspect-video rounded-3xl overflow-hidden border border-gray-200 bg-slate-100 flex items-center justify-center">
            <!-- Map Lines SVG Grid -->
            <svg class="absolute inset-0 w-full h-full text-gray-300" viewBox="0 0 400 200" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M 0 50 Q 150 120 400 30" stroke="currentColor" stroke-dasharray="4" stroke-width="1"/>
              <path d="M 0 160 Q 200 40 400 180" stroke="currentColor" stroke-dasharray="4" stroke-width="1"/>
              <circle cx="200" cy="100" r="40" fill="url(#map-glow)" fill-opacity="0.15"/>
              <circle cx="200" cy="100" r="10" fill="#2563EB"/>
              <circle cx="200" cy="100" r="5" fill="#ffffff"/>
              <defs>
                <radialGradient id="map-glow" cx="0.5" cy="0.5" r="0.5">
                  <stop offset="0%" stop-color="#2563EB"/>
                  <stop offset="100%" stop-color="#2563EB" stop-opacity="0"/>
                </radialGradient>
              </defs>
            </svg>
            <div class="relative z-10 bg-white border border-gray-200 px-4 py-2.5 rounded-xl shadow-md text-[10px] font-bold flex items-center space-x-1.5">
              <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i>
              <span>HQ Location Pin</span>
            </div>
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
