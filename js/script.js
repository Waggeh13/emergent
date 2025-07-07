document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('.sidebar');

    sidebar.addEventListener('mouseenter', () => {
        sidebar.classList.add('expanded');
    });

    sidebar.addEventListener('mouseleave', () => {
        sidebar.classList.remove('expanded');
    });

    const menuToggle = document.querySelector('.menu-toggle');
    const overlay = document.querySelector('.menu-overlay');

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

    const canvas = document.getElementById('trendChart');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Total Collections',
                    data: [450000, 520000, 480000, 550000, 600000, 580000],
                    borderColor: '#4e5be6',
                    backgroundColor: 'rgba(78, 91, 230, 0.05)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            callback: function(value) {
                                return 'GH₵' + (value / 1000) + 'K';
                            }
                        }
                    }
                }
            }
        });
    }
});
