// District Data
const districtData = [
    { district: "Accra Central", totalBilled: 3000, paid: 2400, unpaid: 600, percentPaid: 80 },
    { district: "Kumasi Metro", totalBilled: 2500, paid: 1750, unpaid: 750, percentPaid: 70 },
    { district: "Tamale North", totalBilled: 1200, paid: 900, unpaid: 300, percentPaid: 75 }
];

// Populate District Table
function populateDistrictTable() {
    const tableBody = document.querySelector('#district-table tbody');
    tableBody.innerHTML = '';

    districtData.forEach(item => {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td>${item.district}</td>
            <td>${item.totalBilled.toLocaleString()}</td>
            <td>${item.paid.toLocaleString()}</td>
            <td>${item.unpaid.toLocaleString()}</td>
            <td>${item.percentPaid}%</td>
        `;

        tableBody.appendChild(row);
    });
}

// Render Overall Bar Chart (Total Paid vs Unpaid)
function renderOverallBarChart() {
    const ctx = document.getElementById('districtBarChart').getContext('2d');

    const totalPaid = districtData.reduce((sum, d) => sum + d.paid, 0);
    const totalUnpaid = districtData.reduce((sum, d) => sum + d.unpaid, 0);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Paid', 'Unpaid'],
            datasets: [{
                label: 'Amount (GHS)',
                data: [totalPaid, totalUnpaid],
                backgroundColor: ['#4CAF50', '#F44336']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Overall Payment Status'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}

// Initialize Dashboard
document.addEventListener('DOMContentLoaded', () => {
    populateDistrictTable();
    renderOverallBarChart();

    // Sidebar toggle
    const sidebarToggle = document.createElement('div');
    sidebarToggle.className = 'sidebar-toggle';
    sidebarToggle.innerHTML = '<i class="fas fa-bars"></i>';
    sidebarToggle.style.position = 'fixed';
    sidebarToggle.style.top = '20px';
    sidebarToggle.style.left = '20px';
    sidebarToggle.style.zIndex = '1001';
    sidebarToggle.style.fontSize = '24px';
    sidebarToggle.style.cursor = 'pointer';
    sidebarToggle.style.display = 'none';
    document.body.appendChild(sidebarToggle);

    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    function toggleSidebar() {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    }

    sidebarToggle.addEventListener('click', toggleSidebar);

    function checkScreenSize() {
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            sidebarToggle.style.display = 'block';
        } else {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
            sidebarToggle.style.display = 'none';
        }
    }

    window.addEventListener('resize', checkScreenSize);
    checkScreenSize();
});
