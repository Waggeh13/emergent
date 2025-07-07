document.addEventListener('DOMContentLoaded', function () {
  const sidebar = document.querySelector('.sidebar');
  const menuToggle = document.createElement('button');
  const overlay = document.createElement('div');
  const tableBody = document.querySelector('#billingTable tbody');
  const linkAlert = document.getElementById('linkSent');
  const reminderAlert = document.getElementById('reminderSent');

  menuToggle.className = 'menu-toggle';
  menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
  document.querySelector('.topbar').prepend(menuToggle);

  overlay.className = 'menu-overlay';
  document.body.appendChild(overlay);

  menuToggle.addEventListener('click', function () {
    sidebar.classList.toggle('active');
    overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
  });

  overlay.addEventListener('click', function () {
    sidebar.classList.remove('active');
    overlay.style.display = 'none';
  });

  const currentPage = window.location.pathname.split('/').pop();
  const navLinks = document.querySelectorAll('.main-nav a');

  navLinks.forEach(link => {
    link.parentElement.classList.remove('active');
    if (link.getAttribute('href').includes(currentPage)) {
      link.parentElement.classList.add('active');
    }
  });

  function renderBills(properties) {
    tableBody.innerHTML = '';

    if (!properties || properties.length === 0) {
      tableBody.innerHTML = `
        <tr class="no-data-row">
          <td colspan="9" style="text-align: center;">No bills found.</td>
        </tr>
      `;
      return;
    }

    properties.forEach(property => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${property.property_code}</td>
        <td>${property.owner_name}</td>
        <td>${property.owner_phone_number}</td>
        <td>${property.email || ''}</td>
        <td>${property.property_address}</td>
        <td>${property.property_type}</td>
        <td>${property.property_category}</td>
        <td>${parseFloat(property.amount_owed).toFixed(2)}</td>
        <td class="action-cell">
          <button class="icon-button send-link-btn" data-code="${property.property_code}" title="Send Payment Link"><i class="fas fa-link"></i></button>
          <button class="icon-button send-reminder-btn" data-code="${property.property_code}" title="Send Reminder"><i class="fas fa-envelope"></i></button>
        </td>
      `;
      tableBody.appendChild(row);
    });

    document.querySelectorAll('.send-link-btn').forEach(button => {
      button.addEventListener('click', sendLink);
    });

    document.querySelectorAll('.send-reminder-btn').forEach(button => {
      button.addEventListener('click', sendReminder);
    });
  }

  async function fetchBills() {
    try {
      const response = await fetch('../actions/view_properties.php', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      });

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const jsonResponse = await response.json();
      if (jsonResponse.success && jsonResponse.data && Array.isArray(jsonResponse.data)) {
        renderBills(jsonResponse.data);
      } else {
        renderBills([]);
      }
    } catch (error) {
      tableBody.innerHTML = `
        <tr>
          <td colspan="9" style="text-align: center; padding: 20px;">
            Error loading bills. Please try again.
          </td>
        </tr>
      `;
    }
  }

  window.sendLink = function () {
    if (linkAlert) {
      linkAlert.classList.remove('hidden');
      setTimeout(() => linkAlert.classList.add('hidden'), 3000);
    }
  };

  window.sendReminder = function () {
    if (reminderAlert) {
      reminderAlert.classList.remove('hidden');
      setTimeout(() => reminderAlert.classList.add('hidden'), 3000);
    }
  };

  fetchBills();
});