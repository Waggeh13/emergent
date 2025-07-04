document.addEventListener('DOMContentLoaded', function() {

  const sidebar = document.querySelector('.sidebar');

  sidebar.addEventListener('mouseenter', () => {
    sidebar.classList.add('expanded');
  });

  sidebar.addEventListener('mouseleave', () => {
    sidebar.classList.remove('expanded');
  });

  
  const menuToggle = document.createElement('button');
  menuToggle.className = 'menu-toggle';
  menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
  document.body.prepend(menuToggle);

  const overlay = document.createElement('div');
  overlay.className = 'menu-overlay';
  document.body.appendChild(overlay);

  menuToggle.addEventListener('click', function() {
    sidebar.classList.toggle('active');
  });

  overlay.addEventListener('click', function() {
    sidebar.classList.remove('active');
  });

  const currentPage = window.location.pathname.split('/').pop();
  const navLinks = document.querySelectorAll('.main-nav a');

  navLinks.forEach(link => {
    link.parentElement.classList.remove('active');
    if (link.getAttribute('href') === currentPage) {
      link.parentElement.classList.add('active');
    }
  });

  if (typeof Chart !== 'undefined') {
    const canvas = document.getElementById('billedCollectedChart');
    if (canvas) {
      if (canvas.chart) {
        canvas.chart.destroy();
      }
      const ctx = canvas.getContext('2d');

      canvas.chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Billed', 'Collected'],
          datasets: [{
            label: 'Amount (₵)',
            data: [500000, 375000],
            backgroundColor: [
              'rgba(52, 152, 219, 0.7)',
              'rgba(46, 204, 113, 0.7)'
            ],
            borderColor: [
              'rgba(52, 152, 219, 1)',
              'rgba(46, 204, 113, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  return '₵' + value.toLocaleString();
                }
              }
            }
          },
          plugins: {
            legend: { display: false },
            tooltip: {
              callbacks: {
                label: function(context) {
                  return '₵' + context.raw.toLocaleString();
                }
              }
            }
          }
        }
      });
    }
  }
});
