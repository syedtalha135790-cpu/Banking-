<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify OTP | Bank Management Services</title>
  <meta name="description" content="Verify multi-factor security codes (OTP) to authorize secure access sessions to your BMS bank accounts.">
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
          <h2 class="text-3xl font-extrabold leading-tight text-gray-900">Multi-Factor Authorization</h2>
          <p class="text-gray-500 text-sm leading-relaxed">
            We dispatched a 4-digit code to your registered mobile coordinates. Enter it on the right to complete verification.
          </p>
        </div>

        <div class="relative z-10 text-xs text-gray-400 font-semibold">
          <p>&copy; 2026 Bank Management Services (BMS). All rights reserved.</p>
        </div>
      </div>

      <!-- Right Screen -->
      <div class="lg:col-span-7 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md bg-white border border-gray-200 p-8 rounded-[20px] shadow-lg space-y-6">
          @if ($errors->has('otp'))
          <div class="p-4 bg-rose-50 text-rose-800 rounded-2xl border border-rose-200 text-xs font-semibold">
            {{ $errors->first('otp') }}
          </div>
          @endif

          @if (session('resent'))
          <div class="p-4 bg-blue-50 text-blue-800 rounded-2xl border border-blue-200 text-xs font-semibold">
            {{ session('resent') }}
          </div>
          @endif

          <form action="{{ route('verification.verify') }}" method="POST" class="space-y-6">
            @csrf
            <div class="flex justify-center space-x-4" id="otp-wrapper">
              <input type="text" name="otp[]" maxlength="1" class="otp-input w-16 h-16 border border-gray-200 bg-white rounded-2xl text-gray-900 focus:outline-none focus:border-primary font-bold text-2xl text-center focus:ring-2 focus:ring-primary/10" required>
              <input type="text" name="otp[]" maxlength="1" class="otp-input w-16 h-16 border border-gray-200 bg-white rounded-2xl text-gray-900 focus:outline-none focus:border-primary font-bold text-2xl text-center focus:ring-2 focus:ring-primary/10" required>
              <input type="text" name="otp[]" maxlength="1" class="otp-input w-16 h-16 border border-gray-200 bg-white rounded-2xl text-gray-900 focus:outline-none focus:border-primary font-bold text-2xl text-center focus:ring-2 focus:ring-primary/10" required>
              <input type="text" name="otp[]" maxlength="1" class="otp-input w-16 h-16 border border-gray-200 bg-white rounded-2xl text-gray-900 focus:outline-none focus:border-primary font-bold text-2xl text-center focus:ring-2 focus:ring-primary/10" required>
            </div>

            <button type="submit" class="w-full py-4 bg-gradient-primary hover:opacity-95 text-white font-bold rounded-xl shadow-md transition-all flex items-center justify-center space-x-2">
              <span>Verify OTP & Activate</span>
              <i data-lucide="check" class="w-4 h-4"></i>
            </button>
          </form>

          <hr class="border-gray-200">

          <div class="text-center text-xs">
            <span class="text-gray-500 font-semibold">Didn't receive the SMS code?</span>
            <form id="resend-form" action="{{ route('verification.resend') }}" method="POST" class="hidden">
              @csrf
            </form>
            <button type="button" onclick="document.getElementById('resend-form').submit();" class="text-primary font-bold hover:underline ml-1">Resend Code</button>
          </div>
        </div>
      </div>

    </div>
  </main>

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
  <!-- OTP Focus Manager -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const inputs = document.querySelectorAll('#otp-wrapper input');
      inputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
          const val = e.target.value;
          if (val.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
          }
        });

        input.addEventListener('keydown', (e) => {
          if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
            inputs[index - 1].focus();
          } else if (e.key === 'ArrowLeft' && index > 0) {
            inputs[index - 1].focus();
          } else if (e.key === 'ArrowRight' && index < inputs.length - 1) {
            inputs[index + 1].focus();
          }
        });

        input.addEventListener('paste', (e) => {
          e.preventDefault();
          const clipboardData = e.clipboardData || window.clipboardData;
          const pastedText = clipboardData.getData('text');
          const digits = pastedText.replace(/\D/g, '').split('');
          
          inputs.forEach((inp, idx) => {
            if (digits[idx]) {
              inp.value = digits[idx];
              if (idx < inputs.length - 1) {
                inputs[idx + 1].focus();
              }
            }
          });
        });
      });
      if (inputs[0]) inputs[0].focus();
    });
  </script>
</body>
</html>
