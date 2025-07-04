document.addEventListener('DOMContentLoaded', function() {
    initSidebarToggle();
    
    initQuickActions();
});

function initSidebarToggle() {
    const sidebar = document.querySelector('.sidebar');
    const menuToggle = document.createElement('button');
}

function initQuickActions() {
    const uploadCsvBtn = document.getElementById('uploadCsvBtn');
    if (uploadCsvBtn) {
        uploadCsvBtn.addEventListener('click', function() {
            window.location.href = 'admin_properties.php?action=upload';
        });
    }

    const addPropertyBtn = document.getElementById('addPropertyBtn');
    if (addPropertyBtn) {
        addPropertyBtn.addEventListener('click', function() {
            window.location.href = 'admin_properties.php?action=add';
        });
    }

    const viewReportsBtn = document.getElementById('viewReportsBtn');
    if (viewReportsBtn) {
        viewReportsBtn.addEventListener('click', function() {
            window.location.href = 'admin_reports_analytics.php';
        });
    }
}