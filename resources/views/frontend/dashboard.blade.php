<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard | Bank Management Services</title>
  <meta name="description" content="View your digital balances, execute quick transfers, analyze monthly financial statistics, and manage debit cards.">
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
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
</head>
<body class="bg-slate-50 text-gray-900 transition-colors duration-300 min-h-screen flex">

  
  </div>

  <!-- Sidebar Drawer -->
  <aside id="sidebar-drawer" class="hidden md:flex flex-col w-64 border-r border-gray-200 bg-white flex-shrink-0 transition-transform duration-300">
    <!-- Brand Logo -->
    <div class="h-20 flex items-center px-6 border-b border-gray-150">
      <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <div class="p-2 bg-gradient-primary rounded-xl text-white">
          <i data-lucide="landmark" class="w-5 h-5"></i>
        </div>
        <span class="font-extrabold text-lg text-gradient-primary">BMS</span>
      </a>
    </div>

    <!-- Nav Nodes -->
    <nav class="flex-grow p-4 space-y-1.5">
      <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-primary text-white font-bold shadow-md shadow-primary/10">
        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
        <span class="text-sm">Overview</span>
      </a>
      <a href="{{ route('transactions') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-slate-50 hover:text-gray-900 transition-all font-semibold">
        <i data-lucide="history" class="w-5 h-5"></i>
        <span class="text-sm">Transactions</span>
      </a>
      <a href="{{ route('accounts') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-slate-50 hover:text-gray-900 transition-all font-semibold">
        <i data-lucide="piggy-bank" class="w-5 h-5"></i>
        <span class="text-sm">Vaults</span>
      </a>
      <a href="{{ route('loans') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-slate-50 hover:text-gray-900 transition-all font-semibold">
        <i data-lucide="percent" class="w-5 h-5"></i>
        <span class="text-sm">Lending</span>
      </a>
      <a href="{{ route('online-banking') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-slate-50 hover:text-gray-900 transition-all font-semibold">
        <i data-lucide="smartphone" class="w-5 h-5"></i>
        <span class="text-sm">App Info</span>
      </a>
      <hr class="border-gray-200 my-2">
      <a href="{{ route('admin') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-slate-50 hover:text-gray-900 transition-all font-semibold">
        <i data-lucide="shield-check" class="w-5 h-5"></i>
        <span class="text-sm">Admin Portal</span>
      </a>
    </nav>

    <!-- Sidebar footer user card -->
    <div class="p-4 border-t border-gray-150 bg-slate-50/50">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 font-bold text-center flex items-center justify-center border border-blue-100">
          JD
        </div>
        <div class="flex-grow min-w-0">
          <p class="font-bold text-xs truncate text-gray-900">John Doe</p>
          <p class="text-[10px] text-gray-400 truncate font-semibold">Standard Account</p>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
          </form>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-400 hover:text-rose-500" title="Logout">
          <i data-lucide="log-out" class="w-4 h-4"></i>
        </a>
      </div>
    </div>
  </aside>

  <!-- Main Container -->
  <div class="flex-grow flex flex-col min-w-0">
    
    <!-- Top Navbar -->
    <header class="h-20 border-b border-gray-200 bg-white px-6 flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <button id="dashboard-menu-toggle" class="md:hidden p-2 rounded-lg border border-gray-200" aria-label="Open Sidebar">
          <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        <h2 class="font-bold text-lg text-gray-900">Dashboard Overview</h2>
      </div>

      <div class="flex items-center space-x-4">
        
        <!-- Notification Panel Trigger -->
        <div class="relative">
          <button id="notification-btn" class="p-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-slate-50 transition-colors">
            <i data-lucide="bell" class="w-5 h-5"></i>
            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-rose-500 rounded-full border border-white"></span>
          </button>
          <!-- Notification Dropdown Panel -->
          <div id="notification-panel" class="hidden absolute right-0 mt-3.5 w-80 bg-white border border-gray-200 rounded-2xl shadow-xl z-50 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-150 flex justify-between items-center bg-slate-50">
              <span class="font-bold text-sm text-gray-900">Inbox Updates</span>
              <button onclick="alert('All read');" class="text-[10px] text-primary font-bold hover:underline">Mark all read</button>
            </div>
            <div class="divide-y divide-gray-100 text-xs max-h-60 overflow-y-auto">
              <div class="p-4 hover:bg-slate-50/50 transition-colors flex space-x-3">
                <i data-lucide="trending-up" class="w-5 h-5 text-blue-600 flex-shrink-0"></i>
                <div>
                  <p class="font-bold text-gray-900">Interest Vault Compounded</p>
                  <p class="text-[10px] text-gray-400 mt-0.5">Your vacation saving pocket grew by +24.50 APY</p>
                </div>
              </div>
              <div class="p-4 hover:bg-slate-50/50 transition-colors flex space-x-3">
                <i data-lucide="shield-check" class="w-5 h-5 text-primary flex-shrink-0"></i>
                <div>
                  <p class="font-bold text-gray-900">Successful Security Login</p>
                  <p class="text-[10px] text-gray-400 mt-0.5">New session launched from location: Berlin, Germany</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Balance hide toggle -->
        <button id="toggle-balance-btn" class="p-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-slate-50 transition-colors" title="Hide/Show Balances">
          <i data-lucide="eye" class="w-5 h-5"></i>
        </button>

      </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow p-6 space-y-6 overflow-y-auto">
      
      <!-- Transfer notification toast -->
      <div id="transfer-success-alert" class="hidden p-4 bg-emerald-50 text-emerald-800 rounded-2xl border border-emerald-200 text-sm font-semibold flex items-center space-x-2">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
        <span class="alert-msg">Transfer completed successfully!</span>
      </div>

      <!-- Profile Completion Banner (Step 3) -->
      <div id="profile-complete-banner" class="bg-white border border-gray-200 p-6 rounded-[24px] shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4 reveal">
        <div class="flex items-center space-x-3.5">
          <div class="p-3 bg-amber-50 text-amber-500 rounded-2xl"><i data-lucide="user-plus" class="w-6 h-6"></i></div>
          <div>
            <h4 class="font-bold text-sm text-gray-900">Complete Your Account Setup</h4>
            <p class="text-xs text-gray-400 font-semibold mt-0.5">Please add your contact address and occupation details to activate advanced transfers.</p>
          </div>
        </div>
        <button onclick="document.getElementById('profile-modal').classList.remove('hidden')" class="btn-3d-primary px-4 py-2.5 bg-gradient-primary text-white text-xs font-bold rounded-xl shadow-md">
          Complete Profile
        </button>
      </div>

      <div class="grid lg:grid-cols-12 gap-6">
        
        <!-- Left Widgets Grid -->
        <div class="lg:col-span-4 space-y-6">
          
          <!-- Balance Card Widget -->
          <div id="mock-debit-card" class="bg-gradient-primary text-white p-6 rounded-[20px] shadow-lg flex flex-col justify-between aspect-[1.58] relative overflow-hidden transition-all duration-300 hover-scale">
            <!-- Chip & Logo -->
            <div class="flex justify-between items-start">
              <div class="p-1 bg-white/20 backdrop-blur-md rounded-lg">
                <i data-lucide="landmark" class="w-6 h-6"></i>
              </div>
              <span class="font-extrabold text-lg tracking-tight">BMS Visa</span>
            </div>

            <!-- Card Number -->
            <div class="my-4">
              <span class="font-bold text-lg sm:text-xl tracking-[4px]">••••  ••••  ••••  8829</span>
            </div>

            <!-- Card Details -->
            <div class="flex justify-between items-end">
              <div>
                <p class="text-[10px] opacity-75 uppercase tracking-widest font-semibold">Total Balance</p>
                <p class="text-xl sm:text-2xl font-bold balance-value">12,850.45</p>
              </div>
              <div class="text-right">
                <p class="text-[9px] opacity-75 uppercase tracking-widest font-semibold">Expires</p>
                <p class="text-xs font-bold font-mono">08/29</p>
              </div>
            </div>
          </div>

          <!-- Quick Transfer Widget -->
          <div class="bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
            <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400 flex items-center space-x-1.5">
              <i data-lucide="send" class="w-4 h-4 text-primary"></i>
              <span>Quick Transfer</span>
            </h3>
            
            <form id="quick-transfer-form" class="space-y-3">
              <div>
                <input type="text" id="transfer-recipient" required placeholder="Recipient Email or IBAN" class="w-full px-4 py-3 border border-gray-200 bg-slate-50 rounded-xl text-xs focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10">
              </div>
              <div class="relative">
                <input type="number" id="transfer-amount" required placeholder="0.00" min="1" max="10000" class="w-full pl-8 pr-12 py-3 border border-gray-200 bg-slate-50 rounded-xl text-xs focus:outline-none focus:border-primary text-gray-900 font-bold focus:ring-2 focus:ring-primary/10">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-gray-400 text-xs font-bold">$</span>
                <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 text-xs font-bold">USD</span>
              </div>
              <button type="submit" class="btn-3d-primary w-full py-3 bg-gradient-primary text-white font-bold text-xs rounded-xl shadow-md transition-all">
                Send Cash Instantly
              </button>
            </form>
          </div>

        </div>

        <!-- Middle Widgets Grid (Analytics Chart & Vaults Status) -->
        <div class="lg:col-span-8 space-y-6">
          
          <!-- Analytics Line Chart -->
          <div class="bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
            <div class="flex justify-between items-center">
              <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400 flex items-center space-x-1.5">
                <i data-lucide="bar-chart-3" class="w-4 h-4 text-primary"></i>
                <span>Spending Analytics</span>
              </h3>
              <span class="text-[10px] bg-blue-50 text-blue-600 font-bold px-2 py-0.5 rounded-full">compounding monthly</span>
            </div>
            <!-- Canvas container -->
            <div class="relative h-60 w-full">
              <canvas id="analytics-chart"></canvas>
            </div>
          </div>

          <!-- Bottom Grid: Quick Actions & Savings vaults -->
          <div class="grid md:grid-cols-2 gap-6">
            
            <!-- Quick Actions Panel -->
            <div class="bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
              <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400">Card Controls</h3>
              <div class="grid grid-cols-2 gap-3">
                <button id="freeze-card-btn" class="p-4 bg-slate-100 hover:bg-slate-200 rounded-2xl text-center space-y-2 hover-scale transition-colors">
                  <i data-lucide="lock" class="w-5 h-5 mx-auto text-primary"></i>
                  <p class="text-xs font-bold text-gray-900">Freeze Card</p>
                </button>
                <button onclick="alert('Card limits customized!');" class="p-4 bg-slate-100 hover:bg-slate-200 rounded-2xl text-center space-y-2 hover-scale transition-colors">
                  <i data-lucide="sliders" class="w-5 h-5 mx-auto text-primary"></i>
                  <p class="text-xs font-bold text-gray-900">Limit Cap</p>
                </button>
                <button onclick="alert('NFC Card generated!');" class="p-4 bg-slate-100 hover:bg-slate-200 rounded-2xl text-center space-y-2 hover-scale transition-colors">
                  <i data-lucide="wallet" class="w-5 h-5 mx-auto text-primary"></i>
                  <p class="text-xs font-bold text-gray-900">NFC Generate</p>
                </button>
                <button onclick="alert('PIN reset code sent via SMS');" class="p-4 bg-slate-100 hover:bg-slate-200 rounded-2xl text-center space-y-2 hover-scale transition-colors">
                  <i data-lucide="key-round" class="w-5 h-5 mx-auto text-primary"></i>
                  <p class="text-xs font-bold text-gray-900">Reset PIN</p>
                </button>
              </div>
            </div>

            <!-- Savings Vault Tracker -->
            <div class="bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
              <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400">Vault Pockets</h3>
              <div class="space-y-4">
                
                <!-- Pocket 1 -->
                <div class="space-y-1.5">
                  <div class="flex justify-between items-center text-xs font-bold text-gray-900">
                    <span>Vacation Pocket (2.8% APY)</span>
                    <span>75%</span>
                  </div>
                  <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-primary h-full rounded-full" style="width: 75%;"></div>
                  </div>
                  <div class="flex justify-between text-[10px] text-gray-400 font-semibold">
                    <span>Target: 10,000</span>
                    <span>Saved: 7,500</span>
                  </div>
                </div>

                <!-- Pocket 2 -->
                <div class="space-y-1.5">
                  <div class="flex justify-between items-center text-xs font-bold text-gray-900">
                    <span>Car Mortage Reserve</span>
                    <span>40%</span>
                  </div>
                  <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-accent h-full rounded-full" style="width: 40%;"></div>
                  </div>
                  <div class="flex justify-between text-[10px] text-gray-400 font-semibold">
                    <span>Target: 25,000</span>
                    <span>Saved: 10,000</span>
                  </div>
                </div>

              </div>
            </div>

          </div>

        </div>

      </div>

      <!-- Recent Transactions Widget (Underneath) -->
      <div class="bg-white border border-gray-200 p-6 rounded-3xl shadow-sm space-y-4">
        <div class="flex justify-between items-center">
          <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400 flex items-center space-x-1.5">
            <i data-lucide="history" class="w-4 h-4 text-primary"></i>
            <span>Recent Transactions</span>
          </h3>
          <a href="{{ route('transactions') }}" class="text-xs font-bold text-primary hover:underline flex items-center">
            <span>View All Logs</span>
            <i data-lucide="chevron-right" class="w-4 h-4 ml-0.5"></i>
          </a>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-xs">
            <thead>
              <tr class="text-gray-400 uppercase tracking-widest border-b border-gray-150 bg-slate-50">
                <th class="py-3.5 pl-3">Transaction</th>
                <th class="py-3.5">Category</th>
                <th class="py-3.5">Settlement Date</th>
                <th class="py-3.5">Status</th>
                <th class="py-3.5 text-right pr-3">Amount</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 font-semibold text-gray-600">
              
              <!-- Row 1 -->
              <tr class="hover:bg-slate-50/50">
                <td class="py-3.5 pl-3 flex items-center space-x-2">
                  <div class="p-1.5 bg-rose-50 text-rose-500 rounded-lg"><i data-lucide="arrow-up-right" class="w-4 h-4"></i></div>
                  <span class="text-gray-900">Apex Software subscription</span>
                </td>
                <td class="py-3.5">Online Utilities</td>
                <td class="py-3.5">July 24, 2026</td>
                <td class="py-3.5"><span class="text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2 py-0.5 rounded-full border border-emerald-100">Cleared</span></td>
                <td class="py-3.5 text-right pr-3 text-rose-500 font-bold">-49.99</td>
              </tr>

              <!-- Row 2 -->
              <tr class="hover:bg-slate-50/50">
                <td class="py-3.5 pl-3 flex items-center space-x-2">
                  <div class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg"><i data-lucide="arrow-down-left" class="w-4 h-4"></i></div>
                  <span class="text-gray-900">Internal Wire: Sarah Jenkins</span>
                </td>
                <td class="py-3.5">Transfers</td>
                <td class="py-3.5">July 22, 2026</td>
                <td class="py-3.5"><span class="text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2 py-0.5 rounded-full border border-emerald-100">Cleared</span></td>
                <td class="py-3.5 text-right pr-3 text-primary font-bold">+1,200.00</td>
              </tr>

              <!-- Row 3 -->
              <tr class="hover:bg-slate-50/50">
                <td class="py-3.5 pl-3 flex items-center space-x-2">
                  <div class="p-1.5 bg-rose-50 text-rose-500 rounded-lg"><i data-lucide="arrow-up-right" class="w-4 h-4"></i></div>
                  <span class="text-gray-900">City Grill restaurant</span>
                </td>
                <td class="py-3.5">Entertainment</td>
                <td class="py-3.5">July 20, 2026</td>
                <td class="py-3.5"><span class="text-[10px] bg-amber-50 text-amber-800 font-bold px-2 py-0.5 rounded-full border border-amber-100">Pending</span></td>
                <td class="py-3.5 text-right pr-3 text-rose-500 font-bold">-84.50</td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

    </main>

  </div>

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}?v={{ time() }}"></script>
  <!-- Complete Profile Modal -->
  <div id="profile-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
    <div class="bg-white border border-gray-200 p-8 rounded-[24px] shadow-2xl max-w-md w-full space-y-6 relative card-3d">
      <div class="flex justify-between items-start">
        <div>
          <h3 class="text-xl font-bold text-gray-900">Complete Profile</h3>
          <p class="text-gray-400 text-xs mt-1 font-semibold">Step 3: Setup your security demographics</p>
        </div>
        <button onclick="document.getElementById('profile-modal').classList.add('hidden')" class="p-1 rounded-lg border border-gray-150 text-gray-400 hover:bg-slate-50"><i data-lucide="x" class="w-4 h-4"></i></button>
      </div>

      <form id="profile-complete-form" class="space-y-4">
        <div>
          <label for="prof-address" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Home Address</label>
          <input type="text" id="prof-address" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="123 Financial St, London">
        </div>

        <div class="grid grid-cols-2 gap-4">
          <div>
            <label for="prof-dob" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Date of Birth</label>
            <input type="date" id="prof-dob" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10">
          </div>
          <div>
            <label for="prof-occupation" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Occupation</label>
            <input type="text" id="prof-occupation" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="Software Engineer">
          </div>
        </div>

        <div>
          <label for="prof-id" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Government Issued ID Card / SSN</label>
          <input type="text" id="prof-id" required class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10" placeholder="AB-123456-C">
        </div>

        <button type="submit" class="w-full py-4 bg-gradient-primary hover:opacity-95 text-white font-bold rounded-xl shadow-md transition-all flex items-center justify-center space-x-2 btn-3d-primary">
          <span>Save Details & Activate Pockets</span>
          <i data-lucide="shield-check" class="w-4 h-4"></i>
        </button>
      </form>
    </div>
  </div>

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
  <script src="{{ asset('assets/js/dashboard.js') }}?v={{ time() }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const toggleDrawer = document.getElementById('dashboard-menu-toggle');
      const drawer = document.getElementById('sidebar-drawer');
      
      if (toggleDrawer && drawer) {
        toggleDrawer.addEventListener('click', (e) => {
          e.stopPropagation();
          drawer.classList.toggle('hidden');
          drawer.classList.toggle('absolute');
          drawer.classList.toggle('z-40');
          drawer.classList.toggle('h-full');
        });
        
        document.body.addEventListener('click', () => {
          if (window.innerWidth < 768) {
            drawer.classList.add('hidden');
          }
        });
      }

      // Notifications dropdown toggle
      const notifBtn = document.getElementById('notification-btn');
      const notifPanel = document.getElementById('notification-panel');
      if (notifBtn && notifPanel) {
        notifBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          notifPanel.classList.toggle('hidden');
        });
        document.addEventListener('click', () => {
          notifPanel.classList.add('hidden');
        });
      }

      // Complete Profile form logic (Step 3)
      const profileForm = document.getElementById('profile-complete-form');
      const profileBanner = document.getElementById('profile-complete-banner');
      const profileModal = document.getElementById('profile-modal');
      const toastAlert = document.getElementById('transfer-success-alert');
      const toastMsg = toastAlert ? toastAlert.querySelector('.alert-msg') : null;

      if (profileForm) {
        profileForm.addEventListener('submit', (e) => {
          e.preventDefault();
          if (profileModal) profileModal.classList.add('hidden');
          if (profileBanner) {
            profileBanner.style.transition = 'all 0.3s ease';
            profileBanner.style.opacity = '0';
            setTimeout(() => { profileBanner.remove(); }, 300);
          }
          if (toastAlert && toastMsg) {
            toastMsg.textContent = "Profile setup complete! Your digital accounts are fully active.";
            toastAlert.classList.remove('hidden', 'bg-emerald-50', 'text-emerald-800');
            toastAlert.classList.add('bg-blue-50', 'text-blue-800', 'border-blue-200');
            toastAlert.classList.remove('hidden');
            setTimeout(() => { toastAlert.classList.add('hidden'); }, 5000);
          }
        });
      }
    });
  </script>
</body>
</html>
