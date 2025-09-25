document.addEventListener("DOMContentLoaded", function () {
    // Check if we're in admin or client panel first (they have their own navigation)
    const isAdminPanel = document.querySelector('#sidebar-toggle') !== null;
    const isClientPanel = document.querySelector('.admin-layout') !== null || 
                         document.querySelector('aside.sidebar') !== null;
    
    if (isAdminPanel || isClientPanel) {
        // Skip public site navigation on admin/client pages
        return;
    }
    
    const menuToggle = document.getElementById("menuToggle");
    const mobileMenu = document.getElementById("mobileMenu");
    const desktopNav = document.getElementById("navMenu");

    // Check if required elements exist (for frontend pages only)
    if (!menuToggle || !mobileMenu) {
        console.warn("Mobile menu elements not found - skipping mobile menu initialization");
        return;
    }

    // Fonction pour s'assurer que le menu desktop est masqué en mobile (not needed with CSS)
    function ensureDesktopNavHidden() {
        // CSS handles this now with media queries
        return;
    }

    // Appliquer au chargement
    ensureDesktopNavHidden();

    // Fonction pour ouvrir le menu
    function openMenu() {
        mobileMenu.classList.remove("hidden");
        // Force reflow for smooth animation
        mobileMenu.offsetHeight;
        mobileMenu.classList.add("active");
        menuToggle.innerHTML = '<i class="fas fa-times text-white text-xl"></i>';
        menuToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden'; // Empêche le scroll
    }

    // Fonction pour fermer le menu
    function closeMenu() {
        mobileMenu.classList.remove("active");
        // Wait for animation to complete before hiding
        setTimeout(() => {
            if (!mobileMenu.classList.contains("active")) {
                mobileMenu.classList.add("hidden");
            }
        }, 300);
        menuToggle.innerHTML = '<i class="fas fa-bars text-white text-xl"></i>';
        menuToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = ''; // Restaure le scroll
    }

    // Gestionnaire de clic pour le bouton burger
    menuToggle.addEventListener("click", function (e) {
        e.stopPropagation();
        if (mobileMenu.classList.contains("active")) {
            closeMenu();
        } else {
            openMenu();
        }
    });

    // Gestionnaire pour la touche Entrée sur le bouton burger (accessibilité)
    menuToggle.addEventListener("keydown", function(e) {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            if (mobileMenu.classList.contains("active")) {
                closeMenu();
            } else {
                openMenu();
            }
        }
    });

    // Fermer le menu en cliquant sur un lien
    const mobileLinks = mobileMenu.querySelectorAll('a, button');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Ne pas fermer si c'est un bouton de déconnexion (pour la confirmation)
            if (link.tagName === 'BUTTON' && link.type === 'submit') {
                return;
            }
            closeMenu();
        });
    });

    // Fermer le menu en cliquant à l'extérieur
    document.addEventListener('click', function(e) {
        if (mobileMenu.classList.contains("active") && 
            !mobileMenu.contains(e.target) && 
            !menuToggle.contains(e.target)) {
            closeMenu();
        }
    });

    // Fermer le menu avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains("active")) {
            closeMenu();
        }
    });

    // Gestion du redimensionnement de la fenêtre
    window.addEventListener('resize', function() {
        ensureDesktopNavHidden();
        if (window.innerWidth >= 1024 && mobileMenu.classList.contains("active")) {
            closeMenu();
        }
    });

    // Navbar scroll effect
    const navbar = document.querySelector('.site-wrapper .navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
});
