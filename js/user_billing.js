document.addEventListener("DOMContentLoaded", () => {
  const billsData = [
    {
      property: "Luxury Villa, Accra",
      amount: "₵5,200",
      dueDate: "15 Oct 2023",
      status: "Paid"
    },
    {
      property: "Beach House, Takoradi",
      amount: "₵12,000",
      dueDate: "5 Oct 2023",
      status: "Paid"
    },
    {
      property: "Commercial Plaza, Kumasi",
      amount: "₵3,500",
      dueDate: "15 Nov 2023",
      status: "Pending"
    },
    {
      property: "Luxury Villa, Accra",
      amount: "₵2,800",
      dueDate: "15 Dec 2023",
      status: "Pending"
    }
  ];

  // DOM Elements
  const tableBody = document.querySelector(".bills-table tbody");
  const totalPaidEl = document.getElementById("totalPaid");
  const totalPendingEl = document.getElementById("totalPending");
  const totalOutstandingEl = document.getElementById("totalOutstanding");

  const modal = document.getElementById("paymentModal");
  const closeModalBtn = document.getElementById("closeModal");
  const propertyInput = document.getElementById("propertySelect");
  const amountInput = document.getElementById("amount");
  const methodSelect = document.getElementById("method");
  const momoFields = document.getElementById("mobileMoneyFields");
  const cardFields = document.getElementById("cardFields");

  const receiptModal = document.getElementById("receiptModal");
  const closeReceiptBtn = document.getElementById("closeReceiptModal");
  const receiptContent = document.getElementById("receiptContent");

  const downloadReceiptBtn = document.getElementById("downloadReceiptBtn");

  // Totals
  let totalPaid = 0;
  let totalPending = 0;

  // Populate Table
  billsData.forEach(bill => {
    const row = document.createElement("tr");
    const cleanAmount = parseFloat(bill.amount.replace(/[₵,]/g, ''));

    if (bill.status === "Paid") totalPaid += cleanAmount;
    if (bill.status === "Pending") totalPending += cleanAmount;

    row.innerHTML = `
      <td>${bill.property}</td>
      <td>${bill.amount}</td>
      <td>${bill.dueDate}</td>
      <td><span class="bill-status ${bill.status === "Paid" ? "status-paid" : "status-pending"}">${bill.status}</span></td>
      <td>
        <button class="action-btn ${bill.status === "Paid" ? "view-btn" : "pay-btn"}">
          ${bill.status === "Paid" ? "View Receipt" : "Pay Now"}
        </button>
      </td>
    `;
    tableBody.appendChild(row);
  });

  // Update Totals
  totalPaidEl.textContent = `₵${totalPaid.toLocaleString()}`;
  totalPendingEl.textContent = `₵${totalPending.toLocaleString()}`;
  totalOutstandingEl.textContent = `₵${totalPending.toLocaleString()}`;

  // Event Delegation for Pay/View
  document.addEventListener("click", function (e) {
    if (e.target.classList.contains("pay-btn")) {
      const row = e.target.closest("tr");
      const property = row.querySelector("td:first-child").textContent;
      const amount = row.querySelector("td:nth-child(2)").textContent;

      propertyInput.value = property;
      amountInput.value = parseFloat(amount.replace(/[₵,]/g, ''));
      methodSelect.value = "";
      momoFields.classList.add("hidden");
      cardFields.classList.add("hidden");

      modal.style.display = "flex";
    }

    if (e.target.classList.contains("view-btn")) {
      const row = e.target.closest("tr");
      const property = row.querySelector("td:first-child").textContent;
      const amount = row.querySelector("td:nth-child(2)").textContent;
      const dueDate = row.querySelector("td:nth-child(3)").textContent;

      const today = new Date().toLocaleDateString();
      const txnId = "TXN-" + Math.floor(100000000 + Math.random() * 900000000);

      receiptContent.innerHTML = `
        <p><strong>Property:</strong> ${property}</p>
        <p><strong>Amount Paid:</strong> ${amount}</p>
        <p><strong>Date Paid:</strong> ${today}</p>
        <p><strong>Due Date:</strong> ${dueDate}</p>
        <p><strong>Payment Method:</strong> Visa / MasterCard</p>
        <p><strong>Transaction ID:</strong> ${txnId}</p>
      `;

      receiptModal.style.display = "flex";
    }
  });

  // Close Modals
  closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });
  closeReceiptBtn.addEventListener("click", () => {
    receiptModal.style.display = "none";
  });

  // Show payment fields
  methodSelect.addEventListener("change", () => {
    momoFields.classList.add("hidden");
    cardFields.classList.add("hidden");

    if (methodSelect.value === "momo") {
      momoFields.classList.remove("hidden");
    } else if (methodSelect.value === "card") {
      cardFields.classList.remove("hidden");
    }
  });

  // Download PDF button handler
  downloadReceiptBtn.addEventListener("click", () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const receiptText = receiptContent.innerText || "";
    const lines = receiptText.split("\n");

    let y = 10;
    const lineHeight = 10;

    lines.forEach(line => {
      doc.text(line.trim(), 10, y);
      y += lineHeight;
    });

    doc.save("receipt.pdf");
  });

});
