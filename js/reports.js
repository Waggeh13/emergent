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

const districtData = [
    { district: "Accra Central", totalBilled: 3000, paid: 2400, unpaid: 600, percentPaid: 80 },
    { district: "Kumasi Metro", totalBilled: 2500, paid: 1750, unpaid: 750, percentPaid: 70 },
    { district: "Tamale North", totalBilled: 1200, paid: 900, unpaid: 300, percentPaid: 75 }
];

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
                        callback: function (value) {
                            return value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    populateDistrictTable();
    renderOverallBarChart();
});
