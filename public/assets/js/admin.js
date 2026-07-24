document.addEventListener('DOMContentLoaded', () => {
  // Initialize Lucide Icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // --- Dynamic Loan Approvals/Rejections ---
  const pendingApprovalsCountEl = document.getElementById('pending-approvals-count');
  const loanTableBody = document.getElementById('loan-table-body');
  const adminToast = document.getElementById('admin-success-toast');

  const showAdminToast = (msg) => {
    if (adminToast) {
      adminToast.querySelector('.toast-msg').textContent = msg;
      adminToast.classList.remove('hidden');
      setTimeout(() => {
        adminToast.classList.add('hidden');
      }, 4000);
    }
  };

  if (loanTableBody) {
    loanTableBody.addEventListener('click', (e) => {
      const target = e.target.closest('button');
      if (!target) return;

      const row = target.closest('tr');
      if (!row) return;

      const clientName = row.querySelector('.client-name').textContent;
      const loanAmount = row.querySelector('.loan-amount').textContent;
      const loanId = target.getAttribute('data-id') || '#0000';

      let currentCount = parseInt(pendingApprovalsCountEl.textContent, 10) || 0;

      if (target.classList.contains('approve-loan-btn')) {
        showAdminToast(`Loan request ${loanId} for ${clientName} (${loanAmount}) was APPROVED successfully!`);
        if (currentCount > 0) pendingApprovalsCountEl.textContent = currentCount - 1;
      } else if (target.classList.contains('reject-loan-btn')) {
        showAdminToast(`Loan request ${loanId} for ${clientName} (${loanAmount}) was REJECTED.`);
        if (currentCount > 0) pendingApprovalsCountEl.textContent = currentCount - 1;
      }

      // Add fade out animation and remove row
      row.style.transition = 'all 0.3s ease';
      row.style.opacity = '0';
      row.style.transform = 'translateX(20px)';
      
      setTimeout(() => {
        row.remove();
        // Check if table is empty
        if (loanTableBody.querySelectorAll('tr').length === 0) {
          loanTableBody.innerHTML = `
            <tr>
              <td colspan="5" class="py-8 text-center text-gray-400 font-semibold">
                No pending loan applications remaining.
              </td>
            </tr>
          `;
        }
      }, 300);
    });
  }

  // --- Search User Accounts ---
  const userSearchInput = document.getElementById('user-search');
  const userTableRows = document.querySelectorAll('.user-row');

  if (userSearchInput) {
    userSearchInput.addEventListener('input', () => {
      const query = userSearchInput.value.toLowerCase();
      
      userTableRows.forEach(row => {
        const name = row.querySelector('.user-name').textContent.toLowerCase();
        const email = row.querySelector('.user-email').textContent.toLowerCase();
        
        if (name.includes(query) || email.includes(query)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }

  // --- Suspend/Activate User ---
  const userTableBody = document.getElementById('user-table-body');
  if (userTableBody) {
    userTableBody.addEventListener('click', (e) => {
      const btn = e.target.closest('.suspend-user-btn');
      if (!btn) return;

      const row = btn.closest('tr');
      if (!row) return;

      const statusBadge = row.querySelector('.user-status');
      const userName = row.querySelector('.user-name').textContent;
      const isSuspended = statusBadge.textContent.trim().toLowerCase() === 'suspended';

      if (isSuspended) {
        // Activate user
        statusBadge.textContent = 'Active';
        statusBadge.className = 'user-status text-[10px] bg-emerald-50 text-emerald-800 font-bold px-2.5 py-0.5 rounded-full border border-emerald-100';
        btn.textContent = 'Suspend';
        btn.className = 'suspend-user-btn text-rose-600 bg-rose-50 hover:bg-rose-100 font-bold text-[10px] px-3 py-1.5 rounded-xl transition-all';
        showAdminToast(`User account for ${userName} has been ACTIVATED.`);
      } else {
        // Suspend user
        statusBadge.textContent = 'Suspended';
        statusBadge.className = 'user-status text-[10px] bg-rose-50 text-rose-800 font-bold px-2.5 py-0.5 rounded-full border border-rose-100';
        btn.textContent = 'Activate';
        btn.className = 'suspend-user-btn text-emerald-600 bg-emerald-50 hover:bg-emerald-100 font-bold text-[10px] px-3 py-1.5 rounded-xl transition-all';
        showAdminToast(`User account for ${userName} has been SUSPENDED.`);
      }
    });
  }

  // --- Chart 1: Transaction Volume Velocity (Line) ---
  const txVelCtx = document.getElementById('transaction-velocity-chart');
  if (txVelCtx) {
    new Chart(txVelCtx, {
      type: 'line',
      data: {
        labels: ['09:00', '11:00', '13:00', '15:00', '17:00', '19:00'],
        datasets: [
          {
            label: 'Domestic Wires',
            data: [120, 190, 310, 250, 420, 380],
            borderColor: '#2563EB',
            backgroundColor: 'rgba(37, 99, 235, 0.05)',
            borderWidth: 2.5,
            tension: 0.35,
            fill: true
          },
          {
            label: 'International Wires',
            data: [40, 95, 140, 110, 230, 190],
            borderColor: '#06B6D4',
            backgroundColor: 'rgba(6, 182, 212, 0.03)',
            borderWidth: 2.5,
            tension: 0.35,
            fill: true
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
            labels: {
              font: { family: 'Inter', size: 10 },
              color: '#64748B'
            }
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { color: '#64748B', font: { family: 'Inter', size: 10 } }
          },
          y: {
            grid: { color: '#F1F5F9' },
            ticks: { color: '#64748B', font: { family: 'Inter', size: 10 } }
          }
        }
      }
    });
  }

  // --- Chart 2: Server Workload utilization (Bar) ---
  const systemLoadCtx = document.getElementById('system-load-chart');
  if (systemLoadCtx) {
    new Chart(systemLoadCtx, {
      type: 'bar',
      data: {
        labels: ['CPU Load', 'RAM Usage', 'DB Query Latency', 'API Queue Uptime'],
        datasets: [{
          label: 'System Load %',
          data: [32, 64, 18, 99.98],
          backgroundColor: ['#2563EB', '#06B6D4', '#F59E0B', '#22C55E'],
          borderRadius: 8,
          borderWidth: 0,
          barThickness: 24
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { color: '#64748B', font: { family: 'Inter', size: 10 } }
          },
          y: {
            grid: { color: '#F1F5F9' },
            ticks: {
              color: '#64748B',
              font: { family: 'Inter', size: 10 },
              callback: function(value) { return value + '%'; }
            },
            max: 100
          }
        }
      }
    });
  }
});
