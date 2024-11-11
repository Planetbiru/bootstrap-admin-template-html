// Function to populate notifications in the dropdown
function fillNotifications() {
    const notificationMenu = document.getElementById('notificationMenu');
    notifications.forEach(notification => {
        const a = document.createElement('a');
        a.className = 'dropdown-item';
        a.href = '#';
        
        a.innerHTML = `${notification.message} <small class="text-muted">${notification.time}</small>`;
        a.dataset.id = notification.id; // Adding ID to the notification item
        notificationMenu.appendChild(a);
    });
}

// Function to populate messages in the dropdown
function fillMessages() {
    const messageMenu = document.getElementById('messageMenu');
    messages.forEach(message => {
        const a = document.createElement('a');
        a.className = 'dropdown-item';
        a.href = '#';
        a.innerHTML = `${message.message} <small class="text-muted">${message.time}</small>`;
        a.dataset.id = message.id; // Adding ID to the message item
        messageMenu.appendChild(a);
    });
}

// Populate the menu and dropdown when the page loads
document.addEventListener('DOMContentLoaded', () => {
    fillNotifications();  // Fill the notifications dropdown
    fillMessages();       // Fill the messages dropdown

    // Toggle sidebar visibility
    // Select all elements with the class .toggle-sidebar
    document.querySelectorAll('.toggle-sidebar').forEach(toggleButton => {
        toggleButton.addEventListener('click', () => {
            let width = document.body.clientWidth;
            if (width >= 992) {
                document.body.classList.toggle('sidebar-hidden'); // Hide or show the sidebar for large screens
            } else {
                document.body.classList.toggle('sidebar-show'); // Hide or show the sidebar for small screens
            }
        });
    });

    // Toggle between light and dark modes
    document.querySelector('.toggle-mode').addEventListener('click', () => {
        document.body.classList.toggle('dark-mode'); // Switch to dark mode
        document.body.classList.toggle('light-mode'); // Switch to light mode
    });

});
