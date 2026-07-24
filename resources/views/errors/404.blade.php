<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Transaction Unrouted | Bank Management Services</title>
  <meta name="description" content="The requested banking folder or URL statement could not be resolved in our database directories.">
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
<body class="bg-white text-gray-900 transition-colors duration-300 min-h-screen flex flex-col justify-between relative overflow-x-hidden">
  <div class="glow-sphere glow-blue w-[400px] h-[400px] -top-40 -left-40"></div>
  <div class="glow-sphere glow-cyan w-[400px] h-[400px] bottom-10 -right-40"></div>

  
  </div>

  <!-- Header -->
  <header class="h-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full flex items-center justify-between">
    <a href="{{ route('home') }}" class="flex items-center space-x-2">
      <div class="p-2.5 bg-gradient-primary rounded-xl text-white shadow-md">
        <i data-lucide="landmark" class="w-6 h-6"></i>
      </div>
      <span class="font-extrabold text-xl tracking-tight text-gradient-primary">BMS</span>
    </a>
  </header>

  <!-- Error Content -->
  <main class="flex-grow flex items-center justify-center p-8">
    <div class="max-w-md w-full bg-white border border-gray-200 p-8 rounded-[20px] shadow-xl text-center space-y-6 reveal">
      
      <!-- Graphic Broken Card -->
      <div class="relative w-36 h-36 mx-auto flex items-center justify-center animate-float">
        <div class="absolute inset-0 bg-rose-500/10 rounded-full blur-2xl"></div>
        <svg class="w-full h-full text-rose-500" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
          <!-- Card outline -->
          <rect x="15" y="25" width="70" height="50" rx="6" stroke="currentColor" stroke-width="4" stroke-dasharray="100" />
          <!-- Slash/Break through the card -->
          <path d="M 40 20 L 60 80" stroke="currentColor" stroke-width="4" />
          <path d="M 25 35 H 35" stroke="currentColor" stroke-width="4" />
          <rect x="25" y="45" width="10" height="8" rx="2" fill="currentColor" />
        </svg>
      </div>

      <div class="space-y-2">
        <h1 class="text-3xl font-extrabold text-gray-900 leading-none">Error 404</h1>
        <p class="text-xs font-bold text-rose-500 uppercase tracking-widest">Transaction Routing Failure</p>
      </div>

      <p class="text-gray-500 text-sm leading-relaxed">
        We searched our data directories, but the requested statement URL or path does not exist in our system.
      </p>

      <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
        <a href="{{ route('home') }}" class="w-full sm:w-auto px-6 py-3.5 bg-gradient-primary hover:opacity-95 text-white font-bold text-xs rounded-xl shadow-md transition-all">
          Return to Home
        </a>
        <a href="{{ route('contact') }}" class="w-full sm:w-auto px-6 py-3.5 border border-gray-200 hover:bg-slate-50 text-gray-700 font-bold text-xs rounded-xl transition-all">
          Contact Support
        </a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="h-20 flex items-center justify-center text-xs text-gray-400">
    <p>&copy; 2026 Bank Management Services (BMS). All rights reserved.</p>
  </footer>

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
</body>
</html>
