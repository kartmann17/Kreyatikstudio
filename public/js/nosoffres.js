function openForm(buttonElement) {
    const card = buttonElement.closest('.pricing-card');
    const planName = card.getAttribute('data-plan');
    const planPrice = card.getAttribute('data-price');
    const planFull = card.getAttribute('data-full');

    // Remplir les champs cachés
    document.getElementById('inputPlan').value = planName;
    document.getElementById('inputPrice').value = planPrice;
    document.getElementById('inputFull').value = planFull;

    // Mettre à jour le titre du modal
    const modalTitle = document.getElementById('modal-title');
    modalTitle.textContent = planName === 'Site sur mesure' ?
        'Demander un devis personnalisé' :
        `Souscrire à l'offre ${planName}`;

    // Ouvrir le modal
    const modal = document.querySelector('.modal-overlay');
    modal.classList.add('active');
    modal.setAttribute('aria-hidden', 'false');

    // Focus sur le premier champ
    setTimeout(() => {
        const firstInput = document.getElementById('input-name');
        if (firstInput) firstInput.focus();
    }, 300);

    // Tracking analytics (optionnel)
    if (typeof gtag !== 'undefined') {
        gtag('event', 'begin_checkout', {
            'currency': 'EUR',
            'value': planPrice.replace('€/mois', ''),
            'items': [{
                'item_name': planName,
                'price': planPrice.replace('€/mois', ''),
                'quantity': 1
            }]
        });
    }
}

function closeForm() {
    const modal = document.querySelector('.modal-overlay');
    modal.classList.remove('active');
    modal.setAttribute('aria-hidden', 'true');

    // Réinitialiser le formulaire
    setTimeout(() => {
        const form = document.getElementById('offerForm');
        if (form) {
            form.reset();
            document.getElementById('error-message').classList.add('hidden');
            document.getElementById('success-message').classList.add('hidden');
        }
    }, 300);
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.querySelector('.modal-overlay');
    const modalContent = document.querySelector('.modal-content');

    // Fermer le modal en cliquant à l'extérieur
    if (modal && modalContent) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeForm();
            }
        });
    }

    // Fermer le modal avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeForm();
        }
    });

    // Animation des cartes de prix
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Appliquer l'animation aux cartes
    document.querySelectorAll('.pricing-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    // Gestion de la soumission du formulaire
    const form = document.getElementById('offerForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = form.querySelector('.btn-submit');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');

            // Afficher l'état de chargement
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            submitBtn.disabled = true;

            // Simulation de l'envoi (remplacez par votre logique d'envoi réelle)
            setTimeout(() => {
                // Cacher les messages précédents
                document.getElementById('error-message').classList.add('hidden');
                document.getElementById('success-message').classList.add('hidden');

                // Afficher le message de succès
                const successMsg = document.getElementById('success-message');
                successMsg.textContent = 'Votre demande a été envoyée avec succès ! Nous vous recontacterons sous 24h.';
                successMsg.classList.remove('hidden');

                // Restaurer l'état du bouton
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
                submitBtn.disabled = false;

                // Fermer le modal après 3 secondes
                setTimeout(closeForm, 3000);
            }, 1500);
        });
    }
}); 