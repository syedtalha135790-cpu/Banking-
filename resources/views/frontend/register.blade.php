<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Open Account | Bank Management Services</title>
  <meta name="description" content="Open a premium digital checking, savings, premium, or business account with BMS online. Full onboarding takes under 10 minutes.">
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
      
      <!-- Left Screen: Branding & Features (Desktop Only) -->
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
          <h2 class="text-3xl font-extrabold leading-tight text-gray-900">Create Your Pockets & Vaults</h2>
          <p class="text-gray-500 text-sm leading-relaxed">
            Fill in the form to register. Confirm identity instantly via government documents, and start transacting global payments.
          </p>
          <div class="inline-flex items-center space-x-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-xs font-bold border border-blue-100 shadow-sm">
            <i data-lucide="shield" class="w-4 h-4 text-primary"></i>
            <span>GDPR Compliant & Protected</span>
          </div>
        </div>

        <div class="relative z-10 text-xs text-gray-400 font-semibold">
          <p>&copy; 2026 Bank Management Services (BMS). All rights reserved.</p>
        </div>
      </div>

      <!-- Right Screen: Auth Inputs -->
      <div class="lg:col-span-7 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md bg-white border border-gray-200 p-8 rounded-[20px] shadow-lg space-y-6">
          <div class="text-center space-y-2">
            <h1 class="text-2xl font-bold text-gray-900">Open A Digital Account</h1>
            <p class="text-gray-500 text-xs font-semibold">Fill in your information to start onboarding</p>
          </div>

          @if ($errors->any())
          <div class="p-4 bg-rose-50 text-rose-800 rounded-2xl border border-rose-200 text-xs font-semibold space-y-1">
            @foreach ($errors->all() as $error)
              <div>• {{ $error }}</div>
            @endforeach
          </div>
          @endif

          <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
              <label for="reg-name" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Full Name</label>
              <input type="text" id="reg-name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="John Doe">
            </div>

            <div>
              <label for="reg-email" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Email Address</label>
              <input type="email" id="reg-email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="name@domain.com">
            </div>

            <div>
              <label for="reg-phone" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Phone Number</label>
              <input type="tel" id="reg-phone" name="phone_number" value="{{ old('phone_number') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="+1 (555) 000-0000">
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label for="reg-password" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Password</label>
                <input type="password" id="reg-password" name="password" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="••••••••">
              </div>
              <div>
                <label for="reg-confirm" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Confirm Password</label>
                <input type="password" id="reg-confirm" name="password_confirmation" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="••••••••">
              </div>
            </div>

            <div class="flex items-start space-x-2">
              <input type="checkbox" id="reg-terms" required class="rounded border-gray-300 text-primary focus:ring-primary h-4 w-4 mt-0.5">
              <label for="reg-terms" class="text-xs text-gray-500 font-semibold leading-relaxed">
                I agree to the <a href="#" class="text-primary font-bold hover:underline">Terms of Service</a> and <a href="#" class="text-primary font-bold hover:underline">Privacy Policy</a>
              </label>
            </div>

            <button type="submit" class="w-full py-4 bg-gradient-primary hover:opacity-95 text-white font-bold rounded-xl shadow-md transition-all flex items-center justify-center space-x-2">
              <span>Register</span>
              <i data-lucide="shield-check" class="w-4 h-4"></i>
            </button>
          </form>

          <hr class="border-gray-200">

          <div class="text-center text-xs">
            <span class="text-gray-500 font-semibold">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-primary font-bold hover:underline ml-1">Login Securely</a>
          </div>
        </div>
      </div>

    </div>
  </main>

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
</body>
</html>
