document.addEventListener('DOMContentLoaded', () => {
    // Handle user profile dropdown
    document.querySelector('.user-profile').addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-menu')) {
            this.classList.toggle('active');
        }
    });

    // Set active navigation link
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.main-nav a');
    navLinks.forEach(link => {
        link.parentElement.classList.remove('active');
        if (link.getAttribute('href') === currentPage) {
            link.parentElement.classList.add('active');
        }
    });

    // Fetch and populate report data
    async function fetchReportData() {
        try {
            const response = await fetch('../actions/fetch_reports_data.php', {
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
                throw new Error(data.message || 'Failed to fetch report data');
            }

            // Debug: Log the received data
            console.log('Fetched data:', data);

            // Update metrics cards
            document.getElementById('total-properties').textContent = 
                parseInt(data.summary.total_properties).toLocaleString();
            document.getElementById('total-payments').textContent = 
                '₵' + parseFloat(data.summary.total_paid).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            document.getElementById('paid-properties').innerHTML = 
                `${parseInt(data.summary.paid_properties).toLocaleString()} <span class="percentage">(${data.summary.percent_paid}%)</span>`;
            document.getElementById('unpaid-properties').innerHTML = 
                `${parseInt(data.summary.unpaid_properties).toLocaleString()} <span class="percentage">(${data.summary.percent_unpaid}%)</span>`;

            // Populate district table
            const tableBody = document.querySelector('#district-table tbody');
            tableBody.innerHTML = '';
            data.districts.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.district_name}</td>
                    <td>₵${parseFloat(item.total_billed).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td>₵${parseFloat(item.paid).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td>₵${parseFloat(item.unpaid).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td>${parseFloat(item.percent_paid).toFixed(2)}%</td>
                `;
                tableBody.appendChild(row);
            });

            // Render bar chart
            const ctx = document.getElementById('districtBarChart').getContext('2d');
            const paidValue = parseFloat(data.summary.total_paid);
            const unpaidValue = parseFloat(data.summary.total_unpaid);

            // Debug: Log chart data
            console.log('Chart data:', { paid: paidValue, unpaid: unpaidValue });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Paid', 'Unpaid'],
                    datasets: [{
                        label: 'Amount (GHS)',
                        data: [paidValue, unpaidValue],
                        backgroundColor: ['#4CAF50', '#F44336'],
                        borderColor: ['#388E3C', '#D32F2F'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Overall Payment Status',
                            font: {
                                size: 16
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let value = context.parsed.y;
                                    return '₵' + value.toLocaleString('en-US', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                }
                            }
                        }
                    },
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
                                text: 'Payment Status',
                                font: {
                                    size: 16
                                }
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error fetching report data:', error);
            document.querySelector('.metrics-grid').innerHTML = 
                '<p style="text-align: center; padding: 20px; font-size: 16px;">Error loading report data. Please try again.</p>';
            document.querySelector('#district-table tbody').innerHTML = 
                '<tr><td colspan="5" style="text-align: center; padding: 20px;">Error loading district data. Please try again.</td></tr>';
        }
    }

    fetchReportData();
});