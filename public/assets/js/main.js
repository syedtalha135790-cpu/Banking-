document.addEventListener('DOMContentLoaded', () => {
  // Initialize Lucide Icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // --- Mobile Hamburger Menu ---
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
      const menuIcon = mobileMenuBtn.querySelector('[data-lucide]');
      if (menuIcon) {
        const isHidden = mobileMenu.classList.contains('hidden');
        menuIcon.setAttribute('data-lucide', isHidden ? 'menu' : 'x');
        lucide.createIcons();
      }
    });
  }

  // --- Scroll-to-Top Button ---
  const scrollTopBtn = document.getElementById('scroll-to-top');
  if (scrollTopBtn) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) {
        scrollTopBtn.classList.remove('opacity-0', 'invisible');
        scrollTopBtn.classList.add('opacity-100', 'visible');
      } else {
        scrollTopBtn.classList.remove('opacity-100', 'visible');
        scrollTopBtn.classList.add('opacity-0', 'invisible');
      }
    });

    scrollTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }

  // --- Scroll Reveal Animation ---
  const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
  if ('IntersectionObserver' in window && revealElements.length > 0) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('active');
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.15,
      rootMargin: '0px 0px -40px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));
  } else {
    // Fallback if IntersectionObserver not supported
    revealElements.forEach(el => el.classList.add('active'));
  }

  // --- Stats Counter Animation ---
  const counterElements = document.querySelectorAll('.stat-counter');
  if ('IntersectionObserver' in window && counterElements.length > 0) {
    const counterObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const targetValue = parseFloat(el.getAttribute('data-target'));
          const duration = 2000; // 2 seconds
          const startTime = performance.now();
          const startVal = 0;
          const isDecimal = el.getAttribute('data-decimal') === 'true';

          const animate = (currentTime) => {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);
            const easeProgress = progress * (2 - progress); // Ease out quad
            
            let currentVal = startVal + (targetValue - startVal) * easeProgress;
            if (!isDecimal) {
              currentVal = Math.floor(currentVal);
            } else {
              currentVal = currentVal.toFixed(2);
            }
            
            const suffix = el.getAttribute('data-suffix') || '';
            el.textContent = currentVal + suffix;

            if (progress < 1) {
              requestAnimationFrame(animate);
            } else {
              el.textContent = (isDecimal ? targetValue.toFixed(2) : targetValue) + suffix;
            }
          };

          requestAnimationFrame(animate);
          observer.unobserve(el);
        }
      });
    }, { threshold: 0.5 });

    counterElements.forEach(el => counterObserver.observe(el));
  } else {
    // Fallback
    counterElements.forEach(el => {
      el.textContent = el.getAttribute('data-target') + (el.getAttribute('data-suffix') || '');
    });
  }

  // --- FAQ Accordion Logic ---
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const trigger = item.querySelector('.faq-trigger');
    const content = item.querySelector('.faq-content');
    const icon = item.querySelector('.faq-icon');
    
    if (trigger && content && icon) {
      trigger.addEventListener('click', () => {
        const isOpen = !content.classList.contains('max-h-0');
        
        // Close all other FAQs
        faqItems.forEach(otherItem => {
          const otherContent = otherItem.querySelector('.faq-content');
          const otherIcon = otherItem.querySelector('.faq-icon');
          if (otherContent && otherIcon && otherItem !== item) {
            otherContent.classList.add('max-h-0');
            otherContent.classList.remove('py-4');
            otherIcon.style.transform = 'rotate(0deg)';
          }
        });

        // Toggle current FAQ
        if (isOpen) {
          content.classList.add('max-h-0');
          content.classList.remove('py-4');
          icon.style.transform = 'rotate(0deg)';
        } else {
          content.classList.remove('max-h-0');
          content.classList.add('py-4');
          icon.style.transform = 'rotate(180deg)';
        }
      });
    }
  });
});
