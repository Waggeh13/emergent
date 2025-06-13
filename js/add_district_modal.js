document.addEventListener('DOMContentLoaded', function () {
    const addDistrictBtn = document.getElementById('addDistrictBtn');
    const modal = document.getElementById('districtModal');
    const closeBtn = modal.querySelector('.close');
    const districtForm = document.getElementById('districtForm');
    const districtsTable = document.querySelector('.districts-table tbody');
    const modalTitle = document.getElementById('modalTitle');
    const deleteConfirmModal = document.getElementById('deleteConfirmModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

    let currentEditId = null;
    let deleteTargetId = null;
    let districts = [];

    addDistrictBtn.addEventListener('click', openAddModal);
    closeBtn.addEventListener('click', closeModal);
    window.addEventListener('click', outsideClick);
    districtForm.addEventListener('submit', handleFormSubmit);
    confirmDeleteBtn.addEventListener('click', confirmDelete);
    cancelDeleteBtn.addEventListener('click', cancelDelete);

    renderDistricts();

    function renderDistricts() {
        districtsTable.innerHTML = '';

        if (districts.length === 0) {
            districtsTable.innerHTML = `
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px;">
                        No districts found. Click "Add District" to create one.
                    </td>
                </tr>
            `;
            return;
        }

        districts.forEach(district => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${district.id}</td>
                <td>${district.name}</td>
                <td>₵${parseFloat(district.payment).toLocaleString()}</td>
                <td class="actions">
                    <button class="btn-edit" data-id="${district.id}"><i class="fas fa-edit"></i></button>
                    <button class="btn-delete" data-id="${district.id}"><i class="fas fa-trash"></i></button>
                </td>
            `;
            districtsTable.appendChild(row);
        });

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', openEditModal);
        });

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', openDeleteModal);
        });
    }

    function openAddModal() {
        modalTitle.textContent = 'Add New District';
        districtForm.reset();
        currentEditId = null;
        modal.style.display = 'block';
        document.body.classList.add('modal-active');
    }

    function openEditModal(e) {
        const id = e.currentTarget.getAttribute('data-id');
        const district = districts.find(d => d.id === id);

        if (district) {
            modalTitle.textContent = 'Edit District';
            document.getElementById('districtId').value = district.id;
            document.getElementById('districtName').value = district.name;
            document.getElementById('payment').value = district.payment;
            currentEditId = id;
            modal.style.display = 'block';
            document.body.classList.add('modal-active');
        }
    }

    function closeModal() {
        modal.style.display = 'none';
        document.body.classList.remove('modal-active');
    }

    function outsideClick(e) {
        if (e.target === modal) closeModal();
        if (e.target === deleteConfirmModal) cancelDelete();
    }

    function handleFormSubmit(e) {
        e.preventDefault();

        const id = document.getElementById('districtId').value.trim();
        const name = document.getElementById('districtName').value.trim();
        const payment = parseFloat(document.getElementById('payment').value.trim());

        if (!id || !name || isNaN(payment)) {
            alert('Please fill out all fields correctly.');
            return;
        }

        if (currentEditId) {
            const index = districts.findIndex(d => d.id === currentEditId);
            if (index !== -1) {
                districts[index] = { id, name, payment };
            }
        } else {
            if (districts.some(d => d.id === id)) {
                alert('District ID already exists.');
                return;
            }

            districts.push({ id, name, payment });
        }

        renderDistricts();
        closeModal();
    }

    function openDeleteModal(e) {
        deleteTargetId = e.currentTarget.getAttribute('data-id');
        deleteConfirmModal.style.display = 'block';
        document.body.classList.add('modal-active');
    }

    function confirmDelete() {
        if (deleteTargetId) {
            districts = districts.filter(d => d.id !== deleteTargetId);
            renderDistricts();
            deleteTargetId = null;
        }
        deleteConfirmModal.style.display = 'none';
        document.body.classList.remove('modal-active');
    }

    function cancelDelete() {
        deleteConfirmModal.style.display = 'none';
        document.body.classList.remove('modal-active');
        deleteTargetId = null;
    }
});
