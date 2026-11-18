/**
 * CAR WASH & HOME CLEANING SERVICE — CLIENT PREVIEW JAVASCRIPT
 * Lightweight, Vanilla ES6, No Dependencies
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Mobile Menu Toggle
  const mobileToggle = document.querySelector('.mobile-toggle');
  const navMenu = document.querySelector('.nav-menu');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.toggle('open');
      mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      mobileToggle.innerHTML = isOpen
        ? `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`
        : `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="18" x2="20" y2="18"></line></svg>`;
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!navMenu.contains(e.target) && !mobileToggle.contains(e.target) && navMenu.classList.contains('open')) {
        navMenu.classList.remove('open');
        mobileToggle.setAttribute('aria-expanded', 'false');
        mobileToggle.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="12" x2="20" y2="12"></line><line x1="4" y1="6" x2="20" y2="6"></line><line x1="4" y1="18" x2="20" y2="18"></line></svg>`;
      }
    });
  }

  // 2. Modal Helper Functions
  const modalBackdrop = document.getElementById('previewModal');
  const modalText = document.getElementById('modalNoticeText');
  const modalCloseBtn = document.getElementById('modalCloseBtn');

  function openPreviewModal(message) {
    if (!modalBackdrop) return;
    if (modalText && message) {
      modalText.textContent = message;
    }
    modalBackdrop.classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closePreviewModal() {
    if (!modalBackdrop) return;
    modalBackdrop.classList.remove('show');
    document.body.style.overflow = '';
  }

  if (modalCloseBtn) {
    modalCloseBtn.addEventListener('click', closePreviewModal);
  }

  if (modalBackdrop) {
    modalBackdrop.addEventListener('click', (e) => {
      if (e.target === modalBackdrop) {
        closePreviewModal();
      }
    });
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modalBackdrop && modalBackdrop.classList.contains('show')) {
      closePreviewModal();
    }
  });

  // 3. Booking Form Simulation
  const bookingForm = document.getElementById('previewBookingForm');
  if (bookingForm) {
    bookingForm.addEventListener('submit', (e) => {
      e.preventDefault();
      // Show exact requested prompt
      openPreviewModal('This is a website preview. Booking functionality will be available in the final version.');
    });
  }

  // 4. Contact Form Simulation
  const contactForm = document.getElementById('previewContactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      openPreviewModal('This is a website preview. Message submission will be available in the final version.');
    });
  }

  // 5. Dynamic Service Dropdown for Booking Form
  const categorySelect = document.getElementById('serviceCategory');
  const serviceSelect = document.getElementById('serviceType');

  const servicesData = {
    'car-wash': [
      { id: 'exterior-car-wash', name: 'Exterior Car Wash' },
      { id: 'interior-cleaning', name: 'Interior Cleaning & Sanitizing' },
      { id: 'full-car-wash', name: 'Full Car Wash & Hydro Wax' },
      { id: 'premium-detailing', name: 'Premium Detailing & Coating' }
    ],
    'home-cleaning': [
      { id: 'regular-home-cleaning', name: 'Regular Home Cleaning' },
      { id: 'deep-cleaning', name: 'Deep Cleaning Total' },
      { id: 'kitchen-cleaning', name: 'Kitchen Cleaning & Degreasing' },
      { id: 'bathroom-cleaning', name: 'Bathroom Deep Descaling' },
      { id: 'move-in-move-out', name: 'Move In / Move Out Cleaning' }
    ]
  };

  function updateServiceOptions(category, selectedServiceId = null) {
    if (!serviceSelect) return;
    serviceSelect.innerHTML = '<option value="">Select a specific service package...</option>';

    const list = servicesData[category];
    if (list && list.length > 0) {
      list.forEach(svc => {
        const opt = document.createElement('option');
        opt.value = svc.id;
        opt.textContent = svc.name;
        if (selectedServiceId && selectedServiceId === svc.id) {
          opt.selected = true;
        }
        serviceSelect.appendChild(opt);
      });
      serviceSelect.disabled = false;
    } else {
      serviceSelect.disabled = true;
    }
  }

  if (categorySelect && serviceSelect) {
    categorySelect.addEventListener('change', () => {
      updateServiceOptions(categorySelect.value);
    });

    // Check URL parameters for pre-filling (e.g. booking.html?category=car-wash&service=premium-detailing)
    const urlParams = new URLSearchParams(window.location.search);
    const catParam = urlParams.get('category');
    const svcParam = urlParams.get('service');

    if (catParam && servicesData[catParam]) {
      categorySelect.value = catParam;
      updateServiceOptions(catParam, svcParam);
    } else if (categorySelect.value) {
      updateServiceOptions(categorySelect.value);
    }
  }
});

