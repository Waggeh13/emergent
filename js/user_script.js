const historyData = [
  {
    property: "Luxury Villa, Accra",
    details: "Property Tax • Paid on 15 Oct 2023",
    amount: "₵5,200",
    status: "Paid"
  },
  {
    property: "Beach House, Takoradi",
    details: "Property Tax • Paid on 5 Oct 2023",
    amount: "₵12,000",
    status: "Paid"
  },
  {
    property: "Commercial Plaza, Kumasi",
    details: "Property Tax • Due 15 Nov 2023",
    amount: "₵3,500",
    status: "Pending"
  }
];

const historyList = document.getElementById("historyList");
const modal = document.getElementById('paymentModal');
const amountInput = document.getElementById("amount");
const methodSelect = document.getElementById("method");
const momoFields = document.getElementById("mobileMoneyFields");
const cardFields = document.getElementById("cardFields");
const propertySelect = document.getElementById("propertySelect");

const propertySet = new Set(historyData.map(item => item.property));
propertySelect.innerHTML = "";

const allOption = document.createElement("option");
allOption.value = "all";
allOption.textContent = "All Properties";
propertySelect.appendChild(allOption);

propertySet.forEach(property => {
  const option = document.createElement("option");
  option.value = property;
  option.textContent = property;
  propertySelect.appendChild(option);
});

historyData.forEach(item => {
  const div = document.createElement("div");
  div.className = "history-item";
  const amountValue = parseFloat(item.amount.replace(/[₵,]/g, ''));

  div.innerHTML = `
    <div class="property-info">
      <h4>${item.property}</h4>
      <p>${item.details}</p>
    </div>
    <div class="payment-info">
      <div class="amount">${item.amount}</div>
      <div class="status ${item.status.toLowerCase()}">${item.status}</div>
    </div>
  `;

  if (item.status === "Pending") {
    div.style.cursor = "pointer";
    div.title = "Click to pay this bill";
    div.addEventListener("click", () => {
      resetFields();
      amountInput.value = amountValue;
      propertySelect.value = item.property;
      modal.style.display = "flex";
    });
  }

  historyList.appendChild(div);
});

document.addEventListener('DOMContentLoaded', function () {
  const openBtn = document.getElementById('payNowBtn');
  const closeBtn = document.getElementById('closeModal');

  if (openBtn) {
    openBtn.addEventListener('click', () => {
      resetFields();
      modal.style.display = 'flex';
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
      resetFields();
    });
  }

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
      resetFields();
    }
  });

  methodSelect.addEventListener('change', () => {
    const method = methodSelect.value;
    momoFields.classList.add('hidden');
    cardFields.classList.add('hidden');

    if (method === 'momo') {
      momoFields.classList.remove('hidden');
    } else if (method === 'card') {
      cardFields.classList.remove('hidden');
    }
  });

  document.getElementById('paymentForm').addEventListener('submit', (e) => {
    e.preventDefault();

    const amount = amountInput.value;
    const method = methodSelect.value;
    const property = propertySelect.value;

    if (!amount || !method || !property) {
      alert('Please fill all fields');
      return;
    }

    alert(`Payment of ₵${amount} for "${property}" via ${method} submitted!`);
    modal.style.display = 'none';
    resetFields();
  });

  function resetFields() {
    document.getElementById("paymentForm").reset();
    momoFields.classList.add("hidden");
    cardFields.classList.add("hidden");
    propertySelect.value = "all";
  }
  
  const currentPath = window.location.pathname.split('/').pop().split('?')[0];
  const menuItems = document.querySelectorAll('.sidebar-menu .menu-item');

  menuItems.forEach(link => {
    const href = link.getAttribute('href');
    if (href && href.includes(currentPath)) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
});
