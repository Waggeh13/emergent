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

    // Fetch district data and create chart
    async function fetchDistrictData() {
        try {
            const response = await fetch('../actions/view_districts.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const jsonResponse = await response.json();
            if (!jsonResponse.success || !jsonResponse.data) {
                throw new Error('Invalid response data');
            }

            const districts = jsonResponse.data;
            const districtData = [];

            // Fetch total paid for each district
            for (const district of districts) {
                try {
                    const amountResponse = await fetch('../actions/district_amount.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `district_id=${encodeURIComponent(district.district_id)}`
                    });

                    if (!amountResponse.ok) {
                        throw new Error(`HTTP error! Status: ${amountResponse.status}`);
                    }

                    const amountData = await amountResponse.json();
                    if (amountData.success) {
                        districtData.push({
                            name: district.district_name,
                            total_paid: parseFloat(amountData.total_paid) || 0
                        });
                    }
                } catch (error) {
                    console.error(`Error fetching amounts for district ${district.district_id}:`, error);
                }
            }

            // Sort by total paid and get top 10
            const topDistricts = districtData
                .sort((a, b) => b.total_paid - a.total_paid)
                .slice(0, 10);

            // Create chart
            const ctx = document.getElementById('districtChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: topDistricts.map(d => d.name),
                    datasets: [{
                        label: 'Total Paid',
                        data: topDistricts.map(d => d.total_paid),
                        backgroundColor: 'rgba(78, 91, 230, 0.6)',
                        borderColor: '#4e5be6',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 16,
                                    family: 'Arial',
                                    weight: 'bold'
                                }
                            }
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
                                text: 'Amount Paid',
                                font: {
                                    size: 18,
                                    family: 'Arial',
                                    weight: 'bold'
                                }
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 14
                                },
                                maxRotation: 45,
                                minRotation: 45
                            },
                            title: {
                                display: true,
                                text: 'Districts',
                                font: {
                                    size: 18,
                                    family: 'Arial',
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error('Error creating chart:', error);
            document.querySelector('.chart-container').innerHTML = 
                '<p style="text-align: center; padding: 20px; font-size: 16px;">Error loading chart data. Please try again.</p>';
        }
    }

    fetchDistrictData();
});