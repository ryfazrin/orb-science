import './bootstrap';

// Initialize Lucide icons on page load
document.addEventListener("DOMContentLoaded", () => {
    if (window.lucide) {
        lucide.createIcons();
    }
});
