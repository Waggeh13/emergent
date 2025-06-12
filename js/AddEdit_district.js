document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const addDistrictBtn = document.getElementById('addDistrictBtn');
    const modal = document.getElementById('districtModal');
    const closeBtn = document.querySelector('.close');
    const districtForm = document.getElementById('districtForm');
    const districtsTable = document.querySelector('.districts-table tbody');
    const modalTitle = document.getElementById('modalTitle');
    
    let currentEditId = null;

    // Sample data - in a real app, this would come from an API
    let districts = [
        { id: 1, name: 'District A', billed: 550000, collected: 280000 },
        { id: 2, name: 'District B', billed: 700000, collected: 410000 },
        { id: 3, name: 'District C', billed: 450000, collected: 300000 },
        { id: 4, name: 'District D', billed: 600000, collected: 380000 }
    ];

    // Event Listeners
    addDistrictBtn.addEventListener('click', openAddModal);
    closeBtn.addEventListener('click', closeModal);
    window.addEventListener('click', outsideClick);
    districtForm.addEventListener('submit', handleFormSubmit);

    // Initialize table
    renderDistricts();

    // Functions
    function renderDistricts() {
        districtsTable.innerHTML = '';
        
        districts.forEach(district => {
            const percentage = ((district.collected / district.billed) * 100).toFixed(1);
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${district.name}</td>
                <td>$${district.billed.toLocaleString()}</td>
                <td>$${district.collected.toLocaleString()}</td>
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

        // Add event listeners to edit/delete buttons
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', openEditModal);
        });
        
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', deleteDistrict);
        });
    }

    function openAddModal() {
        modalTitle.textContent = 'Add New District';
        districtForm.reset();
        currentEditId = null;
        modal.style.display = 'block';
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
        }
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    function outsideClick(e) {
        if (e.target === modal) {
            closeModal();
        }
    }

    function handleFormSubmit(e) {
        e.preventDefault();
        
        const name = document.getElementById('districtName').value;
        const billed = parseFloat(document.getElementById('billedAmount').value);
        const collected = parseFloat(document.getElementById('collectedAmount').value);
        
        if (currentEditId) {
            // Update existing district
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
            // Add new district
            const newId = districts.length > 0 ? Math.max(...districts.map(d => d.id)) + 1 : 1;
            districts.push({ id: newId, name, billed, collected });
        }
        
        renderDistricts();
        closeModal();
    }

    function deleteDistrict(e) {
        const id = parseInt(e.currentTarget.getAttribute('data-id'));
        if (confirm('Are you sure you want to delete this district?')) {
            districts = districts.filter(d => d.id !== id);
            renderDistricts();
        }
    }
});