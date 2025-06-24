document.addEventListener('DOMContentLoaded', function() {
    // File input display
    const fileInput = document.getElementById('propertyFile');
    const fileNameDisplay = document.getElementById('fileName');
    
    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            fileNameDisplay.textContent = this.files[0].name;
        } else {
            fileNameDisplay.textContent = 'No file chosen';
        }
    });
    
    // Form submission
    const uploadForm = document.getElementById('uploadForm');
    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (fileInput.files.length === 0) {
            alert('Please select a file to upload');
            return;
        }
        
        // Here you would handle the file upload
        const formData = new FormData();
        formData.append('propertyFile', fileInput.files[0]);
        
        // Simulate upload (replace with actual AJAX call)
        console.log('Uploading file:', fileInput.files[0].name);
        alert('File uploaded successfully!');
        
        // Reset form
        uploadForm.reset();
        fileNameDisplay.textContent = 'No file chosen';
    });
    
    // Add Property Modal
    const addPropertyBtn = document.querySelector('.add-property-btn');
    const modal = document.getElementById('addPropertyModal');
    const closeModal = document.querySelector('.close-modal');
    
    addPropertyBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });
    
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // Table row actions
    const actionIcons = document.querySelectorAll('.action-icon');
    actionIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const row = this.closest('tr');
            const propertyCode = row.cells[0].textContent;
            alert(`Action triggered for property ${propertyCode}`);
        });
    });
});

// Add Property Form Handling
const propertyForm = document.getElementById('propertyForm');
const cancelBtn = document.querySelector('.cancel-btn');

cancelBtn.addEventListener('click', function() {
    document.getElementById('addPropertyModal').style.display = 'none';
    propertyForm.reset();
});

propertyForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Collect form data
    const propertyData = {
        code: document.getElementById('propertyCode').value,
        owner: document.getElementById('ownerName').value,
        phone: document.getElementById('phone').value,
        email: document.getElementById('email').value,
        address: document.getElementById('address').value,
        type: document.getElementById('propertyType').value,
        category: document.getElementById('category').value,
        assessmentValue: document.getElementById('assessmentValue').value,
        rateAmount: document.getElementById('rateAmount').value,
        billingCycle: document.getElementById('billingCycle').value
    };
    
    // Here you would typically send the data to your server
    console.log('Property Data:', propertyData);
    alert('Property added successfully!');
    
    // Reset form and close modal
    propertyForm.reset();
    document.getElementById('addPropertyModal').style.display = 'none';
    
    // In a real app, you would add the new property to the table
    // addPropertyToTable(propertyData);
});