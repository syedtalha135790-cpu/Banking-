document.addEventListener('DOMContentLoaded', () => {
  // Initialize Lucide Icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // --- Hide/Show Balance Toggle ---
  const toggleBalanceBtn = document.getElementById('toggle-balance-btn');
  const balanceValues = document.querySelectorAll('.balance-value');
  let balancesHidden = false;

  if (toggleBalanceBtn) {
    toggleBalanceBtn.addEventListener('click', () => {
      balancesHidden = !balancesHidden;
      
      balanceValues.forEach(el => {
        if (balancesHidden) {
          el.setAttribute('data-original', el.textContent);
          el.textContent = '••••••';
        } else {
          el.textContent = el.getAttribute('data-original') || el.textContent;
        }
      });

      const icon = toggleBalanceBtn.querySelector('[data-lucide]');
      if (icon) {
        icon.setAttribute('data-lucide', balancesHidden ? 'eye-off' : 'eye');
        lucide.createIcons();
      }
    });
  }

  // --- Card Freeze Toggle ---
  const freezeCardBtn = document.getElementById('freeze-card-btn');
  const mockCard = document.getElementById('mock-debit-card');
  let cardFrozen = false;

  if (freezeCardBtn && mockCard) {
    freezeCardBtn.addEventListener('click', () => {
      cardFrozen = !cardFrozen;
      
      if (cardFrozen) {
        mockCard.classList.add('opacity-40', 'grayscale');
        freezeCardBtn.querySelector('span').textContent = 'Unfreeze Card';
        freezeCardBtn.classList.remove('bg-slate-100');
        freezeCardBtn.classList.add('bg-rose-100', 'text-rose-500');
      } else {
        mockCard.classList.remove('opacity-40', 'grayscale');
        freezeCardBtn.querySelector('span').textContent = 'Freeze Card';
        freezeCardBtn.classList.remove('bg-rose-100', 'text-rose-500');
        freezeCardBtn.classList.add('bg-slate-100');
      }

      const icon = freezeCardBtn.querySelector('[data-lucide]');
      if (icon) {
        icon.setAttribute('data-lucide', cardFrozen ? 'unlock' : 'lock');
        lucide.createIcons();
      }
    });
  }

  // --- Transfer Funds Form Handling ---
  const transferForm = document.getElementById('quick-transfer-form');
  const transferAlert = document.getElementById('transfer-success-alert');

  if (transferForm && transferAlert) {
    transferForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const recipient = document.getElementById('transfer-recipient').value;
      const amount = document.getElementById('transfer-amount').value;
      
      if (recipient && amount) {
        // Show success alert
        transferAlert.querySelector('.alert-msg').textContent = `Transferred $${parseFloat(amount).toFixed(2)} to ${recipient} successfully!`;
        transferAlert.classList.remove('hidden');
        transferForm.reset();

        // Auto hide after 4 seconds
        setTimeout(() => {
          transferAlert.classList.add('hidden');
        }, 4000);
      }
    });
  }

  // --- Analytics Chart Setup using Chart.js ---
  const ctx = document.getElementById('analytics-chart');
  if (ctx) {
    // Colors configured for modern SaaS white style
    const gridColor = '#F1F5F9';
    const textColor = '#64748B';

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [
          {
            label: 'Earnings & Savings',
            data: [4200, 5100, 4800, 6200, 7500, 8900],
            borderColor: '#2563EB',
            backgroundColor: 'rgba(37, 99, 235, 0.05)',
            borderWidth: 3,
            tension: 0.4,
            fill: true
          },
          {
            label: 'Expenses',
            data: [3100, 2900, 4100, 3800, 4600, 5200],
            borderColor: '#06B6D4',
            backgroundColor: 'rgba(6, 182, 212, 0.03)',
            borderWidth: 3,
            tension: 0.4,
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
              font: {
                family: 'Inter',
                size: 11
              },
              color: textColor
            }
          },
          tooltip: {
            padding: 12,
            cornerRadius: 12,
            backgroundColor: '#FFFFFF',
            titleColor: '#2563EB',
            bodyColor: '#475569',
            borderColor: '#E2E8F0',
            borderWidth: 1,
            shadowColor: 'rgba(0,0,0,0.05)',
            shadowBlur: 10
          }
        },
        scales: {
          x: {
            grid: {
              display: false
            },
            ticks: {
              color: textColor,
              font: {
                family: 'Inter'
              }
            }
          },
          y: {
            grid: {
              color: gridColor
            },
            ticks: {
              color: textColor,
              font: {
                family: 'Inter'
              },
              callback: function(value) {
                return value;
              }
            }
          }
        }
      }
    });
  }
});
