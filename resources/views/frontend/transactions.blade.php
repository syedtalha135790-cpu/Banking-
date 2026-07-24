<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction History | Bank Management Services</title>
  <meta name="description" content="Search, filter, and audit your digital transaction records. Export monthly ledgers to PDF/CSV formats.">
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

    <nav class="flex-grow p-4 space-y-1.5">
      <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-500 hover:bg-slate-50 hover:text-gray-900 transition-all font-semibold">
        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
        <span class="text-sm">Overview</span>
      </a>
      <a href="{{ route('transactions') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-primary text-white font-bold shadow-md shadow-primary/10">
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

    <div class="p-4 border-t border-gray-150 bg-slate-50/50">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 font-bold text-center flex items-center justify-center border border-blue-100">
          JD
        </div>
        <div class="flex-grow min-w-0">
          <p class="font-bold text-xs truncate text-gray-900">John Doe</p>
          <p class="text-[10px] text-gray-400 truncate font-semibold">Standard Account</p>
        </div>
        <a href="{{ route('home') }}" class="text-gray-400 hover:text-rose-500"><i data-lucide="log-out" class="w-4 h-4"></i></a>
      </div>
    </div>
  </aside>

  <!-- Main Container -->
  <div class="flex-grow flex flex-col min-w-0">
    
    <!-- Header -->
    <header class="h-20 border-b border-gray-200 bg-white px-6 flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <button id="dashboard-menu-toggle" class="md:hidden p-2 rounded-lg border border-gray-200">
          <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        <h2 class="font-bold text-lg text-gray-900">Ledger Statement</h2>
      </div>

      <div class="flex items-center space-x-4">
        <button class="theme-toggle-btn p-2 rounded-xl border border-gray-200 text-slate-500 hover:bg-slate-100 transition-colors hidden">
          <i data-lucide="sun" class="sun-icon w-5 h-5 hidden"></i>
          <i data-lucide="moon" class="moon-icon w-5 h-5"></i>
        </button>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-6 space-y-6 overflow-y-auto">
      
      <!-- Export Toast -->
      <div id="export-toast" class="hidden p-4 bg-emerald-50 text-emerald-800 rounded-2xl text-xs font-semibold flex items-center space-x-2 border border-emerald-200">
        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
        <span class="toast-msg">Ledger exports scheduled successfully!</span>
      </div>

      <!-- Filters & Exports -->
      <div class="bg-white border border-gray-200 p-6 rounded-[20px] shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        
        <!-- Search & Filter Controls -->
        <div class="flex flex-wrap items-center gap-3">
          <div class="relative w-full sm:w-60">
            <input type="text" id="tx-search" placeholder="Search transactions..." class="w-full pl-9 pr-4 py-2.5 border border-gray-200 bg-slate-50 rounded-xl text-xs focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400"><i data-lucide="search" class="w-4 h-4"></i></span>
          </div>

          <select id="tx-type-filter" class="px-3.5 py-2.5 border border-gray-200 bg-slate-50 rounded-xl text-xs focus:outline-none focus:border-primary text-gray-900 focus:ring-2 focus:ring-primary/10 font-semibold">
            <option value="all">All Transactions</option>
            <option value="deposits">Deposits / Income</option>
            <option value="purchases">Card Purchases</option>
            <option value="transfers">Wire Transfers</option>
          </select>
        </div>

        <!-- Export Buttons -->
        <div class="flex items-center space-x-2.5">
          <button id="export-csv-btn" class="px-4 py-2.5 border border-gray-200 bg-white text-gray-700 font-bold text-xs rounded-xl hover:bg-slate-550 transition-all flex items-center space-x-1.5 shadow-sm">
            <i data-lucide="download" class="w-4 h-4"></i>
            <span>Export CSV</span>
          </button>
          <button id="export-pdf-btn" class="px-4 py-2.5 bg-gradient-primary hover:opacity-95 text-white font-bold text-xs rounded-xl transition-all flex items-center space-x-1.5 shadow-md">
            <i data-lucide="file-text" class="w-4 h-4"></i>
            <span>Download PDF Statement</span>
          </button>
        </div>

      </div>

      <!-- Transaction Ledger Table -->
      <div class="bg-white border border-gray-200 rounded-[20px] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse text-xs">
            <thead>
              <tr class="text-gray-400 uppercase tracking-widest border-b border-gray-150 bg-slate-50">
                <th class="py-4 pl-6">Transaction Detail</th>
                <th class="py-4">Category</th>
                <th class="py-4">Settlement Date</th>
                <th class="py-4">Status</th>
                <th class="py-4 text-right pr-6">Amount</th>
              </tr>
            </thead>
            <tbody id="tx-table-body" class="divide-y divide-gray-100 font-semibold text-gray-600">
              
              <!-- row 1 -->
              <tr class="hover:bg-slate-50/50 tx-row" data-type="purchases">
                <td class="py-4 pl-6 flex items-center space-x-3">
                  <div class="p-2 bg-rose-50 text-rose-500 rounded-xl"><i data-lucide="arrow-up-right" class="w-4 h-4"></i></div>
                  <span class="text-gray-900">Apex Software subscription</span>
                </td>
                <td class="py-4 text-gray-500 font-medium">Online Utilities</td>
                <td class="py-4 text-gray-500 font-medium">July 24, 2026</td>
                <td class="py-4"><span class="text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2 py-0.5 rounded-full border border-emerald-100">Cleared</span></td>
                <td class="py-4 text-right pr-6 text-rose-500 font-bold">-49.99</td>
              </tr>

              <!-- row 2 -->
              <tr class="hover:bg-slate-50/50 tx-row" data-type="transfers">
                <td class="py-4 pl-6 flex items-center space-x-3">
                  <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl"><i data-lucide="arrow-down-left" class="w-4 h-4"></i></div>
                  <span class="text-gray-900">Internal Wire: Sarah Jenkins</span>
                </td>
                <td class="py-4 text-gray-500 font-medium">Transfers</td>
                <td class="py-4 text-gray-500 font-medium">July 22, 2026</td>
                <td class="py-4"><span class="text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2 py-0.5 rounded-full border border-emerald-100">Cleared</span></td>
                <td class="py-4 text-right pr-6 text-primary font-bold">+1,200.00</td>
              </tr>

              <!-- row 3 -->
              <tr class="hover:bg-slate-50/50 tx-row" data-type="purchases">
                <td class="py-4 pl-6 flex items-center space-x-3">
                  <div class="p-2 bg-rose-50 text-rose-500 rounded-xl"><i data-lucide="arrow-up-right" class="w-4 h-4"></i></div>
                  <span class="text-gray-900">City Grill restaurant</span>
                </td>
                <td class="py-4 text-gray-500 font-medium">Entertainment</td>
                <td class="py-4 text-gray-500 font-medium">July 20, 2026</td>
                <td class="py-4"><span class="text-[10px] bg-amber-50 text-amber-800 font-bold px-2 py-0.5 rounded-full border border-amber-100">Pending</span></td>
                <td class="py-4 text-right pr-6 text-rose-500 font-bold">-84.50</td>
              </tr>

              <!-- row 4 -->
              <tr class="hover:bg-slate-50/50 tx-row" data-type="deposits">
                <td class="py-4 pl-6 flex items-center space-x-3">
                  <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl"><i data-lucide="arrow-down-left" class="w-4 h-4"></i></div>
                  <span class="text-gray-900">Monthly Salary BMS Corp</span>
                </td>
                <td class="py-4 text-gray-500 font-medium">Salary</td>
                <td class="py-4 text-gray-500 font-medium">July 18, 2026</td>
                <td class="py-4"><span class="text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2 py-0.5 rounded-full border border-emerald-100">Cleared</span></td>
                <td class="py-4 text-right pr-6 text-primary font-bold">+4,500.00</td>
              </tr>

              <!-- row 5 -->
              <tr class="hover:bg-slate-50/50 tx-row" data-type="purchases">
                <td class="py-4 pl-6 flex items-center space-x-3">
                  <div class="p-2 bg-rose-50 text-rose-500 rounded-xl"><i data-lucide="arrow-up-right" class="w-4 h-4"></i></div>
                  <span class="text-gray-900">London Underground ticket</span>
                </td>
                <td class="py-4 text-gray-500 font-medium">Commute</td>
                <td class="py-4 text-gray-500 font-medium">July 15, 2026</td>
                <td class="py-4"><span class="text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2 py-0.5 rounded-full border border-emerald-100">Cleared</span></td>
                <td class="py-4 text-right pr-6 text-rose-500 font-bold">-12.80</td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

    </main>

  </div>

  <script src="{{ asset('assets/js/main.js') }}?v={{ time() }}"></script>
  <!-- Search/Filter / Export JavaScript -->
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

      // Search & Category Filters
      const searchInput = document.getElementById('tx-search');
      const categoryFilter = document.getElementById('tx-type-filter');
      const rows = document.querySelectorAll('.tx-row');

      const filterTable = () => {
        const query = searchInput.value.toLowerCase();
        const selectedType = categoryFilter.value;

        rows.forEach(row => {
          const detail = row.querySelector('td').textContent.toLowerCase();
          const type = row.getAttribute('data-type');
          
          const matchesSearch = detail.includes(query);
          const matchesCategory = selectedType === 'all' || type === selectedType;

          if (matchesSearch && matchesCategory) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      };

      searchInput.addEventListener('input', filterTable);
      categoryFilter.addEventListener('change', filterTable);

      // Export Actions
      const exportToast = document.getElementById('export-toast');
      const toastMsg = exportToast.querySelector('.toast-msg');
      
      const showToast = (msg) => {
        toastMsg.textContent = msg;
        exportToast.classList.remove('hidden');
        setTimeout(() => {
          exportToast.classList.add('hidden');
        }, 4000);
      };

      document.getElementById('export-csv-btn').addEventListener('click', () => {
        showToast('Compiling ledger log... CSV dispatch starting now.');
      });

      document.getElementById('export-pdf-btn').addEventListener('click', () => {
        showToast('Assembling visual statements... PDF download initiating now.');
      });
    });
  </script>
</body>
</html>
