<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mortgages & Loans | Bank Management Services</title>
  <meta name="description" content="Calculate loan interest and apply for personal, home, student, business, or car financing with BMS's secure online systems.">
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
          <a href="{{ route('loans') }}" class="text-primary font-semibold transition-colors duration-200">Loans</a>
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
      <a href="{{ route('loans') }}" class="block px-4 py-3 rounded-xl bg-slate-50 text-primary font-semibold">Loans</a>
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
      <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">Tailored Loans & Financing</h1>
      <p class="text-lg text-blue-100 max-w-2xl mx-auto">
        Acquire capital for critical milestones. Flexible periods, low fixed interest rates, and paperless signoff.
      </p>
    </div>
  </header>

  <!-- Content & Calculator -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <div class="grid lg:grid-cols-12 gap-12">
        
        <!-- Loan Options -->
        <div class="lg:col-span-7 space-y-8">
          <h2 class="text-2xl font-bold text-gray-900">Structured Lending Pockets</h2>
          
          <div class="space-y-4">
            <!-- Home Loan -->
            <div class="bg-white border border-gray-200 p-6 rounded-[20px] flex space-x-4 shadow-sm hover-scale reveal">
              <div class="p-3 bg-blue-50 text-blue-600 rounded-xl h-12 w-12 flex items-center justify-center flex-shrink-0">
                <i data-lucide="home" class="w-6 h-6"></i>
              </div>
              <div>
                <h3 class="font-bold text-lg text-gray-900">Home Loans & Mortgages</h3>
                <p class="text-gray-500 text-sm mt-1">
                  Finance up to 90% of property valuations. Standard periods range up to 30 years with fixed interest rates as low as 3.2% APR.
                </p>
              </div>
            </div>

            <!-- Business Loan -->
            <div class="bg-white border border-gray-200 p-6 rounded-[20px] flex space-x-4 shadow-sm hover-scale reveal" style="transition-delay: 100ms;">
              <div class="p-3 bg-blue-50 text-blue-600 rounded-xl h-12 w-12 flex items-center justify-center flex-shrink-0">
                <i data-lucide="briefcase" class="w-6 h-6"></i>
              </div>
              <div>
                <h3 class="font-bold text-lg text-gray-900">Corporate & SME Expansion Loans</h3>
                <p class="text-gray-500 text-sm mt-1">
                  Inject growth capital, upgrade logistics fleets, or finance client operations. Unsecured and secured lending pipelines up to 5M.
                </p>
              </div>
            </div>

            <!-- Car Loan -->
            <div class="bg-white border border-gray-200 p-6 rounded-[20px] flex space-x-4 shadow-sm hover-scale reveal" style="transition-delay: 200ms;">
              <div class="p-3 bg-blue-50 text-blue-600 rounded-xl h-12 w-12 flex items-center justify-center flex-shrink-0">
                <i data-lucide="car" class="w-6 h-6"></i>
              </div>
              <div>
                <h3 class="font-bold text-lg text-gray-900">Vehicle Loans</h3>
                <p class="text-gray-500 text-sm mt-1">
                  Drive off with instant pre-approvals on electric, new, or pre-owned vehicles. Quick digital invoice uploads and dealer direct payouts.
                </p>
              </div>
            </div>

            <!-- Student Loan -->
            <div class="bg-white border border-gray-200 p-6 rounded-[20px] flex space-x-4 shadow-sm hover-scale reveal" style="transition-delay: 300ms;">
              <div class="p-3 bg-blue-50 text-blue-600 rounded-xl h-12 w-12 flex items-center justify-center flex-shrink-0">
                <i data-lucide="graduation-cap" class="w-6 h-6"></i>
              </div>
              <div>
                <h3 class="font-bold text-lg text-gray-900">Student Tuition Loans</h3>
                <p class="text-gray-500 text-sm mt-1">
                  Finance undergraduate or doctorate degrees. Enjoy flexible repayments: begin paying only after you secure post-degree jobs.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Calculator Widget -->
        <div class="lg:col-span-5">
          <div class="bg-white border border-gray-200 p-8 rounded-3xl shadow-lg space-y-6 sticky top-28 reveal-right">
            <div>
              <h3 class="text-xl font-bold text-gray-900">Repayment Calculator</h3>
              <p class="text-gray-400 text-xs mt-1 font-semibold">Calculate amortization structures in seconds</p>
            </div>

            <!-- Calculator Inputs -->
            <div class="space-y-4">
              <div>
                <label for="calc-loan-type" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Loan Option</label>
                <select id="calc-loan-type" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900">
                  <option value="3.2" selected>Home Loan (3.2%)</option>
                  <option value="5.5">Personal Loan (5.5%)</option>
                  <option value="4.2">Car Loan (4.2%)</option>
                  <option value="6.0">Business Loan (6.0%)</option>
                  <option value="2.5">Student Loan (2.5%)</option>
                </select>
              </div>

              <div>
                <label for="calc-amount" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Principal Amount</label>
                <input type="number" id="calc-amount" value="50000" min="1000" max="5000000" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary font-semibold text-gray-900">
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label for="calc-term" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Period (Years)</label>
                  <input type="number" id="calc-term" value="5" min="1" max="30" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary font-semibold text-gray-900">
                </div>
                <div>
                  <label for="calc-rate" class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Interest Rate (%)</label>
                  <input type="number" id="calc-rate" value="3.2" step="0.1" min="0.1" max="25" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary font-semibold text-gray-900">
                </div>
              </div>
            </div>

            <!-- Results Output -->
            <div class="p-6 bg-slate-50 border border-gray-200 rounded-2xl space-y-4">
              <div class="flex justify-between items-center">
                <span class="text-sm text-gray-400 font-semibold">Monthly Installment</span>
                <span id="res-monthly" class="text-2xl font-extrabold text-primary">0.00</span>
              </div>
              <hr class="border-gray-200">
              <div class="text-xs space-y-2 text-gray-400 font-semibold">
                <div class="flex justify-between">
                  <span>Total Principal Paid</span>
                  <span id="res-principal" class="font-semibold text-gray-700">0.00</span>
                </div>
                <div class="flex justify-between">
                  <span>Total Interest Paid</span>
                  <span id="res-interest" class="font-semibold text-gray-700">0.00</span>
                </div>
                <div class="flex justify-between font-semibold text-gray-900 pt-1">
                  <span>Cumulative Repayable</span>
                  <span id="res-total" class="font-bold text-gray-900">0.00</span>
                </div>
              </div>
            </div>

            <a href="{{ route('register') }}" class="block w-full py-4 text-center bg-gradient-primary hover:opacity-95 text-white font-bold rounded-xl shadow-md transition-all">
              Apply For Loan
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
  <!-- Calculator Logic -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const typeSelect = document.getElementById('calc-loan-type');
      const amountInput = document.getElementById('calc-amount');
      const termInput = document.getElementById('calc-term');
      const rateInput = document.getElementById('calc-rate');

      const resMonthly = document.getElementById('res-monthly');
      const resPrincipal = document.getElementById('res-principal');
      const resInterest = document.getElementById('res-interest');
      const resTotal = document.getElementById('res-total');

      const calculateLoan = () => {
        const principal = parseFloat(amountInput.value) || 0;
        const years = parseFloat(termInput.value) || 0;
        const rate = parseFloat(rateInput.value) || 0;

        if (principal <= 0 || years <= 0) {
          resMonthly.textContent = '0.00';
          resPrincipal.textContent = '0.00';
          resInterest.textContent = '0.00';
          resTotal.textContent = '0.00';
          return;
        }

        const monthlyRate = (rate / 100) / 12;
        const totalPayments = years * 12;

        let monthlyInstallment = 0;
        if (monthlyRate === 0) {
          monthlyInstallment = principal / totalPayments;
        } else {
          monthlyInstallment = principal * (monthlyRate * Math.pow(1 + monthlyRate, totalPayments)) / (Math.pow(1 + monthlyRate, totalPayments) - 1);
        }

        const totalRepayable = monthlyInstallment * totalPayments;
        const totalInterest = totalRepayable - principal;

        resMonthly.textContent = monthlyInstallment.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        resPrincipal.textContent = principal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        resInterest.textContent = totalInterest.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        resTotal.textContent = totalRepayable.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      };

      typeSelect.addEventListener('change', () => {
        rateInput.value = typeSelect.value;
        calculateLoan();
      });

      [amountInput, termInput, rateInput].forEach(input => {
        input.addEventListener('input', calculateLoan);
      });

      calculateLoan();
    });
  </script>
</body>
</html>
