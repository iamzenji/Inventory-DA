import './bootstrap';
// for setting Collapse
document.getElementById('settings-toggle').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default action of the link

    var dropdown = document.getElementById('settings-dropdown');

    // Toggle the display of the dropdown
    if (dropdown.style.display === 'none' || dropdown.style.display === '') {
      dropdown.style.display = 'block'; // Show the dropdown
    } else {
      dropdown.style.display = 'none'; // Hide the dropdown
    }
});
