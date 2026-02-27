/**
 * Components Loader
 * Dynamically loads header and footer HTML components
 */

// Load component into placeholder element
async function loadComponent(elementId, componentPath, basePath) {
    try {
        const response = await fetch(componentPath);
        if (!response.ok) {
            throw new Error(`Failed to load ${componentPath}`);
        }
        let html = await response.text();

        // Fix paths in the loaded HTML based on the current page's base path
        // Replace ./ with the appropriate base path
        html = html.replace(/href="\.\//g, `href="${basePath}`)
            .replace(/src="\.\//g, `src="${basePath}`)
            .replace(/href="portfolio\//g, `href="${basePath}portfolio/`)
            .replace(/href="archive\//g, `href="${basePath}archive/`)
            .replace(/href="service\//g, `href="${basePath}service/`)
            .replace(/href="about\.html"/g, `href="${basePath}about.html"`)
            .replace(/href="contact\.html"/g, `href="${basePath}contact.html"`);

        const element = document.getElementById(elementId);
        if (element) {
            element.innerHTML = html;
        }
    } catch (error) {
        console.error('Component loading error:', error);
    }
}

// Initialize components when DOM is ready
document.addEventListener('DOMContentLoaded', async () => {
    // Determine base path for components
    const basePath = getBasePath();

    // Load header and footer components
    await Promise.all([
        loadComponent('header-placeholder', basePath + 'components/header.html', basePath),
        loadComponent('footer-placeholder', basePath + 'components/footer.html', basePath)
    ]);

    // Re-initialize any scripts that depend on loaded components
    initializeNavigation();
    initializeDarkMode();
    initializeMoveTop();
    initializeSubmenuHover();
});

// Get the base path based on current page location
function getBasePath() {
    const path = window.location.pathname;
    // Count directory depth from hivemedia_homepage
    const parts = path.split('/');
    const rootIndex = parts.findIndex(p => p === 'hivemedia_homepage');
    if (rootIndex >= 0) {
        const depth = parts.length - rootIndex - 2; // -2 for hivemedia_homepage and filename
        if (depth <= 0) return './';
        return '../'.repeat(depth);
    }
    // Default for root deployment
    return './';
}

// Navigation toggle functionality
function initializeNavigation() {
    const navOpenBtn = document.querySelector('.btn-nav-open');
    const navWrap = document.querySelector('.nav-wrap');

    if (navOpenBtn && navWrap) {
        navOpenBtn.addEventListener('click', () => {
            navWrap.classList.toggle('open');
            navOpenBtn.classList.toggle('on');
        });
    }
}

// Dark mode toggle functionality
function initializeDarkMode() {
    const darkModeBtn = document.querySelector('.btn-dark-light');
    const checkbox = document.querySelector('.btn-dark-light .light');

    if (darkModeBtn && checkbox) {
        // Check saved preference
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            checkbox.checked = true;
        }

        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        });
    }
}

// Move to top button functionality
function initializeMoveTop() {
    const moveTopBtn = document.querySelector('.btn-move-top');

    if (moveTopBtn) {
        moveTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Show/hide based on scroll position
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                moveTopBtn.parentElement.classList.add('show');
            } else {
                moveTopBtn.parentElement.classList.remove('show');
            }
        });
    }
}

// Submenu hover functionality
function initializeSubmenuHover() {
    const menuItems = document.querySelectorAll('.nav-left .inn > ul > li > a[data-menu]');
    const submenuGroups = document.querySelectorAll('.nav-submenu-group[data-for]');

    if (!menuItems.length || !submenuGroups.length) return;

    menuItems.forEach(function (item) {
        const menuKey = item.getAttribute('data-menu');
        const target = document.querySelector('.nav-submenu-group[data-for="' + menuKey + '"]');

        if (target) {
            item.parentElement.addEventListener('mouseenter', function () {
                submenuGroups.forEach(function (g) { g.classList.remove('active'); });
                target.classList.add('active');
            });

            item.parentElement.addEventListener('mouseleave', function () {
                target.classList.remove('active');
            });
        }
    });

    // Keep submenu visible when hovering over it
    submenuGroups.forEach(function (group) {
        group.addEventListener('mouseenter', function () {
            group.classList.add('active');
        });
        group.addEventListener('mouseleave', function () {
            group.classList.remove('active');
        });
    });
}
