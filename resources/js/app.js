document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    const themeToggle = document.getElementById('theme-toggle');
    const iconMoon = document.getElementById('theme-icon-moon');
    const iconSun = document.getElementById('theme-icon-sun');

    if (!themeToggle) return;

    const setTheme = (theme) => {
        html.setAttribute('data-bs-theme', theme);
        localStorage.setItem('theme', theme);
        
        if (theme === 'dark') {
            iconMoon.classList.remove('d-none');
            iconSun.classList.add('d-none');
        } else {
            iconMoon.classList.add('d-none');
            iconSun.classList.remove('d-none');
        }
    };

    // Initialize theme
    const storedTheme = localStorage.getItem('theme');
    const preferredTheme = storedTheme || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    setTheme(preferredTheme);

    // Toggle event
    themeToggle.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-bs-theme');
        setTheme(currentTheme === 'dark' ? 'light' : 'dark');
    });
});
