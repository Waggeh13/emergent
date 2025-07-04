document.addEventListener('DOMContentLoaded', function () {
  const sidebar = document.querySelector('.sidebar');
  const menuToggle = document.createElement('button');
  const overlay = document.createElement('div');

  menuToggle.className = 'menu-toggle';
  menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
  document.querySelector('.topbar').prepend(menuToggle);

  overlay.className = 'menu-overlay';
  document.body.appendChild(overlay);

  menuToggle.addEventListener('click', function () {
    sidebar.classList.toggle('active');
    overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
  });

  overlay.addEventListener('click', function () {
    sidebar.classList.remove('active');
    overlay.style.display = 'none';
  });

  const currentPage = window.location.pathname.split('/').pop();
  const navLinks = document.querySelectorAll('.main-nav a');

  navLinks.forEach(link => {
    link.parentElement.classList.remove('active');
    if (link.getAttribute('href').includes(currentPage)) {
      link.parentElement.classList.add('active');
    }
  });

  const linkAlert = document.getElementById('linkSent');
  const reminderAlert = document.getElementById('reminderSent');

  window.sendLink = function () {
    if (linkAlert) {
      linkAlert.classList.remove('hidden');
      setTimeout(() => linkAlert.classList.add('hidden'), 3000);
    }
  };

  window.sendReminder = function () {
    if (reminderAlert) {
      reminderAlert.classList.remove('hidden');
      setTimeout(() => reminderAlert.classList.add('hidden'), 3000);
    }
  };
});