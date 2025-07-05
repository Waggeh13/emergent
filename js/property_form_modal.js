document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('propertyFile');
    const fileNameDisplay = document.getElementById('fileName');
    const uploadForm = document.getElementById('uploadForm');
    const tableBody = document.querySelector('.property-table tbody');
    const addPropertyBtn = document.querySelector('.add-property-btn');
    const modal = document.getElementById('addPropertyModal');
    const closeModal = document.querySelector('.close-modal');
    const cancelBtn = document.querySelector('.cancel-btn');
    const propertyForm = document.getElementById('propertyForm');
    const deleteModal = document.getElementById('deleteConfirmModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const editModal = document.getElementById('editPropertyModal');
    const closeEditModalBtn = document.querySelector('.close-edit-modal');
    const cancelEditBtn = document.querySelector('.cancel-edit-btn');
    const editForm = document.getElementById('editPropertyForm');

    let currentEditCode = null;
    let deleteTargetCode = null;

    fileInput.addEventListener('change', function () {
        fileNameDisplay.textContent = this.files.length > 0 ? this.files[0].name : 'No file chosen';
    });

    function renderProperties(properties) {
        tableBody.innerHTML = '';

        if (!properties || properties.length === 0) {
            tableBody.innerHTML = `
                <tr class="no-data-row">
                    <td colspan="10" style="text-align: center;">No properties found.</td>
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
                <td>${property.assessment}</td>
                <td><span class="status-badge ${property.payment_status.toLowerCase()}">${property.payment_status}</span></td>
                <td class="action-cell">
                    <i class="fas fa-edit edit-icon" data-code="${property.property_code}" title="Edit"></i>
                    <i class="fas fa-trash delete-icon" data-code="${property.property_code}" title="Delete"></i>
                </td>
            `;
            tableBody.appendChild(row);
        });

        document.querySelectorAll('.edit-icon').forEach(icon => {
            icon.addEventListener('click', openEditModal);
        });

        document.querySelectorAll('.delete-icon').forEach(icon => {
            icon.addEventListener('click', openDeleteModal);
        });
    }

    async function fetchProperties() {
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
                renderProperties(jsonResponse.data);
            } else {
                renderProperties([]);
            }
        } catch (error) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="10" style="text-align: center; padding: 20px;">
                        Error loading properties. Please try again.
                    </td>
                </tr>
            `;
        }
    }

    uploadForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (fileInput.files.length === 0) {
            alert('Please select a CSV file to upload.');
            return;
        }

        const formData = new FormData();
        formData.append('propertyFile', fileInput.files[0]);

        try {
            const response = await fetch('../actions/bulk_upload_properties.php', {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const jsonResponse = await response.json();
            if (jsonResponse.success) {
                fetchProperties();
                alert(jsonResponse.message);
                uploadForm.reset();
                fileNameDisplay.textContent = 'No file chosen';
            } else {
                alert(jsonResponse.message + (jsonResponse.errors.length > 0 ? '\nErrors:\n' + jsonResponse.errors.join('\n') : ''));
            }
        } catch (error) {
            alert('Error uploading CSV: ' + error.message);
        }
    });

    addPropertyBtn.addEventListener('click', () => {
        propertyForm.reset();
        currentEditCode = null;
        const originalCodeField = document.getElementById('originalPropertyCode');
        if (originalCodeField) originalCodeField.remove();
        modal.style.display = 'block';
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        propertyForm.reset();
    });

    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
        propertyForm.reset();
    });

    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
            propertyForm.reset();
        }
        if (e.target === editModal) {
            editModal.style.display = 'none';
            editForm.reset();
        }
        if (e.target === deleteModal) {
            deleteModal.style.display = 'none';
            deleteTargetCode = null;
        }
    });

    propertyForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(propertyForm);

        try {
            const response = await fetch('../actions/add_property.php', {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const jsonResponse = await response.json();
            if (jsonResponse.success) {
                fetchProperties();
                alert(jsonResponse.message);
                modal.style.display = 'none';
                propertyForm.reset();
            } else {
                alert(jsonResponse.message);
            }
        } catch (error) {
            alert('Error adding property: ' + error.message);
        }
    });

    async function openEditModal(e) {
        const propertyCode = e.target.getAttribute('data-code');

        try {
            const response = await fetch('../actions/view_property.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `property_code=${encodeURIComponent(propertyCode)}`,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const jsonResponse = await response.json();
            if (jsonResponse.success && jsonResponse.data && jsonResponse.data.length > 0) {
                const property = jsonResponse.data[0];
                editForm.elements['editPropertyCode'].value = property.property_code;
                editForm.elements['editOwnerName'].value = property.owner_name;
                editForm.elements['editPhone'].value = property.owner_phone_number;
                editForm.elements['editEmail'].value = property.email || '';
                editForm.elements['editAddress'].value = property.property_address;
                editForm.elements['editPropertyType'].value = property.property_type;
                editForm.elements['editCategory'].value = property.property_category;
                editForm.elements['editAssetValue'].value = property.assessment;
                editForm.elements['editRate'].value = property.rate;
                editForm.elements['editStatus'].value = property.payment_status;
                editForm.elements['editBillingCycle'].value = property.billing_cycle;

                let originalCodeField = document.getElementById('originalPropertyCode');
                if (!originalCodeField) {
                    originalCodeField = document.createElement('input');
                    originalCodeField.type = 'hidden';
                    originalCodeField.id = 'originalPropertyCode';
                    originalCodeField.name = 'originalPropertyCode';
                    editForm.appendChild(originalCodeField);
                }
                originalCodeField.value = property.property_code;

                currentEditCode = propertyCode;
                editModal.style.display = 'block';
            } else {
                alert(jsonResponse.message || 'Property not found.');
            }
        } catch (error) {
            alert('Error loading property data: ' + error.message);
        }
    }

    editForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(editForm);

        try {
            const response = await fetch('../actions/edit_property.php', {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const jsonResponse = await response.json();
            if (jsonResponse.success) {
                fetchProperties();
                alert(jsonResponse.message);
                editModal.style.display = 'none';
                editForm.reset();
            } else {
                alert(jsonResponse.message);
            }
        } catch (error) {
            alert('Error updating property: ' + error.message);
        }
    });

    closeEditModalBtn.addEventListener('click', () => {
        editModal.style.display = 'none';
        editForm.reset();
    });

    cancelEditBtn.addEventListener('click', () => {
        editModal.style.display = 'none';
        editForm.reset();
    });

    function openDeleteModal(e) {
        deleteTargetCode = e.target.getAttribute('data-code');
        deleteModal.style.display = 'block';
    }

    confirmDeleteBtn.addEventListener('click', async () => {
        if (deleteTargetCode) {
            try {
                const response = await fetch('../actions/delete_property.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `property_code=${encodeURIComponent(deleteTargetCode)}`,
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const jsonResponse = await response.json();
                if (jsonResponse.success) {
                    fetchProperties();
                    alert(jsonResponse.message);
                } else {
                    alert(jsonResponse.message);
                }
            } catch (error) {
                alert('Error deleting property: ' + error.message);
            } finally {
                deleteModal.style.display = 'none';
                deleteTargetCode = null;
            }
        }
    });

    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.style.display = 'none';
        deleteTargetCode = null;
    });

    fetchProperties();
});