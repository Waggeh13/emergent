const ctx = document.getElementById('adminPaymentChart').getContext('2d');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Paid', 'Unpaid'],
    datasets: [{
      label: 'Properties',
      data: [900, 300],
      backgroundColor: ['#5cb85c', '#d9534f']
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false
      }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
