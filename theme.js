// Function to apply the saved theme
function applyThemeToAllPages() {
    let savedTheme = localStorage.getItem('theme');

    if (savedTheme) {
        // Apply theme class to the <body> tag instead of <html> to prevent conflicts
        document.body.className = `theme-${savedTheme}`;
    }
}

// Function to set and save the theme
function setTheme(theme) {
    localStorage.setItem('theme', theme);
    applyThemeToAllPages();
}

// Apply the theme on page load
document.addEventListener("DOMContentLoaded", applyThemeToAllPages);
