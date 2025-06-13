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

    addDistrictBtn.addEventListener('click', openAddModal);
    closeBtn.addEventListener('click', closeModal);
    window.addEventListener('click', outsideClick);
    districtForm.addEventListener('submit', handleFormSubmit);
    confirmDeleteBtn.addEventListener('click', confirmDelete);
    cancelDeleteBtn.addEventListener('click', cancelDelete);

    fetchDistricts();

    async function fetchDistricts() {
        try {
            const response = await fetch('../actions/view_districts.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const jsonResponse = await response.json();
            if (jsonResponse.success && Array.isArray(jsonResponse.data)) {
                renderDistricts(jsonResponse.data);
            } else {
                renderDistricts([]);
            }
        } catch (error) {
            console.error('Error fetching districts:', error);
            districtsTable.innerHTML = `
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        Error loading districts. Please try again.
                    </td>
                </tr>
            `;
        }
    }

    async function renderDistricts(districts) {
        districtsTable.innerHTML = '';

        if (!districts || districts.length === 0) {
            districtsTable.innerHTML = `
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        No districts found. Click "Add District" to create one.
                    </td>
                </tr>
            `;
            return;
        }

        for (const district of districts) {
            try {
                const amountResponse = await fetch('../actions/district_amount.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `district_id=${encodeURIComponent(district.district_id)}`,
                });

                if (!amountResponse.ok) {
                    throw new Error('Network response was not ok');
                }

                const amountData = await amountResponse.json();
                const totalPaid = amountData.total_paid || 0;
                const totalOwed = amountData.total_owed || 0;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${district.district_id}</td>
                    <td>${district.district_name}</td>
                    <td>${totalPaid.toFixed(2)}</td>
                    <td>${totalOwed.toFixed(2)}</td>
                    <td class="actions">
                        <button class="btn-edit" data-id="${district.district_id}"><i class="fas fa-edit"></i></button>
                        <button class="btn-delete" data-id="${district.district_id}"><i class="fas fa-trash"></i></button>
                    </td>
                `;
                districtsTable.appendChild(row);
            } catch (error) {
                console.error(`Error fetching amounts for district ${district.district_id}:`, error);
            }
        }

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

    async function openEditModal(e) {
        const id = e.currentTarget.getAttribute('data-id');
        
        try {
            const response = await fetch('../actions/view_district.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `district_id=${encodeURIComponent(id)}`,
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            if (data && data.length > 0) {
                const district = data[0];
                modalTitle.textContent = 'Edit District';
                document.getElementById('districtId').value = district.district_id;
                document.getElementById('districtName').value = district.district_name;
                currentEditId = id;
                modal.style.display = 'block';
                document.body.classList.add('modal-active');
            } else {
                alert('District not found.');
            }
        } catch (error) {
            alert('Error loading district data. Please try again.');
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

    async function handleFormSubmit(e) {
        e.preventDefault();

        const form = document.getElementById('districtForm');
        const formData = new FormData(form);
        const actionUrl = currentEditId ? '../actions/update_district.php' : '../actions/add_district.php';

        try {
            const response = await fetch(actionUrl, {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();

            if (data.success) {
                alert(data.message);
                closeModal();
                fetchDistricts();
            } else {
                alert(data.message);
                form.reset();
            }
        } catch (error) {
            alert('An unexpected error occurred. Please try again.');
        }
    }

    function openDeleteModal(e) {
        deleteTargetId = e.currentTarget.getAttribute('data-id');
        deleteConfirmModal.style.display = 'block';
        document.body.classList.add('modal-active');
    }

    async function confirmDelete() {
        if (deleteTargetId) {
            try {
                const response = await fetch('../actions/delete_district.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `district_id=${encodeURIComponent(deleteTargetId)}`,
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();

                if (data.success) {
                    alert(data.message);
                    fetchDistricts();
                } else {
                    alert(data.message);
                }
            } catch (error) {
                alert('Error deleting district. Please try again.');
            } finally {
                deleteConfirmModal.style.display = 'none';
                document.body.classList.remove('modal-active');
                deleteTargetId = null;
            }
        }
    }

    function cancelDelete() {
        deleteConfirmModal.style.display = 'none';
        document.body.classList.remove('modal-active');
        deleteTargetId = null;
    }
});