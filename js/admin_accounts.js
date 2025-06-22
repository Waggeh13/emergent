document.addEventListener('DOMContentLoaded', async function () {
    const addAdminBtn = document.getElementById('addAdminBtn');
    const modal = document.getElementById('adminModal');
    const closeBtn = modal.querySelector('.close');
    const adminForm = document.getElementById('adminForm');
    const adminsTable = document.querySelector('.districts-table tbody');
    const modalTitle = document.getElementById('modalTitle');
    const deleteConfirmModal = document.getElementById('deleteConfirmModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const adminDistrictSelect = document.getElementById('adminDistrict');

    let currentEditId = null;
    let deleteTargetId = null;

    addAdminBtn.addEventListener('click', openAddModal);
    closeBtn.addEventListener('click', closeModal);
    window.addEventListener('click', outsideClick);
    adminForm.addEventListener('submit', handleFormSubmit);
    confirmDeleteBtn.addEventListener('click', confirmDelete);
    cancelDeleteBtn.addEventListener('click', cancelDelete);

    await fetchDistricts(); // Populate district dropdown
    fetchAdmins();

    async function fetchDistricts() {
        try {
            const response = await fetch('../actions/view_districts.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const responseText = await response.text();
            let data;
            try {
                const jsonMatch = responseText.match(/\{[\s\S]*\}/);
                if (jsonMatch) {
                    data = JSON.parse(jsonMatch[0]);
                } else {
                    throw new Error('No valid JSON found in response');
                }
            } catch (jsonError) {
                console.error('Invalid JSON response:', responseText);
                throw new Error('Server returned invalid JSON: ' + responseText);
            }

            if (data.success && data.data && Array.isArray(data.data)) {
                adminDistrictSelect.innerHTML = '<option value="">Select District</option>';
                data.data.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.district_id;
                    option.textContent = district.district_name;
                    adminDistrictSelect.appendChild(option);
                });
            } else {
                console.error('Invalid district response:', data);
                adminDistrictSelect.innerHTML = '<option value="">No districts available</option>';
            }
        } catch (error) {
            console.error('Error fetching districts:', error, { stack: error.stack });
            adminDistrictSelect.innerHTML = '<option value="">Error loading districts</option>';
        }
    }

    async function fetchAdmins() {
        try {
            const response = await fetch('../actions/view_admins.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const responseText = await response.text();
            let jsonResponse;
            try {
                const jsonMatch = responseText.match(/\{[\s\S]*\}/);
                if (jsonMatch) {
                    jsonResponse = JSON.parse(jsonMatch[0]);
                } else {
                    throw new Error('No valid JSON found in response');
                }
            } catch (jsonError) {
                console.error('Invalid JSON response:', responseText);
                throw new Error('Server returned invalid JSON: ' + responseText);
            }

            if (jsonResponse.success && jsonResponse.data && Array.isArray(jsonResponse.data)) {
                renderAdmins(jsonResponse.data);
            } else {
                console.error('Invalid response format:', jsonResponse);
                renderAdmins([]);
            }
        } catch (error) {
            console.error('Error fetching admins:', error, { stack: error.stack });
            adminsTable.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">
                        Error loading admins. Please try again.
                    </td>
                </tr>
            `;
        }
    }

    function renderAdmins(admins) {
        adminsTable.innerHTML = '';

        if (!admins || admins.length === 0) {
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
                <td>${admin.admin_id}</td>
                <td>${admin.fullname}</td>
                <td>${admin.email}</td>
                <td>${admin.district_id}</td>
                <td>${admin.Status}</td>
                <td class="actions">
                    <button class="btn-edit" data-id="${admin.admin_id}"><i class="fas fa-edit"></i></button>
                    <button class="btn-delete" data-id="${admin.admin_id}"><i class="fas fa-trash"></i></button>
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
        document.getElementById('adminID').value = '';
        currentEditId = null;
        // Remove originalAdminID field if it exists
        const originalIdField = document.getElementById('originalAdminID');
        if (originalIdField) originalIdField.remove();
        modal.style.display = 'block';
        document.body.classList.add('modal-active');
    }

    async function openEditModal(e) {
        const id = e.currentTarget.getAttribute('data-id');
        
        try {
            const response = await fetch('../actions/view_admin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `admin_id=${encodeURIComponent(id)}`,
            });

            if (!response.ok) {
                const responseText = await response.text();
                console.error('Fetch error response:', responseText);
                throw new Error(`HTTP error! Status: ${response.status}, Response: ${responseText}`);
            }

            const responseText = await response.text();
            let data;
            try {
                const jsonMatch = responseText.match(/\{[\s\S]*\}/);
                if (jsonMatch) {
                    data = JSON.parse(jsonMatch[0]);
                } else {
                    throw new Error('No valid JSON found in response');
                }
            } catch (jsonError) {
                console.error('Invalid JSON response:', responseText);
                throw new Error('Server returned invalid JSON: ' + responseText);
            }

            if (data.success && data.data && data.data.length > 0) {
                const admin = data.data[0];
                modalTitle.textContent = 'Edit Admin';
                document.getElementById('adminID').value = admin.admin_id;
                document.getElementById('adminName').value = admin.fullname;
                document.getElementById('adminEmail').value = admin.email;
                document.getElementById('adminDistrict').value = admin.district_id;
                document.getElementById('adminStatus').value = admin.Status;
                currentEditId = id;

                // Add hidden input for original admin ID
                let originalIdField = document.getElementById('originalAdminID');
                if (!originalIdField) {
                    originalIdField = document.createElement('input');
                    originalIdField.type = 'hidden';
                    originalIdField.id = 'originalAdminID';
                    originalIdField.name = 'originalAdminID';
                    adminForm.appendChild(originalIdField);
                }
                originalIdField.value = admin.admin_id;

                modal.style.display = 'block';
                document.body.classList.add('modal-active');
            } else {
                console.error('Admin not found:', { admin_id: id, response: data });
                alert(data.message || 'Admin not found.');
            }
        } catch (error) {
            console.error('Error loading admin data:', error, { stack: error.stack });
            alert('Error loading admin data: ' + error.message);
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

        const form = document.getElementById('adminForm');
        const formData = new FormData(form);
        const actionUrl = currentEditId ? '../actions/edit_admin.php' : '../actions/add_admin.php';

        try {
            const response = await fetch(actionUrl, {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                const responseText = await response.text();
                console.error('Fetch error response:', responseText);
                throw new Error(`HTTP error! Status: ${response.status}, Response: ${responseText}`);
            }

            const responseText = await response.text();
            let data;
            try {
                const jsonMatch = responseText.match(/\{[\s\S]*\}/);
                if (jsonMatch) {
                    data = JSON.parse(jsonMatch[0]);
                } else {
                    throw new Error('No valid JSON found in response');
                }
            } catch (jsonError) {
                console.error('Invalid JSON response:', responseText);
                throw new Error('Server returned invalid JSON: ' + responseText);
            }

            if (data.success) {
                closeModal();
                fetchAdmins();
                alert('Admin saved successfully.');
            } else {
                console.error('Failed to save admin:', data.message);
                alert(data.message || 'Failed to save admin.');
                if (!currentEditId) form.reset();
            }
        } catch (error) {
            console.error('Error submitting form:', error, { stack: error.stack });
            alert('Error submitting form: ' + error.message);
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
                const response = await fetch('../actions/delete_admin.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `admin_id=${encodeURIComponent(deleteTargetId)}`,
                });

                if (!response.ok) {
                    const responseText = await response.text();
                    console.error('Fetch error response:', responseText);
                    throw new Error(`HTTP error! Status: ${response.status}, Response: ${responseText}`);
                }

                const responseText = await response.text();
                let data;
                try {
                    const jsonMatch = responseText.match(/\{[\s\S]*\}/);
                    if (jsonMatch) {
                        data = JSON.parse(jsonMatch[0]);
                    } else {
                        throw new Error('No valid JSON found in response');
                    }
                } catch (jsonError) {
                    console.error('Invalid JSON response:', responseText);
                    throw new Error('Server returned invalid JSON: ' + responseText);
                }

                if (data.success) {
                    fetchAdmins();
                    alert('Admin deleted successfully.');
                } else {
                    console.error('Failed to delete admin:', data.message);
                    alert(data.message || 'Failed to delete admin.');
                }
            } catch (error) {
                console.error('Error deleting admin:', error, { stack: error.stack });
                alert('Error deleting admin: ' + error.message);
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