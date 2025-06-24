/*hovering on sidebar*/
document.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.main-nav a');
    
    // First remove 'active' class from all links
    navLinks.forEach(link => {
        link.parentElement.classList.remove('active');
    });
    
    // Then add 'active' class to current page link
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.parentElement.classList.add('active');
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    // Check if Chart is available
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded!');
        return;
    }

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
        
        // Create new chart
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
                    legend: {
                        display: false
                    },
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
    };

    // Initialize the chart
    initChart();
});

document.addEventListener('DOMContentLoaded', function() {
    // CSV Upload Functionality
    const uploadCsvBtn = document.getElementById('uploadCsvBtn');
    const csvUploadInput = document.getElementById('csvUploadInput');
    
    uploadCsvBtn.addEventListener('click', function() {
        csvUploadInput.click();
    });
    
    csvUploadInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            if (file.name.endsWith('.csv')) {
                // Process the CSV file (you'll need to implement this)
                processCsvFile(file);
            } else {
                alert('Please select a CSV file');
            }
        }
    });
    
    // Add Property Popup
    const addPropertyBtn = document.getElementById('addPropertyBtn');
    addPropertyBtn.addEventListener('click', function() {
        // You can implement a modal or redirect to the add property page
        // Example using a modal:
        showAddPropertyModal();
        
        // OR redirect to property management page:
        // window.location.href = 'admin_properties.php?action=add';
    });
    
    // View Reports Navigation
    const viewReportsBtn = document.getElementById('viewReportsBtn');
    viewReportsBtn.addEventListener('click', function() {
        window.location.href = '../view/admin_reports_analytics.php';
    });
    
    // Example function for CSV processing
    function processCsvFile(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const contents = e.target.result;
            // Parse CSV content here
            console.log('CSV content:', contents);
            
            // Send to server or process further
            alert('CSV file uploaded successfully!');
        };
        reader.readAsText(file);
    }
    
    // Example function for showing add property modal
    function showAddPropertyModal() {
        // You can implement a modal dialog here
        alert('Add Property form would appear here');
        
        // OR use a proper modal implementation like:
        // const modal = document.getElementById('addPropertyModal');
        // modal.style.display = 'block';
    }
});

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const menuToggle = document.createElement('button');
    menuToggle.className = 'menu-toggle';
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    document.body.prepend(menuToggle);
    
    // Create overlay
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