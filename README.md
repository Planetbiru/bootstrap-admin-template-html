
# MagicAppBuilder Bootstrap Admin Template

## Overview

The **MagicAppBuilder Bootstrap Admin Template** is a fully responsive, user-friendly admin dashboard template built with **pure HTML**, **CSS**, and **JavaScript**. It is designed to be used as the default theme for web applications created with **MagicAppBuilder**. This template does not rely on any server-side scripting or back-end technologies, making it a lightweight, easy-to-deploy solution for your web projects. It can be run on any web server and is compatible with all major operating systems.

Users can easily modify the template to fit their specific needs or create entirely new themes to match their branding and functionality requirements.

## Features

-   **Responsive Design**: The template is fully responsive, ensuring it works seamlessly on desktop, tablet, and mobile devices.
-   **Modern UI**: Built using the popular **Bootstrap 4** framework, the template offers a clean, modern, and intuitive interface.
-   **Customizable**: You can modify the template's design, layout, and functionality to meet your needs. It is flexible and easy to customize using HTML, CSS, and JavaScript.
-   **Multiple Pages**: The template includes a range of pages such as the **dashboard**, **user profile**, **settings**, and **tables**, to provide a solid starting point for your admin panel.
-   **Interactive Elements**: It comes with built-in interactive elements such as dropdowns, modals, tooltips, and collapsible menus, powered by **Bootstrap 4** JavaScript components.
-   **No Server-Side Dependencies**: This is a front-end only template, so it does not require any server-side scripting. It can be deployed on any static web server.

## Installation

1.  **Download or Clone the Repository**: You can download the template from the repository or clone it using Git:

1. Download or Clone the Repository: You can download the template from the repository or clone it using Git:

```bash
git clone https://github.com/Planetbiru/bootstrap-admin-template-html.git
```

2. Directory Structure: The template includes the following key directories and files:

```bash
/css             - Contains CSS, JavaScript, and image files
/js              - Contains JavaScript files for interactivity
/index.html      - The main HTML template file (Dashboard)
/profile.html    - User Profile page
/settings.html   - Settings page for the admin panel
```

3. Running the Template: Since this is a static HTML template, you can simply upload the files to your web server or run it locally by opening the index.html file in your browser.

    - To run locally, open the index.html file in any modern web browser.
    - To deploy it to a server, upload the entire project folder to your server and access it via your domain or IP address.


## Customization

The MagicAppBuilder Bootstrap Admin Template is built with flexibility in mind. You can modify the following aspects:

### 1. **Layout**:

-   The layout is based on **Bootstrap 4's grid system**, which means you can adjust columns, rows, and containers to fit your design.
-   You can add or remove sections such as sidebars, navigation bars, or content areas.

### 2. **Styling**:

-   You can modify the color scheme, fonts, and other visual elements by updating the **CSS** files in the `/css` folder.
-   If you want to create a new theme, you can easily add your custom styles or modify the existing ones.

### 3. **JavaScript Components**:

-   The template includes JavaScript to handle interactive components like dropdowns, modals, tooltips, and collapsible menus. These are powered by **Bootstrap 4's JavaScript** library.
-   You can extend the JavaScript functionality by adding more custom scripts in the `/js` folder.

### 4. **Content**:

-   The template includes placeholder content in the form of user profiles, tables, charts, and widgets. You can replace these placeholders with your own content as per your requirements.

## Examples of Customization

### Change Sidebar Color:

In the `css/style.css` file, you can modify the sidebar color by adjusting the following CSS rule:

```css
/* Change the sidebar background color */
.sidebar {
    background-color: #343a40; /* Example: Dark gray color */
}
```

### Add New Menu Item:

To add a new item to the sidebar menu, simply update the index.html file under the sidebar <ul> section:

```js
    // Notification data from the server in JSON format
    const notifications = [
        {"id": 1, "message": "Notification 1", "time": "5 minutes ago"},
        {"id": 2, "message": "Notification 2", "time": "10 minutes ago"}
    ];

    // Message data from the server in JSON format
    const messages = [
        {"id": 1, "message": "Message 1", "time": "1 minute ago"},
        {"id": 2, "message": "Message 2", "time": "3 minutes ago"}
    ];

```

### Modify JavaScript for Additional Functionality:

You can add custom JavaScript to extend the template's functionality. For example, you could add a new button to toggle between light and dark modes:

```js
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
```

## Dependencies

-   **Bootstrap 4**: A front-end framework for building responsive and mobile-first websites.
-   **Font Awesome**: For vector icons and social logos.
-   **jQuery**: For easier DOM manipulation and event handling.
-   **Popper.js**: For tooltips and popovers.

All dependencies are included in the `assets` folder, so there is no need for additional installations.

## Browser Support

This template is designed to work with modern web browsers, including:

-   Google Chrome
-   Mozilla Firefox
-   Safari
-   Microsoft Edge

## Contributing

Feel free to fork the repository and submit pull requests if you have improvements, bug fixes, or new features to contribute. We welcome contributions to enhance this template further.

### Steps to contribute:

1. Fork the repository.
2. Create a new branch for your changes.
3. Make your changes and test them.
4. Submit a pull request with a description of your changes.

## External Link

- Link to MagicAppBuilder - https://github.com/Planetbiru/MagicAppBuilder
- Link to MagicApp - https://github.com/Planetbiru/MagicApp
- Link to MagicObject - https://github.com/Planetbiru/MagicObject



## License

This project is licensed under the **MIT License**. You are free to use, modify, and distribute the template, as long as you include the appropriate credit and license.

## Conclusion

The MagicAppBuilder Bootstrap Admin Template provides a solid foundation for creating modern, responsive web applications and admin dashboards. Whether you're building a project from scratch or integrating it into an existing app, this template offers the flexibility and customization options to suit your needs.

Feel free to modify it as you see fit and create new themes or layouts that match your project's unique requirements.
