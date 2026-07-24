<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password | Bank Management Services</title>
  <meta name="description" content="Recover your secure digital banking password. Enter email coordinates to request secure recovery links.">
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

  <main class="flex-grow flex items-stretch">
    <div class="grid lg:grid-cols-12 w-full">
      
      <!-- Left Screen (Desktop Only) -->
      <div class="hidden lg:flex lg:col-span-5 bg-slate-50 border-r border-gray-200 p-12 flex-col justify-between relative overflow-hidden">
        <div class="absolute inset-0 bg-black/[0.01]"></div>
        <div class="absolute -top-1/4 -left-1/4 w-96 h-96 bg-blue-50/60 rounded-full blur-3xl animate-pulse-soft"></div>
        <div class="absolute -bottom-1/4 -right-1/4 w-96 h-96 bg-cyan-50/50 rounded-full blur-3xl animate-pulse-soft"></div>

        <div class="relative z-10 space-y-2">
          <a href="{{ route('home') }}" class="flex items-center space-x-2">
            <div class="p-2.5 bg-gradient-primary rounded-xl text-white shadow-md shadow-primary/20">
              <i data-lucide="landmark" class="w-6 h-6"></i>
            </div>
            <span class="font-extrabold text-xl tracking-tight text-gradient-primary">BMS</span>
          </a>
        </div>

        <div class="relative z-10 space-y-6 max-w-sm animate-float">
          <h2 class="text-3xl font-extrabold leading-tight text-gray-900">Retrieve Access Coordinates</h2>
          <p class="text-gray-500 text-sm leading-relaxed">
            Enter your email coordinates and follow instructions. We will dispatch token hashes to reset credentials safely.
          </p>
        </div>

        <div class="relative z-10 text-xs text-gray-400 font-semibold">
          <p>&copy; 2026 Bank Management Services (BMS). All rights reserved.</p>
        </div>
      </div>

      <!-- Right Screen -->
      <div class="lg:col-span-7 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md bg-white border border-gray-200 p-8 rounded-[20px] shadow-lg space-y-6">
          <div class="text-center space-y-2">
            <h1 class="text-2xl font-bold text-gray-900">Recover Password</h1>
            <p class="text-gray-500 text-xs font-semibold">Enter your email to receive recovery instructions</p>
          </div>

          <div id="recovery-success-alert" class="hidden p-4 bg-emerald-50 text-emerald-800 rounded-xl text-xs font-semibold flex items-center space-x-2 border border-emerald-200">
            <i data-lucide="check-circle" class="w-5 h-5 flex-shrink-0"></i>
            <span>Recovery email dispatched! Check inbox directories.</span>
          </div>

          <form id="recovery-form" class="space-y-4" onsubmit="event.preventDefault(); document.getElementById('recovery-success-alert').classList.remove('hidden'); document.getElementById('recovery-form').reset();">
            <div>
              <label for="recovery-email" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Email Address</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400"><i data-lucide="mail" class="w-4 h-4"></i></span>
                <input type="email" id="recovery-email" required class="w-full pl-10 pr-4 py-3.5 border border-gray-200 rounded-xl bg-white text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="name@domain.com">
              </div>
            </div>

            <button type="submit" class="w-full py-4 bg-gradient-primary hover:opacity-95 text-white font-bold rounded-xl shadow-md transition-all flex items-center justify-center space-x-2">
              <span>Send Recovery Link</span>
              <i data-lucide="mail" class="w-4 h-4"></i>
            </button>
          </form>

          <hr class="border-gray-200">

          <div class="text-center text-xs">
            <span class="text-gray-500 font-semibold">Return to</span>
            <a href="{{ route('login') }}" class="text-primary font-bold hover:underline ml-1">Login Screen</a>
          </div>
        </div>
      </div>

    </div>
  </main>

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
</body>
</html>
