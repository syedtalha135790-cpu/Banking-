<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Bank Management Services</title>
  <meta name="description" content="Supervise banking accounts, authorize mortgage loans, analyze server resources, and audit security transaction logs.">
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

  <!-- Sidebar -->
  <aside id="sidebar-drawer" class="hidden md:flex flex-col w-64 border-r border-gray-200 bg-white flex-shrink-0 transition-transform duration-300">
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
      <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-slate-50 hover:text-gray-900 transition-all font-semibold">
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
      <a href="{{ route('admin') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-primary text-white font-bold shadow-md shadow-primary/10">
        <i data-lucide="shield-check" class="w-5 h-5"></i>
        <span class="text-sm">Admin Portal</span>
      </a>
    </nav>

    <div class="p-4 border-t border-gray-150 bg-slate-50/50">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 font-bold text-center flex items-center justify-center border border-blue-100">
          AD
        </div>
        <div class="flex-grow min-w-0">
          <p class="font-bold text-xs truncate text-gray-900">Admin Panel</p>
          <p class="text-[10px] text-gray-400 truncate font-semibold">Master Supervisor</p>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
          </form>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-400 hover:text-rose-500" title="Logout"><i data-lucide="log-out" class="w-4 h-4"></i></a>
      </div>
    </div>
  </aside>

  <!-- Main Container -->
  <div class="flex-grow flex flex-col min-w-0">
    
    <!-- Top Navbar -->
    <header class="h-20 border-b border-gray-200 bg-white px-6 flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <button id="dashboard-menu-toggle" class="md:hidden p-2 rounded-lg border border-gray-200">
          <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        <h2 class="font-bold text-lg text-gray-900">Admin Control Panel</h2>
      </div>

      <div class="flex items-center space-x-4">
        <!-- Status indicator -->
        <div class="hidden sm:flex items-center space-x-2 bg-emerald-50 text-emerald-800 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-100">
          <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
          </span>
          <span>SYSTEM ONLINE</span>
        </div>
      </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow p-6 space-y-6 overflow-y-auto">
      
      <!-- Toast Alert -->
      <div id="admin-success-toast" class="hidden p-4 bg-emerald-50 text-emerald-800 rounded-2xl border border-emerald-200 text-sm font-semibold flex items-center space-x-2">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
        <span class="toast-msg">Action performed successfully!</span>
      </div>

      <!-- Admin stats grid -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Total deposits -->
        <div class="card-3d p-6 rounded-3xl flex items-center space-x-4">
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl"><i data-lucide="landmark" class="w-6 h-6"></i></div>
          <div>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Total Deposits</p>
            <h4 class="text-xl font-bold text-gray-900">24,820,500</h4>
          </div>
        </div>

        <!-- Lending assets -->
        <div class="card-3d p-6 rounded-3xl flex items-center space-x-4">
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl"><i data-lucide="percent" class="w-6 h-6"></i></div>
          <div>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Lending Portfolio</p>
            <h4 class="text-xl font-bold text-gray-900">8,410,200</h4>
          </div>
        </div>

        <!-- Pending approvals -->
        <div class="card-3d p-6 rounded-3xl flex items-center space-x-4">
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl"><i data-lucide="clock" class="w-6 h-6"></i></div>
          <div>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Pending Loans</p>
            <h4 id="pending-approvals-count" class="text-xl font-bold text-gray-900">4</h4>
          </div>
        </div>

        <!-- User Count -->
        <div class="card-3d p-6 rounded-3xl flex items-center space-x-4">
          <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl"><i data-lucide="users" class="w-6 h-6"></i></div>
          <div>
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Active Customers</p>
            <h4 class="text-xl font-bold text-gray-900">5,420</h4>
          </div>
        </div>

      </div>

      <!-- Charts Grid -->
      <div class="grid lg:grid-cols-2 gap-6">
        
        <!-- Transaction Velocity chart -->
        <div class="bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
          <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400 flex items-center space-x-1.5">
            <i data-lucide="activity" class="w-4 h-4 text-primary"></i>
            <span>Daily Transaction Velocity</span>
          </h3>
          <div class="relative h-60 w-full">
            <canvas id="transaction-velocity-chart"></canvas>
          </div>
        </div>

        <!-- Server Load status chart -->
        <div class="bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
          <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400 flex items-center space-x-1.5">
            <i data-lucide="server" class="w-4 h-4 text-primary"></i>
            <span>System Load Metrics</span>
          </h3>
          <div class="relative h-60 w-full">
            <canvas id="system-load-chart"></canvas>
          </div>
        </div>

      </div>

      <!-- Management Queues (Loan Approvals & User Lists) -->
      <div class="grid lg:grid-cols-12 gap-6">
        
        <!-- Loan approvals queue -->
        <div class="lg:col-span-6 bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
          <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400 flex items-center space-x-1.5">
            <i data-lucide="file-text" class="w-4 h-4 text-primary"></i>
            <span>Pending Loan Approvals</span>
          </h3>

          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
              <thead>
                <tr class="text-gray-400 border-b border-gray-150 uppercase tracking-widest bg-slate-50">
                  <th class="py-3 pl-3">Client</th>
                  <th class="py-3">Option</th>
                  <th class="py-3">Principal</th>
                  <th class="py-3 text-center">Actions</th>
                </tr>
              </thead>
              <tbody id="loan-table-body" class="divide-y divide-gray-100 font-semibold text-gray-600">
                <!-- row 1 -->
                <tr>
                  <td class="py-4 pl-3 client-name text-gray-900">David Miller</td>
                  <td class="py-4 text-slate-500">Home Loan</td>
                  <td class="py-4 text-primary loan-amount">180,000</td>
                  <td class="py-4 flex justify-center space-x-1.5">
                    <button class="approve-loan-btn p-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors" data-id="#8821" title="Approve"><i data-lucide="check" class="w-4 h-4"></i></button>
                    <button class="reject-loan-btn p-1.5 bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-100 transition-colors" data-id="#8821" title="Reject"><i data-lucide="x" class="w-4 h-4"></i></button>
                  </td>
                </tr>
                <!-- row 2 -->
                <tr>
                  <td class="py-4 pl-3 client-name text-gray-900">Emily Clark</td>
                  <td class="py-4 text-slate-500">Student Loan</td>
                  <td class="py-4 text-primary loan-amount">12,000</td>
                  <td class="py-4 flex justify-center space-x-1.5">
                    <button class="approve-loan-btn p-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors" data-id="#4512" title="Approve"><i data-lucide="check" class="w-4 h-4"></i></button>
                    <button class="reject-loan-btn p-1.5 bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-100 transition-colors" data-id="#4512" title="Reject"><i data-lucide="x" class="w-4 h-4"></i></button>
                  </td>
                </tr>
                <!-- row 3 -->
                <tr>
                  <td class="py-4 pl-3 client-name text-gray-900">Robert Chen</td>
                  <td class="py-4 text-slate-500">Business Loan</td>
                  <td class="py-4 text-primary loan-amount">50,000</td>
                  <td class="py-4 flex justify-center space-x-1.5">
                    <button class="approve-loan-btn p-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors" data-id="#2911" title="Approve"><i data-lucide="check" class="w-4 h-4"></i></button>
                    <button class="reject-loan-btn p-1.5 bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-100 transition-colors" data-id="#2911" title="Reject"><i data-lucide="x" class="w-4 h-4"></i></button>
                  </td>
                </tr>
                <!-- row 4 -->
                <tr>
                  <td class="py-4 pl-3 client-name text-gray-900">Amanda Ross</td>
                  <td class="py-4 text-slate-500">Car Loan</td>
                  <td class="py-4 text-primary loan-amount">24,500</td>
                  <td class="py-4 flex justify-center space-x-1.5">
                    <button class="approve-loan-btn p-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors" data-id="#3082" title="Approve"><i data-lucide="check" class="w-4 h-4"></i></button>
                    <button class="reject-loan-btn p-1.5 bg-rose-50 text-rose-500 rounded-lg hover:bg-rose-100 transition-colors" data-id="#3082" title="Reject"><i data-lucide="x" class="w-4 h-4"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- User Accounts Directory -->
        <div class="lg:col-span-6 bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400 flex items-center space-x-1.5">
              <i data-lucide="users" class="w-4 h-4 text-primary"></i>
              <span>User Directories</span>
            </h3>
            
            <div class="relative w-full sm:w-44">
              <input type="text" id="user-search" placeholder="Search user..." class="w-full pl-8 pr-3 py-1.5 border border-gray-200 bg-slate-50 rounded-xl text-[10px] focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10">
              <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center text-gray-400"><i data-lucide="search" class="w-3.5 h-3.5"></i></span>
            </div>
          </div>

          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
              <thead>
                <tr class="text-gray-400 border-b border-gray-150 uppercase tracking-widest bg-slate-50">
                  <th class="py-3 pl-3">Client details</th>
                  <th class="py-3">Tier</th>
                  <th class="py-3">Status</th>
                  <th class="py-3 text-center">Action</th>
                </tr>
              </thead>
              <tbody id="user-table-body" class="divide-y divide-gray-100 font-semibold text-gray-600">
                <!-- row 1 -->
                <tr class="user-row">
                  <td class="py-3 pl-3">
                    <p class="user-name text-gray-900">Marcus King</p>
                    <p class="user-email text-[10px] text-gray-400">m.king@streamline.io</p>
                  </td>
                  <td class="py-3 text-slate-500 uppercase tracking-wider text-[10px]">Premium</td>
                  <td class="py-3"><span class="user-status text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2.5 py-0.5 rounded-full border border-emerald-100">Active</span></td>
                  <td class="py-3 flex justify-center"><button class="suspend-user-btn text-rose-600 bg-rose-50 hover:bg-rose-100 font-bold text-[10px] px-3 py-1.5 rounded-xl transition-all">Suspend</button></td>
                </tr>
                <!-- row 2 -->
                <tr class="user-row">
                  <td class="py-3 pl-3">
                    <p class="user-name text-gray-900">Elena Rostova</p>
                    <p class="user-email text-[10px] text-gray-400">elena.r@ic.ac.uk</p>
                  </td>
                  <td class="py-3 text-slate-500 uppercase tracking-wider text-[10px]">Standard</td>
                  <td class="py-3"><span class="user-status text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2.5 py-0.5 rounded-full border border-emerald-100">Active</span></td>
                  <td class="py-3 flex justify-center"><button class="suspend-user-btn text-rose-600 bg-rose-50 hover:bg-rose-100 font-bold text-[10px] px-3 py-1.5 rounded-xl transition-all">Suspend</button></td>
                </tr>
                <!-- row 3 -->
                <tr class="user-row">
                  <td class="py-3 pl-3">
                    <p class="user-name text-gray-900">Sarah Jenkins</p>
                    <p class="user-email text-[10px] text-gray-400">sarah@apexglobal.com</p>
                  </td>
                  <td class="py-3 text-slate-500 uppercase tracking-wider text-[10px]">Business</td>
                  <td class="py-3"><span class="user-status text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2.5 py-0.5 rounded-full border border-emerald-100">Active</span></td>
                  <td class="py-3 flex justify-center"><button class="suspend-user-btn text-rose-600 bg-rose-50 hover:bg-rose-100 font-bold text-[10px] px-3 py-1.5 rounded-xl transition-all">Suspend</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <!-- Security Audit Log timeline -->
      <div class="bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm space-y-4">
        <h3 class="font-bold text-xs uppercase tracking-wider text-gray-400 flex items-center space-x-1.5">
          <i data-lucide="shield-check" class="w-4 h-4 text-primary"></i>
          <span>Security Audit Trail logs</span>
        </h3>
        
        <div class="space-y-3.5 max-h-60 overflow-y-auto pr-2 text-xs font-semibold">
          <!-- log 1 -->
          <div class="flex items-start space-x-3 p-3 bg-slate-50 rounded-xl">
            <div class="p-1 bg-blue-50 text-blue-600 rounded-lg"><i data-lucide="lock" class="w-3.5 h-3.5"></i></div>
            <div class="flex-grow flex justify-between items-center">
              <div>
                <p class="text-gray-900">MFA Verification Success</p>
                <p class="text-[10px] text-gray-400 mt-0.5">OTP code authorized for user: Sarah Jenkins (sarah@apexglobal.com)</p>
              </div>
              <span class="text-[10px] text-gray-400">09:12:45 AM</span>
            </div>
          </div>
          <!-- log 2 -->
          <div class="flex items-start space-x-3 p-3 bg-slate-50 rounded-xl">
            <div class="p-1 bg-amber-50 text-amber-500 rounded-lg"><i data-lucide="key-round" class="w-3.5 h-3.5"></i></div>
            <div class="flex-grow flex justify-between items-center">
              <div>
                <p class="text-gray-900">Credential Reset Token Generated</p>
                <p class="text-[10px] text-gray-400 mt-0.5">Password recovery link dispatched to: Elena Rostova (elena.r@ic.ac.uk)</p>
              </div>
              <span class="text-[10px] text-gray-400">08:44:12 AM</span>
            </div>
          </div>
          <!-- log 3 -->
          <div class="flex items-start space-x-3 p-3 bg-slate-50 rounded-xl">
            <div class="p-1 bg-emerald-50 text-emerald-600 rounded-lg"><i data-lucide="check" class="w-3.5 h-3.5"></i></div>
            <div class="flex-grow flex justify-between items-center">
              <div>
                <p class="text-gray-900">API Health Check Passed</p>
                <p class="text-[10px] text-gray-400 mt-0.5">System REST endpoints returned 200 OK status codes under mock stress test</p>
              </div>
              <span class="text-[10px] text-gray-400">08:00:00 AM</span>
            </div>
          </div>
        </div>
      </div>

    </main>

  </div>

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
  <script src="{{ asset('assets/js/admin.js') }}?v={{ time() }}"></script>
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
    });
  </script>
</body>
</html>
