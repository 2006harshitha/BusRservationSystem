// Better dropdown behavior
document.addEventListener('DOMContentLoaded', function() {
    const accountLink = document.getElementById('accountLink');
    const dropdown = document.querySelector('.dropdown-content');
    
    if (accountLink && dropdown) {
        accountLink.addEventListener('click', function(e) {
            e.preventDefault();
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.account-dropdown')) {
                dropdown.style.display = 'none';
            }
        });
    }
});