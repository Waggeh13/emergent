document.addEventListener('DOMContentLoaded', function() {
  // Profile Edit Functionality
  const editProfileBtn = document.getElementById('editProfileBtn');
  const cancelEditBtn = document.getElementById('cancelEditBtn');
  const profileInfoView = document.getElementById('profileInfoView');
  const profileInfoForm = document.getElementById('profileInfoForm');
  
  editProfileBtn.addEventListener('click', function() {
    profileInfoView.style.display = 'none';
    profileInfoForm.style.display = 'block';
    editProfileBtn.style.display = 'none';
  });
  
  cancelEditBtn.addEventListener('click', function() {
    profileInfoView.style.display = 'grid';
    profileInfoForm.style.display = 'none';
    editProfileBtn.style.display = 'flex';
  });
  
  profileInfoForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const fullName = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;
    
    // Update view with new values
    document.getElementById('viewFullName').textContent = fullName;
    document.getElementById('viewEmail').textContent = email;
    document.getElementById('viewPhone').textContent = phone;
    document.getElementById('viewAddress').textContent = address;
    
    // Show success message (you can replace this with actual API call)
    alert('Profile updated successfully!');
    
    // Switch back to view mode
    profileInfoView.style.display = 'grid';
    profileInfoForm.style.display = 'none';
    editProfileBtn.style.display = 'flex';
  });
  
  // Password Change Functionality
  const changePasswordBtn = document.getElementById('changePasswordBtn');
  const cancelPasswordBtn = document.getElementById('cancelPasswordBtn');
  const passwordForm = document.getElementById('passwordForm');
  
  changePasswordBtn.addEventListener('click', function() {
    passwordForm.classList.add('active');
    changePasswordBtn.style.display = 'none';
  });
  
  cancelPasswordBtn.addEventListener('click', function() {
    passwordForm.classList.remove('active');
    changePasswordBtn.style.display = 'flex';
    // Clear password fields
    document.getElementById('currentPassword').value = '';
    document.getElementById('newPassword').value = '';
    document.getElementById('confirmPassword').value = '';
  });
  
  passwordForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    // Basic validation
    if (newPassword !== confirmPassword) {
      alert('New passwords do not match!');
      return;
    }
    
    if (newPassword.length < 8) {
      alert('Password must be at least 8 characters long!');
      return;
    }
    
    // Here you would typically make an API call to change the password
    alert('Password changed successfully!');
    
    // Reset form
    passwordForm.classList.remove('active');
    changePasswordBtn.style.display = 'flex';
    document.getElementById('currentPassword').value = '';
    document.getElementById('newPassword').value = '';
    document.getElementById('confirmPassword').value = '';
  });
  
  // User profile dropdown
  const userProfile = document.querySelector('.user-profile');
  userProfile.addEventListener('click', function() {
    document.querySelector('.dropdown-menu').classList.toggle('show');
  });
  
  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    if (!userProfile.contains(e.target)) {
      document.querySelector('.dropdown-menu').classList.remove('show');
    }
  });
});