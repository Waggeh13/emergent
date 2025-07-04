document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('propertyFile');
    const fileNameDisplay = document.getElementById('fileName');
    const uploadForm = document.getElementById('uploadForm');
    const tableBody = document.querySelector('.property-table tbody');

    fileInput.addEventListener('change', function () {
        fileNameDisplay.textContent = this.files.length > 0 ? this.files[0].name : 'No file chosen';
    });

    function removeNoDataRow() {
        const noDataRow = tableBody.querySelector('.no-data-row');
        if (noDataRow) noDataRow.remove();
    }

    function checkEmptyTable() {
        const dataRows = tableBody.querySelectorAll('tr');
        const hasRealData = Array.from(dataRows).some(row => !row.classList.contains('no-data-row'));

        if (!hasRealData) {
            const tr = document.createElement('tr');
            tr.classList.add('no-data-row');
            const td = document.createElement('td');
            td.colSpan = 9;
            td.style.textAlign = 'center';
            td.textContent = 'No properties found.';
            tr.appendChild(td);
            tableBody.appendChild(tr);
        }
    }

    checkEmptyTable();

    function capitalizeWords(str) {
        return str.replace(/\b\w/g, char => char.toUpperCase());
    }

    uploadForm.addEventListener('submit', function (e) {
        e.preventDefault();

        if (fileInput.files.length === 0) return;

        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const csv = e.target.result.trim();
            const rows = csv.split('\n');
            const headers = rows[0].split(',').map(h => h.trim().toLowerCase());

            const requiredHeaders = ['property code', 'owner name', 'phone number', 'email', 'address', 'type', 'category'];
            const isValid = requiredHeaders.every(h => headers.includes(h));
            if (!isValid) return;

            tableBody.innerHTML = '';
            removeNoDataRow();

            rows.slice(1).forEach(row => {
                const values = row.split(',').map(val => val.trim());
                const rowData = {};
                headers.forEach((header, i) => {
                    rowData[header] = values[i] || '';
                });

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${capitalizeWords(rowData['property code'])}</td>
                    <td>${capitalizeWords(rowData['owner name'])}</td>
                    <td>${rowData['phone number']}</td>
                    <td>${rowData['email']}</td>
                    <td>${capitalizeWords(rowData['address'])}</td>
                    <td>${capitalizeWords(rowData['type'])}</td>
                    <td>${capitalizeWords(rowData['category'])}</td>
                    <td><span class="status-badge unpaid">Unpaid</span></td>
                    <td class="action-cell">
                        <i class="fas fa-edit edit-icon" title="Edit"></i>
                        <i class="fas fa-trash delete-icon" title="Delete"></i>
                    </td>
                `;
                tableBody.appendChild(tr);
            });

            checkEmptyTable();
            uploadForm.reset();
            fileNameDisplay.textContent = 'No file chosen';
        };

        reader.readAsText(file);
    });

    // ===== Manual Add Property Modal =====
    const addPropertyBtn = document.querySelector('.add-property-btn');
    const modal = document.getElementById('addPropertyModal');
    const closeModal = document.querySelector('.close-modal');
    const cancelBtn = document.querySelector('.cancel-btn');
    const propertyForm = document.getElementById('propertyForm');

    addPropertyBtn.addEventListener('click', () => modal.style.display = 'block');
    closeModal.addEventListener('click', () => modal.style.display = 'none');
    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        propertyForm.reset();
    });

    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    propertyForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const propertyData = {
            'Property Code': propertyForm.elements['propertyCode'].value.trim(),
            'Owner Name': propertyForm.elements['OwnerName'].value.trim(),
            'Phone Number': propertyForm.elements['phone'].value.trim(),
            'Email': propertyForm.elements['email'].value.trim(),
            'Address': propertyForm.elements['address'].value.trim(),
            'Type': propertyForm.elements['propertyType'].value,
            'Category': propertyForm.elements['category'].value
        };

        if (
            !propertyData['Property Code'] ||
            !propertyData['Owner Name'] ||
            !propertyData['Phone Number'] ||
            !propertyData['Type'] ||
            !propertyData['Category']
        ) {
            return;
        }

        removeNoDataRow();

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${capitalizeWords(propertyData['Property Code'])}</td>
            <td>${capitalizeWords(propertyData['Owner Name'])}</td>
            <td>${propertyData['Phone Number']}</td>
            <td>${capitalizeWords(propertyData['Email'])}</td>
            <td>${capitalizeWords(propertyData['Address'])}</td>
            <td>${capitalizeWords(propertyData['Type'])}</td>
            <td>${capitalizeWords(propertyData['Category'])}</td>
            <td><span class="status-badge unpaid">Unpaid</span></td>
            <td class="action-cell">
                <i class="fas fa-edit edit-icon" title="Edit"></i>
                <i class="fas fa-trash delete-icon" title="Delete"></i>
            </td>
        `;
        tableBody.appendChild(tr);
        checkEmptyTable();
        propertyForm.reset();
        modal.style.display = 'none';
    });

    // ===== Delete & Edit Modal Logic =====
    const deleteModal = document.getElementById('deleteConfirmModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const editModal = document.getElementById('editPropertyModal');
    const closeEditModalBtn = document.querySelector('.close-edit-modal');
    const cancelEditBtn = document.querySelector('.cancel-edit-btn');
    const editForm = document.getElementById('editPropertyForm');

    let rowToEdit = null;
    let rowToDelete = null;

    document.body.addEventListener('click', function (e) {
        if (e.target.classList.contains('edit-icon')) {
            rowToEdit = e.target.closest('tr');
            const cells = rowToEdit.querySelectorAll('td');

            editForm.elements['editOwnerName'].value = cells[1].textContent.trim();
            editForm.elements['editPhone'].value = cells[2].textContent.trim();
            editForm.elements['editEmail'].value = cells[3].textContent.trim();
            editForm.elements['editPropertyType'].value = cells[5].textContent.trim();
            editForm.elements['editCategory'].value = cells[6].textContent.trim();

            editModal.style.display = 'block';
        }

        if (e.target.classList.contains('delete-icon')) {
            rowToDelete = e.target.closest('tr');
            deleteModal.style.display = 'block';
        }
    });

    editForm.addEventListener('submit', function (e) {
        e.preventDefault();
        if (rowToEdit) {
            const cells = rowToEdit.querySelectorAll('td');
            cells[1].textContent = editForm.elements['editOwnerName'].value.trim();
            cells[2].textContent = editForm.elements['editPhone'].value.trim();
            cells[3].textContent = editForm.elements['editEmail'].value.trim();
            cells[5].textContent = editForm.elements['editPropertyType'].value.trim();
            cells[6].textContent = editForm.elements['editCategory'].value.trim();
        }

        editModal.style.display = 'none';
        editForm.reset();
    });

    closeEditModalBtn.addEventListener('click', () => {
        editModal.style.display = 'none';
        editForm.reset();
    });

    cancelEditBtn.addEventListener('click', () => {
        editModal.style.display = 'none';
        editForm.reset();
    });

    confirmDeleteBtn.addEventListener('click', () => {
        if (rowToDelete) {
            rowToDelete.remove();
            checkEmptyTable();
            rowToDelete = null;
        }
        deleteModal.style.display = 'none';
    });

    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.style.display = 'none';
        rowToDelete = null;
    });

    window.addEventListener('click', function (e) {
        if (e.target === deleteModal) {
            deleteModal.style.display = 'none';
        }
        if (e.target === editModal) {
            editModal.style.display = 'none';
            editForm.reset();
        }
    });
});
