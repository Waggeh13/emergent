document.addEventListener('DOMContentLoaded', function () {
    const addDistrictBtn = document.getElementById('addDistrictBtn');
    const modal = document.getElementById('districtModal');
    const closeBtn = document.querySelector('.close');
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
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        No districts found. Click "Add District" to create one.
                    </td>
                </tr>
            `;
            return;
        }

        districts.forEach(district => {
            const percentage = ((district.collected / district.billed) * 100).toFixed(1);

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${district.name}</td>
                <td>₵${district.billed.toLocaleString()}</td>
                <td>₵${district.collected.toLocaleString()}</td>
                <td>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: ${percentage}%"></div>
                        <span>${percentage}%</span>
                    </div>
                </td>
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
        const id = parseInt(e.currentTarget.getAttribute('data-id'));
        const district = districts.find(d => d.id === id);

        if (district) {
            modalTitle.textContent = 'Edit District';
            document.getElementById('districtName').value = district.name;
            document.getElementById('billedAmount').value = district.billed;
            document.getElementById('collectedAmount').value = district.collected;
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
        if (e.target === modal) {
            closeModal();
        }
        if (e.target === deleteConfirmModal) {
            cancelDelete();
        }
    }

    function handleFormSubmit(e) {
        e.preventDefault();

        const name = document.getElementById('districtName').value;
        const billed = parseFloat(document.getElementById('billedAmount').value);
        const collected = parseFloat(document.getElementById('collectedAmount').value);

        if (currentEditId) {
            const index = districts.findIndex(d => d.id === currentEditId);
            if (index !== -1) {
                districts[index] = {
                    id: currentEditId,
                    name,
                    billed,
                    collected
                };
            }
        } else {
            const newId = districts.length > 0 ? Math.max(...districts.map(d => d.id)) + 1 : 1;
            districts.push({ id: newId, name, billed, collected });
        }

        renderDistricts();
        closeModal();
    }

    // Open Delete Confirmation Modal
    function openDeleteModal(e) {
        deleteTargetId = parseInt(e.currentTarget.getAttribute('data-id'));
        deleteConfirmModal.style.display = 'block';
        document.body.classList.add('modal-active');
    }

    // Confirm delete action
    function confirmDelete() {
        if (deleteTargetId !== null) {
            districts = districts.filter(d => d.id !== deleteTargetId);
            renderDistricts();
            deleteTargetId = null;
        }
        deleteConfirmModal.style.display = 'none';
        document.body.classList.remove('modal-active');
    }

    // Cancel delete action
    function cancelDelete() {
        deleteConfirmModal.style.display = 'none';
        document.body.classList.remove('modal-active');
        deleteTargetId = null;
    }
});
