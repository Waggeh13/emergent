document.addEventListener("DOMContentLoaded", () => {
  const payments = [
    {
      property: "Luxury Villa, Accra",
      amount: "₵5,200",
      date: "15 Oct 2023",
      dueDate: "15 Oct 2023",
      method: "Mobile Money",
      status: "Success"
    },
    {
      property: "Beach House, Takoradi",
      amount: "₵12,000",
      date: "5 Oct 2023",
      dueDate: "5 Oct 2023",
      method: "Visa / MasterCard",
      status: "Success"
    },
    {
      property: "Commercial Plaza, Kumasi",
      amount: "₵3,500",
      date: "1 Nov 2023",
      dueDate: "1 Nov 2023",
      method: "Bank Transfer",
      status: "Success"
    }
  ];

  const tableBody = document.getElementById("paymentsTableBody");
  const receiptModal = document.getElementById("receiptModal");
  const receiptContent = document.getElementById("receiptContent");
  const closeModal = document.getElementById("closeReceiptModal");
  const downloadBtn = document.getElementById("downloadReceiptBtn");

  payments.forEach(payment => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${payment.property}</td>
      <td>${payment.amount}</td>
      <td>${payment.date}</td>
      <td>${payment.method}</td>
      <td><span class="payment-status status-success">${payment.status}</span></td>
      <td><button class="download-btn" data-property="${payment.property}"><i class="fas fa-download"></i> Receipt</button></td>
    `;
    tableBody.appendChild(row);
  });

  document.addEventListener("click", e => {
    if (e.target.closest(".download-btn")) {
      const property = e.target.closest(".download-btn").dataset.property;
      const payment = payments.find(p => p.property === property);
      const today = new Date().toLocaleDateString();
      const txnId = "TXN-" + Math.floor(100000000 + Math.random() * 900000000);

      receiptContent.innerHTML = `
        <p><strong>Property:</strong> ${payment.property}</p>
        <p><strong>Amount Paid:</strong> ${payment.amount}</p>
        <p><strong>Date Paid:</strong> ${today}</p>
        <p><strong>Due Date:</strong> ${payment.dueDate}</p>
        <p><strong>Payment Method:</strong> ${payment.method}</p>
        <p><strong>Transaction ID:</strong> ${txnId}</p>
      `;

      receiptModal.classList.add("show");
    }
  });

  closeModal.addEventListener("click", () => {
    receiptModal.classList.remove("show");
  });

  window.addEventListener("click", e => {
    if (e.target === receiptModal) {
      receiptModal.classList.remove("show");
    }
  });

  downloadBtn.addEventListener("click", () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const lines = receiptContent.innerText.split("\n");
    let y = 10;
    lines.forEach(line => {
      doc.text(line.trim(), 10, y);
      y += 10;
    });
    doc.save("receipt.pdf");
  });
});
