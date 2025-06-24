document.addEventListener('DOMContentLoaded', () => {

    document.querySelector('.user-profile').addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-menu')) {
            this.classList.toggle('active');
        }
    });

    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.main-nav a');

    navLinks.forEach(link => {
        link.parentElement.classList.remove('active');
        if (link.getAttribute('href') === currentPage) {
            link.parentElement.classList.add('active');
        }
    });

    const ctx = document.createElement('canvas');
    document.querySelector('.chart-container').appendChild(ctx);

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
                            return '₵' + (value / 1000) + 'K';
                        }
                    }
                }
            }
        }
    });
});
