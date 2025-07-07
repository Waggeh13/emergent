document.addEventListener('DOMContentLoaded', function() {
    // Set active navigation link
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.main-nav a');
    
    navLinks.forEach(link => {
        link.parentElement.classList.remove('active');
        if (link.getAttribute('href') === currentPage) {
            link.parentElement.classList.add('active');
        }
    });

    // User profile dropdown
    document.querySelector('.user-profile').addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-menu')) {
            this.classList.toggle('active');
        }
    });

    // Initialize chart
    const initChart = () => {
        const canvas = document.getElementById('billedCollectedChart');
        if (!canvas) {
            console.error('Canvas element not found!');
            return;
        }

        // Clear any existing chart
        if (canvas.chart) {
            canvas.chart.destroy();
        }

        const ctx = canvas.getContext('2d');
        
        // Fetch data
സ

        async function fetchData() {
            try {
                const response = await fetch('../actions/fetch_admin_district_data.php', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                if (!data.success) {
                    throw new Error(data.message || 'Failed to fetch data');
                }

                // Debug: Log the fetched data
                console.log('Fetched data:', data);

                // Create new chart
                canvas.chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Total Owed', 'Total Paid'],
                        datasets: [{
                            label: 'Amount (₵)',
                            data: [
                                parseFloat(data.data.total_owed),
                                parseFloat(data.data.total_paid)
                            ],
                            backgroundColor: [
                                'rgba(52, 152, 219, 0.7)', // Blue for Total Owed
                                'rgba(46, 204, 113, 0.7)'  // Green for Total Paid
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
                                    font: {
                                        size: 14
                                    },
                                    callback: function(value) {
                                        return '₵' + (value / 1000).toLocaleString('en-US', {
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                        }) + 'K';
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Amount',
                                    font: {
                                        size: 16
                                    }
                                }
                            },
                            x: {
                                ticks: {
                                    font: {
                                        size: 14
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Billing Status',
                                    font: {
                                        size: 16
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                titleFont: {
                                    size: 14
                                },
                                bodyFont: {
                                    size: 14
                                },
                                callbacks: {
                                    label: function(context) {
                                        return '₵' + context.raw.toLocaleString('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        });
                                    }
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error fetching chart data:', error);
                document.querySelector('.chart-container').innerHTML = 
                    '<p style="text-align: center; padding: 20px; font-size: 16px;">Error loading chart data. Please try again.</p>';
            }
        }

        fetchData();
    };

    // Initialize the chart if Chart.js is loaded
    if (typeof Chart !== 'undefined') {
        initChart();
    } else {
        console.error('Chart.js is not loaded!');
    }

    // Mobile menu toggle
    const menuToggle = document.createElement('button');
    menuToggle.className = 'menu-toggle';
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    document.body.prepend(menuToggle);
    
    const overlay = document.createElement('div');
    overlay.className = 'menu-overlay';
    document.body.appendChild(overlay);
    
    menuToggle.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });
    
    overlay.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.remove('active');
    });
});