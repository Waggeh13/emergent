document.addEventListener('DOMContentLoaded', function () {
    const addAdminBtn = document.getElementById('addAdminBtn');
    const modal = document.getElementById('adminModal');
    const closeBtn = document.querySelector('.close');
    const adminForm = document.getElementById('adminForm');
    const adminsTable = document.querySelector('.districts-table tbody');
    const modalTitle = document.getElementById('modalTitle');
    const deleteConfirmModal = document.getElementById('deleteConfirmModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

    let currentEditId = null;
    let deleteTargetId = null;
    let admins = [];

    addAdminBtn.addEventListener('click', openAddModal);
    closeBtn.addEventListener('click', closeModal);
    window.addEventListener('click', outsideClick);
    adminForm.addEventListener('submit', handleFormSubmit);
    confirmDeleteBtn.addEventListener('click', confirmDelete);
    cancelDeleteBtn.addEventListener('click', cancelDelete);

    renderAdmins();

    function renderAdmins() {
        adminsTable.innerHTML = '';

        if (admins.length === 0) {
            adminsTable.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">
                        No admin accounts found. Click "Add Admin" to create one.
                    </td>
                </tr>
            `;
            return;
        }

        admins.forEach(admin => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${admin.name}</td>
                <td>${admin.email}</td>
                <td>${admin.district}</td>
                <td>${admin.status}</td>
                <td class="actions">
                    <button class="btn-edit" data-id="${admin.id}"><i class="fas fa-edit"></i></button>
                    <button class="btn-delete" data-id="${admin.id}"><i class="fas fa-trash"></i></button>
                </td>
            `;
            adminsTable.appendChild(row);
        });

        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', openEditModal);
        });

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', openDeleteModal);
        });
    }

    function openAddModal() {
        modalTitle.textContent = 'Add New Admin';
        adminForm.reset();
        currentEditId = null;
        modal.style.display = 'block';
        document.body.classList.add('modal-active');
    }

    function openEditModal(e) {
        const id = parseInt(e.currentTarget.getAttribute('data-id'));
        const admin = admins.find(a => a.id === id);

        if (admin) {
            modalTitle.textContent = 'Edit Admin';
            document.getElementById('adminName').value = admin.name;
            document.getElementById('adminEmail').value = admin.email;
            document.getElementById('adminDistrict').value = admin.district;
            document.getElementById('adminStatus').value = admin.status;
            // Only show password field on Add (you can optionally hide it here)
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

        const name = document.getElementById('adminName').value;
        const email = document.getElementById('adminEmail').value;
        const district = document.getElementById('adminDistrict').value;
        const status = document.getElementById('adminStatus').value;

        if (currentEditId) {
            const index = admins.findIndex(a => a.id === currentEditId);
            if (index !== -1) {
                admins[index] = {
                    id: currentEditId,
                    name,
                    email,
                    district,
                    status
                };
            }
        } else {
            const newId = admins.length > 0 ? Math.max(...admins.map(a => a.id)) + 1 : 1;
            admins.push({
                id: newId,
                name,
                email,
                district,
                status
            });
        }

        renderAdmins();
        closeModal();
    }

    function openDeleteModal(e) {
        deleteTargetId = parseInt(e.currentTarget.getAttribute('data-id'));
        deleteConfirmModal.style.display = 'block';
        document.body.classList.add('modal-active');
    }

    function confirmDelete() {
        if (deleteTargetId !== null) {
            admins = admins.filter(a => a.id !== deleteTargetId);
            renderAdmins();
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
