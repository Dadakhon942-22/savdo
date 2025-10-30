import './bootstrap';

// Dark Mode - oddiy va ishonchli
const html = document.documentElement;

// Default: Light mode
html.classList.remove('dark');

document.addEventListener('DOMContentLoaded', function() {
    const darkModeButton = document.getElementById('darkModeButton');
    
    // LocalStorage'dan holatni olish
    const savedMode = localStorage.getItem('darkMode');
    
    // Agar dark mode saqlangan bo'lsa
    if (savedMode === 'enabled') {
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
        localStorage.setItem('darkMode', 'disabled');
    }
    
    // Toggle button
    if (darkModeButton) {
        darkModeButton.addEventListener('click', function() {
            html.classList.toggle('dark');
            
            if (html.classList.contains('dark')) {
                localStorage.setItem('darkMode', 'enabled');
            } else {
                localStorage.setItem('darkMode', 'disabled');
            }
        });
    }
});
